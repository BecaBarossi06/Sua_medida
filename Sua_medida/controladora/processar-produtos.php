<?php
session_start();
require_once('../controladora/conexao.php');
require_once('../controladora/ProdutoRepositorio.php');
require_once('../Modelo/Produto.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $tipo = trim($_POST['tipo'] ?? '');
    $preco = trim($_POST['preco'] ?? '');
    $descricao = $_POST['descricao'] ?? null;
    $imagem = $_FILES['imagem'] ?? null;

    // Remover símbolos do preço e converter para float
    $preco = str_replace(['R$', '.', ','], ['', '', '.'], $preco);
    $preco = floatval($preco);

    // Validação
    if (empty($nome) || empty($tipo) || $preco <= 0) {
        $_SESSION['mensagem'] = 'Preencha todos os campos obrigatórios!';
        header('Location: ../visao/admin.php');
        exit;
    }

    // Diretório de uploads
    $goTo = "../imagens/produtos/";
    if (!is_dir($goTo)) {
        mkdir($goTo, 0777, true);
    }

    // Processar imagem
    $novoCaminho = null;
    if ($imagem && $imagem['error'] === UPLOAD_ERR_OK) {
        $novoNome = uniqid() . "_" . basename($imagem["name"]);
        $novoCaminho = $goTo . $novoNome;
        if (!move_uploaded_file($imagem["tmp_name"], $novoCaminho)) {
            $_SESSION['mensagem'] = 'Erro ao mover o arquivo de imagem!';
            header('Location: ../visao/admin.php');
            exit;
        }
    }

    // Criar produto
    $produto = new Produto(null, $tipo, $nome, $descricao, $preco, $novoCaminho);

    // Repositório
    $produtoRepositorio = new ProdutoRepositorio($conn);
    $resultado = $produtoRepositorio->cadastrar($produto);

    if ($resultado) {
        $_SESSION['mensagem'] = 'Produto cadastrado com sucesso!';
    } else {
        $_SESSION['mensagem'] = 'Erro ao cadastrar o produto!';
    }

    header('Location: ../visao/admin.php');
    exit;
} else {
    $_SESSION['mensagem'] = 'Requisição inválida!';
    header('Location: ../visao/admin.php');
    exit;
}
