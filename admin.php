
<?php
session_start(); // Inicia a sessão
// Verifica se os dados foram recebidos via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Configura as variáveis de sessão, se necessário
    $_SESSION['usuarios'] = $_POST['usuarios'] ?? null; // Verifica se existe o valor
    $_SESSION['nomeusuario'] = $_POST['nomeusuario'] ?? null;
} else {
    // Verifica se as variáveis de sessão estão setadas
    if (!isset($_SESSION['usuarios'])) {
        header("Location: login.php?erro=Usuário não autenticado");
        exit;
    }
}

require_once ('menu.php');
require ("Autenticacao.php");
require_once('conexao.php');
require_once('Produto.php');
require_once('ProdutoRepositorio.php');

$produtoRepositorio = new ProdutoRepositorio($conn);
$produtos = $produtoRepositorio->buscarTodos();
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/menu.css">
  <link rel="icon" href="img/logo.jpeg" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <title>Admin</title>
</head>

<body>
<div class="menu">
        <div class="user-info dropdown">
            <div class="dropdown-content">
                <form id="inicioForm" action="index.php" method="post" style="display: none;">
                    <input type="hidden" name="usuarios" value="<?= isset($_SESSION['usuarios']) ? $_SESSION['usuarios'] : ''; ?>">
                    <input type="hidden" name="nomeusuario" value="<?= htmlspecialchars($nome); ?>">
                </form>
                <form id="adminForm" action="admin.php" method="post" style="display: none;">
                    <input type="hidden" name="usuarios" value="<?= isset($_SESSION['usuarios']) ? $_SESSION['usuarios'] : ''; ?>">
                    <input type="hidden" name="nomeusuario" value="<?= htmlspecialchars($nome); ?>">
                </form>
                <a class="dropdown-item" href="#" onclick="enviarParaAdmin();">Admin</a>
                <a class="dropdown-item" href="#" onclick="logout();">Sair</a>
            </div>
        </div>
    </div>

  <main>
    <section class="container-admin-banner"></section>
    <h2>Lista de Produtos</h2>
    <br><br><br>
    <?php if (isset($_POST['codcad'])): ?>
      <label for="codigo">Produto cadastrado com sucesso!</label>
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
              <td>R$ <?= htmlspecialchars($produto->getPreco()); ?></td>
              <td>
                <form action="editar-produto.php" method="POST">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($produto->getId()); ?>">
                  <input type="hidden" name="nomeusuario" value="<?= htmlspecialchars($_SESSION['nomeusuario']); ?>">
                  <input type="submit" class="botao-editar" value="Editar">
                </form>
              </td>
              <td>
                <form action="excluir-produto.php" method="POST">
                  <input type="hidden" name="id" value="<?= htmlspecialchars($produto->getId()); ?>">
                  <input type="hidden" name="nomeusuario" value="<?= htmlspecialchars($_SESSION['nomeusuario']); ?>">
                  <input type="submit" class="botao-excluir" value="Excluir">
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <form action="cadastrar-produto.php" method="POST">
        <input type="hidden" name="nomeusuario" value="<?= htmlspecialchars($_SESSION['nomeusuario']); ?>">
        <input type="submit" class="botao-cadastrar" value="Cadastrar produto">
      </form>

    </section>
  </main>
</body>
</html>
