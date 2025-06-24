<?php
session_start();

// Verifica se o carrinho já existe na sessão, caso contrário inicializa
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Verifica se o ID do produto foi enviado pelo formulário
if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];

    // Incrementa a quantidade do produto no carrinho ou adiciona
    if (isset($_SESSION['carrinho'][$id])) {
    } else {
        require_once "../controladora/conexao.php";
        require_once "../Modelo/Produto.php";
        require_once "../controladora/ProdutoRepositorio.php";

        // Busca o produto pelo ID
        $produtoRepositorio = new ProdutoRepositorio($conn);
        $produto = $produtoRepositorio->obterProdutoPorId($id);

        if ($produto) {
            $_SESSION['carrinho'][$id] = [
                'id' => $produto->getId(),
                'nome' => $produto->getNome(),
                'preco' => $produto->getPreco(),
                'imagem' => $produto->getImagem(),
            ];
        }
    }
}

// Redireciona para a página inicial ou para onde desejar
header("Location: perfil.php");
exit;
?>
