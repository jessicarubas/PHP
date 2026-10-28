<?php
namespace App\DAO;

use App\Model\{Produto, ProdutoFisico, ProdutoDigital};
use PDO;

class ProdutoDAO {
  public function __construct(private PDO $pdo) {}

  public function inserir(Produto $p): int {
    $st = $this->pdo->prepare('INSERT INTO produtos (nome,preco,estoque,tipo,peso_kg,link_download) VALUES (:n,:p,:e,:t,:w,:l)');
    $st->execute([
      ':n' => $p->getNome(),
      ':p' => $p->getPreco(),
      ':e' => $p->getEstoque(),
      ':t' => $p instanceof ProdutoDigital ? 'digital' : 'fisico',
      ':w' => $p instanceof ProdutoFisico ? $p->getPesoKg() : null,
      ':l' => $p instanceof ProdutoDigital ? $p->getLinkDownload() : null
    ]);
    return (int)$this->pdo->lastInsertId();
  }

  // NOVO: atualizar produto
  public function atualizar(Produto $p): bool {
    $st = $this->pdo->prepare(
      'UPDATE produtos SET nome=:n, preco=:p, estoque=:e,
       tipo=:t, peso_kg=:w, link_download=:l WHERE id=:id'
    );

    return $st->execute([
      ':n' => $p->getNome(),
      ':p' => $p->getPreco(),
      ':e' => $p->getEstoque(),
      ':t' => $p instanceof ProdutoDigital ? 'digital' : 'fisico',
      ':w' => $p instanceof ProdutoFisico ? $p->getPesoKg() : null,
      ':l' => $p instanceof ProdutoDigital ? $p->getLinkDownload() : null,
      ':id' => $p->getId()
    ]);
  }

  // NOVO: excluir produto
  public function excluir(int $id): bool {
    return $this->pdo
      ->prepare('DELETE FROM produtos WHERE id = :id')
      ->execute([':id' => $id]);
  }

  public function listar(): array {
    return array_map(
      [$this, 'hidratar'],
      $this->pdo->query(
        'SELECT * FROM produtos ORDER BY id DESC'
      )->fetchAll()
    );
  }

  public function hidratar(array $r): Produto {
    return $r['tipo'] === 'digital'
      ? new ProdutoDigital(
          $r['id'], $r['nome'], (float)$r['preco'],
          (int)$r['estoque'], (string)$r['link_download']
        )
      : new ProdutoFisico(
          $r['id'], $r['nome'], (float)$r['preco'],
          (int)$r['estoque'], (float)$r['peso_kg']
        );
  }
}
