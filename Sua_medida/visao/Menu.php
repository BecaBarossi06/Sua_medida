<?php
// Inicializa $nome e $email com valores padrão
$nome = '';
$email = '';

// Verifica se a sessão de 'nomeusuario' e 'email' estão definidas
$nome = isset($_SESSION['nome']) ? $_SESSION['nome'] : $nome;
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu do Usuário</title>
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="../css/menu.css">
  <link rel="icon" href="../img/logo.jpeg" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="menu">
    <div class="user-info dropdown">
            <div class="user-photo">
                <img src="../img/logo.jpeg" alt="Foto do Usuário">
            </div>
            <div class="user-name"><?php echo htmlspecialchars($nome); ?></div>
            <div class="dropdown-content">
                <form id="inicioForm" action="index.php" method="post" style="display: none;">
                    <input type="hidden" name="usuarios" value="<?= isset($_SESSION['usuarios']) ? $_SESSION['usuarios'] : ''; ?>">
                    <input type="hidden" name="nomeusuario" value="<?= htmlspecialchars($nome); ?>">
                </form>
                <form id="adminForm" action="admin.php" method="post" style="display: none;">
                    <input type="hidden" name="usuarios" value="<?= isset($_SESSION['usuarios']) ? $_SESSION['usuarios'] : ''; ?>">
                    <input type="hidden" name="nomeusuario" value="<?= htmlspecialchars($nome); ?>">
                </form>
                <form id="perfilForm" action="perfil.php" method="post" style="display: none;">
                    <input type="hidden" name="usuarios" value="<?= isset($_SESSION['usuarios']) ? $_SESSION['usuarios'] : ''; ?>">
                    <input type="hidden" name="nomeusuario" value="<?= htmlspecialchars($nome); ?>">
                </form>
                <!-- Verifica se o e-mail corresponde ao do admin -->
                <?php if ($email === 'abc@ifsp.edu.br'): ?>
                    <a class="dropdown-item" href="#" onclick="enviarParaAdmin();">Admin</a>
                <?php endif; ?>

                <a class="dropdown-item" href="#" onclick="logout();">Deslogar</a>
             
            </div>
        </div>
        <ul style="float: left;">
             <li class="nav-item">
                <a class="nav-linkcar" href="finalizar_compra.php">
                    <i class="fas fa-cart-shopping" style="font-size: 1.5rem;"></i>
                </a>
            </li>
        </ul>
    </div>
    <script>
        function enviarParaAdmin() {
            document.getElementById('adminForm').submit();
        }

        function logout() {
            window.location.href = 'logout.php'; // Redireciona para a página de logout
        }
        function enviarParaPerfil() {
            document.getElementById('perfilForm').submit();
            
        }
    </script>
</body>
</html>