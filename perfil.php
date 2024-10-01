<?php
session_start();  // Iniciar sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit;
}

// Incluir o arquivo de conexão com o banco de dados
include("conexao.php");

// Exibe os dados do perfil
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];
$perfil = $_SESSION['perfil'];

require_once ('menu.php');
require ("Autenticacao.php");
require_once('conexao.php');
require_once('Produto.php');
require_once('ProdutoRepositorio.php');

$produtoRepositorio = new ProdutoRepositorio($conn);
$produtos = $produtoRepositorio->buscarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!-- Define o conjunto de caracteres usado no documento, aqui é UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Define a escala inicial e a largura da viewport para uma visualização responsiva em dispositivos móveis -->
    <link rel="stylesheet" href="css/estilo.css">
    <!-- Link para a pasta e o arquivo de estilos CSS que define a aparência do documento -->
    
    <title>Sua Medida - Ateliê de costura</title>
    <!-- Define o título da página, que aparece na aba do navegador -->

        <?php
    include("conexao.php");
    ?>
</head>

<header>
    <div id="area_cabecalho"><!--cabecalho -->
        <div id="area_logo"><!-- logo-->
            <h1 id="cor_logo">Sua<span style="color: #F2F2F2;">Medida</span></h1>
        </div>
    <!-- Cabeçalho do site -->
    <nav>
            <!-- Seção de navegação -->
        <div class="container-fluid">
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
    </nav>
</header>
<!--seção de navegação das paginas-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top"></nav>

<div id="section1" class="container-fluid bg-success text-white" style="padding:100px 20px;">
    
  <h1>Roupas</h1>
  <section id="home" class="home">
   <ul>
    <!-- Lista de itens dentro da seção -->
     <li>
        <!-- Item da lista com imagem e descrição -->
        <img src="img/roupa1.jpeg" alt="roupa1">
        <!-- Imagem do item, com texto alternativo para acessibilidade -->
        <div class="home-descricao">
            <!-- Div para a descrição do item -->
            <p>Cropped branco</p>
            <!-- Nome do item -->
            <p>TAM: M</p>
            <!-- Tamanho do item -->
            <p>R$ 50,00</p>
            <!-- Preço do item -->
        </div>
        </li>
        <li>
                <!-- Outro item da lista com imagem e descrição -->
                <img src="img/roupa2.jpeg" alt="roupa2">
                <!-- Imagem do item, com texto alternativo para acessibilidade -->
                <div class="home-descricao">
                    <!-- Div para a descrição do item -->
                    <p>Cropped listrado</p>
                    <!-- Nome do item -->
                    <p>TAM: M</p>
                    <!-- Tamanho do item -->
                    <p>R$ 50,00</p>
                    <!-- Preço do item -->
                </div>
            </li>
            <li>
                <!-- Outro item da lista com imagem e descrição -->
                <img src="img/roupa3.jpeg" alt="roupa3">
                <!-- Imagem do item, com texto alternativo para acessibilidade -->
                <div class="home-descricao">
                    <!-- Div para a descrição do item -->
                    <p>Regata preta</p>
                    <!-- Nome do item -->
                    <p>TAM: M</p>
                    <!-- Tamanho do item -->
                    <p>R$ 50,00</p>
                    <!-- Preço do item -->
                </div>
            </li>
        </ul>
    </section> 
</div>

<div id="section2" class="container-fluid bg-warning" style="padding:100px 20px;">
   
    <h1>Sobre nós</h1>
    <!--historia-->
    <p>Sempre acreditei que a roupa tem o poder de transformar. Ao longo dos anos, vi como uma peça bem feita e personalizada podia elevar a autoestima das pessoas. Muitas clientes chegavam ao ateliê inseguras, buscando algo que as fizesse se sentir mais bonitas e confiantes. Com "Sua Medida", busco criar roupas que valorizem a individualidade de cada cliente, realçando seus pontos fortes e disfarçando o que elas não gostam. A cada peça entregue, a alegria e a gratidão das clientes me motivam a continuar. A sustentabilidade se tornou parte do meu processo, pois acredito que cuidar do meio ambiente também é cuidar de nós mesmos.</p>
</div>

    <!-- Rodapé da página -->
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
            <a href="https://www.instagram.com/suamedidaatelie?igsh=MXF2ODNwNTl4cXRpNQ=="><i> <img src="img/insta.jpeg"> </i></a>
            <a href="https://wa.me/5511987654321" target="_blank" class="btn-whatsapp"><i> <img src="img/wpp.jpg"> </i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </div>    
    <div class="footer-copyright">
        &copy; 2024 Sua Medida - Ateliê de costura
    </div>
        
        

    </footer>

</body>
</html>