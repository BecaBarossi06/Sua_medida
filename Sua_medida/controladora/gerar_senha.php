<?php
session_start();
include("../controladora/conexao.php");

// Função para gerar senha aleatória
function gerarSenhaAleatoria($tamanho = 8) {
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*';
    return substr(str_shuffle($caracteres), 0, $tamanho);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];

        // Gerar uma nova senha temporária
        $senhaTemporaria = gerarSenhaAleatoria();
        $senhaHash = password_hash($senhaTemporaria, PASSWORD_DEFAULT);

        // Atualiza a senha no banco de dados
        $sql = "UPDATE usuarios SET senha = ? WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $senhaHash, $email);
            if ($stmt->execute()) {
                $_SESSION['email'] = $email; // Armazena o email na sessão
                $mensagem = "Sua senha temporária é: <strong>$senhaTemporaria</strong>. Use-a para acessar e redefinir sua senha.";
            } else {
                $mensagem = "Erro ao atualizar a senha: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $mensagem = "Erro ao preparar a consulta: " . $conn->error;
        }
    } else {
        $mensagem = "Por favor, insira um email válido.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!-- Define o conjunto de caracteres usado no documento, aqui é UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo.jpeg" type="image/x-icon">
    <!-- Define a escala inicial e a largura da viewport para uma visualização responsiva em dispositivos móveis -->
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/menu.css">
    
    <!-- Link para a pasta e o arquivo de estilos CSS que define a aparência do documento -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Link para o Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Sua Medida - Ateliê de costura</title>
    <!-- Define o título da página, que aparece na aba do navegador -->

    
</head>
<header>
    <div id="area_cabecalho"><!--cabecalho -->
        <div id="area_logo"><!-- logo-->
            <h1 id="cor_logo"><span style="color: black;">Sua</span><span style="color: #8C8C8C;">Medida</span></h1>
        </div>
</header>
<body>
    <br><br><br>
    <div class="form-cadastrar">
    <h1 style="color: white;">Redefinir Senha</h1>
    <br>
    <form method="POST" action="">
        <label for="email">Digite seu e-mail para receber a senha temporária:</label>
        <br>
        <input type="email" id="email" placeholder="Digite seu email" name="email" required>
        <button type="submit" class="btn-cadastrar">Redefinir Senha</button>
    </form>
    <p style="color:white;"><?php echo isset($mensagem) ? $mensagem : ''; ?></p>
    <button type="submit" class="btn-cadastrargerar"><a href="../visao/login_geracao_senha.php">Voltar ao login</a> </button>
</div>
<br><br>
<footer>
    <div class="footer-container">
    <div class="footer-section">
        <!-- Mapa do endereço -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3661.827625287934!2d-46.32479342518252!3d-23.3944523554805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce87785706619d%3A0x32fab1c5bd6fe009!2sSua%20Medida%20Ateli%C3%AA%20de%20Costura!5e0!3m2!1spt-BR!2sbr!4v1724029747272!5m2!1spt-BR!2sbr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="footer-section">
        <h4>Início</h4>
        <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#section1">Roupas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section2">Sobre nós</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section3">Cadastre-se</a>
                </li>
            </ul>
    </div>
    <div class="footer-section">
        <h4>Informações</h4>
          <ul>
            <li> Sua Medida, transforma roupas personalizadas que refletem seu estilo. Nossa equipe dedicada cria peças com qualidade e criatividade, valorizando o processo artesanal e os detalhes que fazem a diferença. Aqui, seu estilo é a nossa inspiração. </li>
          </ul>
    </div>   
    <div class="footer-section social-media">
        <div class="footer-section"> 
            <h4>Contato</h4>
            <a href="https://www.instagram.com/suamedidaatelie?igsh=MXF2ODNwNTl4cXRpNQ=="><i> <img src="../img/insta.jpeg"> </i></a>
            <a href="https://wa.me/5511987654321" target="_blank" class="btn-whatsapp"><i> <img src="../img/wpp.jpg"> </i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>    
    <div class="footer-copyright">
        &copy; 2024 Sua Medida - Ateliê de costura
    </div>

    </footer>
</body>
</html>
