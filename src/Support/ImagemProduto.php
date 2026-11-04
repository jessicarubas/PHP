<?php
namespace App\Support;

use finfo;
use InvalidArgumentException;
use RuntimeException;

class ImagemProduto {
  private const TAMANHO_MAXIMO = 2 * 1024 * 1024;
  private const FORMATOS = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp',
  ];

  public static function salvar(?array $arquivo, ?string $imagemAtual = null): ?string {
    if ($arquivo === null || ($arquivo['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
      return $imagemAtual;
    }

    if (($arquivo['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
      throw new InvalidArgumentException('Não foi possível enviar a imagem.');
    }

    if (($arquivo['size'] ?? 0) > self::TAMANHO_MAXIMO) {
      throw new InvalidArgumentException('A imagem deve ter no máximo 2 MB.');
    }

    $temporario = $arquivo['tmp_name'] ?? '';
    if (!is_uploaded_file($temporario)) {
      throw new InvalidArgumentException('O arquivo enviado não é válido.');
    }

    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($temporario);
    $extensao = self::FORMATOS[$mime] ?? null;
    if ($extensao === null) {
      throw new InvalidArgumentException('Formato inválido. Use uma imagem JPEG, PNG ou WEBP.');
    }

    $diretorio = __DIR__ . '/../uploads';
    if (!is_dir($diretorio) && !mkdir($diretorio, 0775, true) && !is_dir($diretorio)) {
      throw new RuntimeException('Não foi possível criar a pasta de imagens.');
    }

    $nome = bin2hex(random_bytes(16)) . '.' . $extensao;
    if (!move_uploaded_file($temporario, $diretorio . '/' . $nome)) {
      throw new RuntimeException('Não foi possível salvar a imagem enviada.');
    }

    return 'uploads/' . $nome;
  }
}
