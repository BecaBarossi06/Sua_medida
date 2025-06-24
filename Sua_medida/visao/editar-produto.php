<?php
session_start();

require_once 'Menu.php';
require_once '../controladora/conexao.php';
require_once '../Modelo/Produto.php';
require_once '../controladora/ProdutoRepositorio.php';

// Verificar se o parâmetro 'id' foi passado na URL
if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
  echo "Erro: ID do produto não encontrado.";
  exit;
}

$idProduto = (int) $_GET['id'];  // Garantir que o ID seja um número inteiro
//echo "ID do produto (parâmetro da URL): " . $idProduto . "<br>";  // Verifique o ID que está sendo passado

// Verificar se o produto existe na base de dados
$produtosRepositorio = new ProdutoRepositorio($conn);
$produto = $produtosRepositorio->obterProdutoPorId($idProduto);

if ($produto === null) {
  echo "Produto não encontrado para o ID: " . $idProduto;
  exit;
}
?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="../css/form.css">
  <title>Editar Produto</title>
</head>

<body>
  <main>
    <section class="container-admin-banner">
      <h1>Editar Produto</h1>
    </section>
    <section class="container-form">
      <form method="POST" action="../controladora/processar-editar-produto.php" enctype="multipart/form-data">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nomeP" value="<?= htmlspecialchars($produto->getNome()); ?>" required>

        <label for="tipo">Tipo</label>
        <input type="text" id="tipo" name="tipo" value="<?= htmlspecialchars($produto->getTipo()); ?>" required>

        <label for="preco">Preço</label>
        <input type="text" id="preco" name="preco" value="<?= htmlspecialchars($produto->getPreco()); ?>" required>


        </div>
        <input type="file" name="imagem" accept="image/*">
        <input type="hidden" name="id" value="<?= htmlspecialchars($produto->getId()); ?>">

        <input type="submit" name="editar" value="Salvar Alterações">
      </form>
    </section>
  </main>
</body>

</html>