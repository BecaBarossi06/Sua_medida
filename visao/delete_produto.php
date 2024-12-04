<?php
require_once('../controladora/conexao.php');
require_once('../controladora/ProdutoRepositorio.php');

if (isset($_GET['id'])) {
    $idProduto = $_GET['id'];

    // Instanciando o repositório de produtos
    $produtoRepositorio = new ProdutoRepositorio($conn);

    // Buscando o produto para pegar o nome da imagem
    $produto = $produtoRepositorio->buscarPorId($idProduto);

    // Verificar se o produto foi encontrado
    if ($produto) {
        // Recuperar o nome da imagem associada ao produto
        $nomeImagem = $produto['imagem'];

        // Definir o caminho completo da imagem no servidor
        $imagemPath = "../img/" . $nomeImagem;

        // Verificar se o arquivo de imagem existe no servidor
        if (file_exists($imagemPath)) {
            unlink($imagemPath); // Excluir a imagem
        }

        // Deletando o produto do banco de dados
        $produtoRepositorio->deletarProduto($idProduto);

        // Redirecionar para a página de produtos ou para a página inicial
        header("Location: index.php");
        exit;
    } else {
        echo "Produto não encontrado.";
    }
}
?>
