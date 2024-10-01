<?php
session_start();
require "conexao.php";
require "Produto.php";
require "ProdutoRepositorio.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se as variáveis de sessão e POST estão definidas
    if (!isset($_SESSION["nome"]) || !isset($_SESSION["tipo"]) || !isset($_SESSION["preco"]) || !isset($_POST['usuario'])) {
        die("Dados incompletos para cadastro do produto.");
    }

    $nome = $_SESSION["nome"];
    $tipo = $_SESSION["tipo"];
    $preco = $_SESSION["preco"];
    $imagem = $_FILES['imagem']['name'];
    
    $_SESSION['usuario'] = $_POST['usuario'];
    $_SESSION['nomeusuario'] = $_POST['nomeusuario'];

    // Inicialize o ID como null ou como um valor padrão
    $id = null; // Ajuste isso se precisar de um ID específico

    // Verifique se as variáveis necessárias estão presentes
    if ($tipo && $nome && $preco !== null && $imagem) {
        $produto = new Produto(
            $id,
            $tipo,
            $nome,
            $preco,
            $imagem
        );

        // Crie uma instância do repositório
        $produtoRepositorio = new ProdutoRepositorio($conn);

        if (isset($_FILES['imagem']) && ($_FILES['imagem']['error'] == 0)) {
            $produto->setImagem(uniqid() . $_FILES['imagem']['name']);
            move_uploaded_file($_FILES['imagem']['tmp_name'], $produto->getImagemDiretorio());
        }

        // Tente cadastrar o produto
        $sucess = $produtoRepositorio->cadastrar($produto);
        if ($sucess) {
            $codcad = rand(0, 1000000);
            echo "<form id='redirectForm' action='admin.php' method='POST'>";
            echo "<input type='hidden' name='codigo' value='{$codcad}'>";
            echo "<input type='hidden' name='nomeusuario' value='{$_SESSION['nomeusuario']}'>";
            echo "<input type='hidden' name='usuario' value='{$_SESSION['usuario']}'>";
            echo "</form>";
            echo "<script>document.getElementById('redirectForm').submit();</script>";
        } else {
            echo "Erro ao cadastrar produto.";
        }
    } else {
        echo "Produto cadastrado com sucesso!";
        header("Refresh: 2; url=admin.php"); // Redireciona após 2 segundos para a página de login
        exit();
}
 }
?>




