<?php
session_start(); // Inicie a sessão
include 'conexao.php';
include 'Produto.php';
include 'ProdutoRepositorio.php';

// Verifica se o ID do produto foi enviado
if (isset($_SESSION['id'])) {
    $produtosRepositorio = new ProdutoRepositorio($conn);
    $excluiProduto = $produtosRepositorio->excluirProdutoPorId($_POST['id']);
    $_SESSION['nomeusuario'] = $_SESSION['nomeusuario'];
    $_SESSION['usuarios'] = $_SESSION['usuarios'];
} else {
    // Se o ID não foi enviado, redireciona ou exibe um erro
    echo "ID do produto não fornecido.";
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/logo.jpeg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Exclusão de Produto</title>
</head>
<body>
    <main>
        <section class="container-admin-banner">
            <?php
            if (isset($excluiProduto) && $excluiProduto) {
                echo "<h1>Produto excluído com sucesso</h1>";
            } else {
                echo "<h1>Erro ao excluir produto</h1>";
            }
            ?>
        </section>
        <section class="container-form">
            <form action="admin.php" method="post">
                <input type="submit" name="voltar" class="botao-cadastrar" value="Voltar" />
                <input type='hidden' name='nomeusuario' value="<?= htmlspecialchars($_SESSION['nomeusuario']); ?>">
                <input type='hidden' name='usuarios' value="<?= htmlspecialchars($_SESSION['usuarios']); ?>">
            </form>
        </section>
    </main>
</body>
</html>
