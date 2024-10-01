<?php
// Verifica se a sessão de 'nomeusuario' está definida
$nome = isset($_SESSION['nomeusuario']) ? $_SESSION['nomeusuario'] : $nome; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Menu do Usuário</title>
    <link rel="stylesheet" href="css/menu.css">
</head>
<body>
    <div class="menu">
        <div class="user-info dropdown">
            <div class="user-photo">
                <img src="img/logo.jpeg" alt="Foto do Usuário">
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
                <a class="dropdown-item" href="#" onclick="enviarParaAdmin();">Admin</a>
                <a class="dropdown-item" href="#" onclick="logout();">Sair</a>
            </div>
        </div>
    </div>
    <script>

        function enviarParaAdmin() {
            document.getElementById('adminForm').submit();
        }

        function logout() {
            window.location.href = 'logout.php'; // Pode redirecionar para a página de logout
        }
    </script>
</body>
</html>
