<?php
session_start();
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
     <h2 class= "class" >Login </h2>
        <form action="../controladora/processa_login.php" method="POST">
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
            </div>
            <div class="mb-3">
                <label for="pswd">Senha:</label>
                <input type="password" class="form-control" id="pswd" name="pswd" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn-cadastrar">Login</button>
      


        </form>
    </div>
    </div>
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