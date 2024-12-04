<?php
session_start();

// Verifica se os dados foram recebidos via POST
if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    // Configura as variáveis de sessão, se necessário
    $_SESSION['usuarios'] = $_POST['usuarios'] ?? null; // Verifica se existe o valor
    $_SESSION['nome'] = $_POST['nome'] ?? null;
} else {
    // Verifica se as variáveis de sessão estão setadas
    if (!isset($_SESSION['usuarios'])) {
        header("Location: login.php?erro=Usuário não autenticado");
        exit;
    }
}

require_once('Menu.php');
require("../controladora/Autenticacao.php");
require_once('../controladora/conexao.php');
require_once('../Modelo/Produto.php');
require_once('../controladora/ProdutoRepositorio.php');

$produtoRepositorio = new ProdutoRepositorio($conn);
$produtos = $produtoRepositorio->buscarTodos();

// Verifica se a sessão de 'nomeusuario' e 'email' estão definidas
$nome = isset($_SESSION['nomeusuario']) ? $_SESSION['nomeusuario'] : $nome;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>


<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <title>Admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/estilo.css">
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/menu.css">
        <link rel="icon" href="../img/logo.jpeg" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    </head>

    <body class="produtos">

        <div class="menu">
            <div class="user-info dropdown">
                <div class="dropdown-content">
                    <form id="inicioForm" action="index.php" method="post" style="display: none;">
                        <input type="hidden" name="usuarios" value="<?= isset($_SESSION['usuarios']) ? $_SESSION['usuarios'] : ''; ?>">
                        <input type="hidden" name="nome" value="<?= htmlspecialchars($nome); ?>">
                    </form>

                    <form id="PerfilForm" action="perfil.php" method="post" style="display: none;">
                        <input type="hidden" name="usuarios" value="<?= isset($_SESSION['usuarios']) ? $_SESSION['usuarios'] : ''; ?>">
                        <input type="hidden" name="nome" value="<?= htmlspecialchars($nome); ?>">

                    </form>

                    <a class="dropdown-item" href="#" onclick="enviarParaPerfil();">Menu</a>

                    <form id="adminForm" action="admin.php" method="post" style="display: none;">
                        <input type="hidden" name="usuarios" value="<?= isset($_SESSION['usuarios']) ? $_SESSION['usuarios'] : ''; ?>">
                        <input type="hidden" name="nome" value="<?= htmlspecialchars($nome); ?>">
                    </form>
                    <a class="dropdown-item" href="#" onclick="logout();">Sair</a>
                </div>
            </div>
        </div>

        <main>
            <section class="container-admin-banner"></section>
            <h2>Lista de roupas customizadas</h2>
            <br>

            <!-- Mensagem de sucesso para cadastro -->
            <?php if (isset($_SESSION['mensagem'])): ?>
                <p><?= $_SESSION['mensagem']; ?></p>
                <?php unset($_SESSION['mensagem']); // Limpa a mensagem após exibí-la 
                ?>
            <?php endif; ?>

            <section class="container-table">
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th colspan="2">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $produto): ?>
                            <tr>
                                <td><?= htmlspecialchars($produto->getNome()); ?></td>
                                <td><?= htmlspecialchars($produto->getTipo()); ?></td>
                                <td>R$ <?= number_format($produto->getPreco(), 2, ',', '.'); ?></td>
                                <td>
                                    <form action="editar-produto.php" method="GET">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($produto->getId()); ?>">
                                        <input type="submit" class="botao-editar" value="Editar">
                                    </form>
                                </td>
                                <td>
                                    <div class="cadastrop">
                                    <form action="excluir-produto.php" method="POST">
                                        <input type="hidden" name="id" value='<?= htmlspecialchars($produto->getId()); ?>'>
                                        <input type="hidden" name="nome" value='<?= htmlspecialchars($_SESSION['nome']); ?>'>
                                        <input type="submit" class="botao-excluir" value="Excluir">
                                    </form>
                        </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
            </section>

            <a  style="color:white;" class="botao-cadastrar" href="cadastrar-produto.php">Cadastrar<a>

           
            
            
        </main>

    </body>

</html>