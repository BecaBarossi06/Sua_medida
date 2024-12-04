<?php
session_start();
require_once "conexao.php";
require_once 'ProdutoRepositorio.php';
require_once '../Modelo/Produto.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar'])) {
    $id = $_POST['id'] ?? null;
    $tipo = $_POST['tipo'] ?? null;
    $nomeP = $_POST['nomeP'] ?? null;
    $descricao = $_POST['descricao'] ?? null;
    $preco = $_POST['preco'] ?? null;
    $imagem = $_FILES['imagem'] ?? null;

    if (!$id || !$tipo || !$nomeP || !$preco) {
        echo "Erro: Dados obrigatórios não foram enviados.";
        exit;
    }

    $goTo = "../imagens/produtos/";

    // Corrigido para usar $goTo em vez de $uploadDir
    if (!is_dir($goTo)) {
        mkdir($goTo, 0777, true);
    }

    // Instanciando o repositório
    $produtosRepositorio = new ProdutoRepositorio($conn);

    // Tratando o upload de imagem
    if ($imagem && $imagem["error"] === UPLOAD_ERR_OK) {
        // Verificando o tipo de imagem antes de mover o arquivo
        $extensao = strtolower(pathinfo($imagem["name"], PATHINFO_EXTENSION));
        $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($extensao, $tiposPermitidos)) {
            echo "Erro: Tipo de arquivo não permitido. Somente imagens JPG, JPEG, PNG e GIF são permitidas.";
            exit;
        }

        $novoNome = uniqid() . "_" . basename($imagem["name"]);
        $novoCaminho = $goTo . $novoNome;

        // Movendo o arquivo para o diretório de destino
        if (move_uploaded_file($imagem["tmp_name"], $novoCaminho)) {
            // A imagem foi enviada com sucesso
            $imagemCaminho = $novoCaminho;
        } else {
            echo "Erro ao mover o arquivo de imagem.";
            exit;
        }
    } else {
        // Caso a imagem não tenha sido enviada, podemos tratar a imagem como null
        $imagemCaminho = null;
    }

    // Criando ou atualizando o produto
    $produto = new Produto($id, $tipo, $nomeP, $descricao, $preco, $imagemCaminho);
    
    // Atualizando o produto no banco de dados
    $produtosRepositorio->atualizarProduto($produto);

    // Redirecionando para a página de sucesso ou administração
    header("Location: ../visao/admin.php?success=1");
    exit;
} else {
    echo "Erro: Requisição inválida.";
}
