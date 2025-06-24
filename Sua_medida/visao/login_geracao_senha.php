<?php
session_start();
include("../controladora/conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar se o e-mail existe no banco
    $sql = "SELECT id, senha FROM usuarios WHERE email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $senhaHash);
            $stmt->fetch();

            // Verificar a senha
            if (password_verify($senha, $senhaHash)) {
                $_SESSION['email'] = $email;
                header("Location: ../controladora/redefinir_senha.php"); // Redireciona para redefinir senha
                exit();
            } else {
                $erro = "E-mail ou senha incorretos! A senha gerada foi: $senha";
            }
        } else {
            $erro = "E-mail não encontrado!";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"> <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Login - Sua Medida</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <header>
    <div id="area_cabecalho"><!--cabecalho -->
        <div id="area_logo"><!-- logo-->
            <h1 id="cor_logo"><span style="color: black;">Sua</span><span style="color: #8C8C8C;">Medida</span></h1>
        </div>
        <!-- Cabeçalho do site -->
<nav>
            <!-- Seção de navegação -->
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
      
              </li>
            </ul>
</header>

    <div id="section3" class="container-fluid bg-secondary text-white" style="padding:100px 20px;">
        <div class="form-cadastrar">
     <h2 class= "class" >Login com senha gerada</h2>
        <form action="../controladora/redefinir_senha.php" method="POST">
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
            </div>
            <div class="mb-3">
                <label for="pswd">Senha:</label>
                <input type="password" class="form-control" id="pswd" name="pswd" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn-cadastrar">Login</button>
    <p><?php echo isset($erro) ? $erro : ''; ?></p>

</body>
</html>
