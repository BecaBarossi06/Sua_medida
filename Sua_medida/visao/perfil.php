<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
   // Se não estiver logado, redireciona para a página de login
    // echo "nn está logado";
    exit;
}


// Exibe os dados do perfil
$nome = $_SESSION['nome'];
$email = $_SESSION['email'];
$perfil = $_SESSION['perfil'];

require_once ('Menu.php');
require ("../controladora/Autenticacao.php");
require_once('../controladora/conexao.php');
require_once('../Modelo/Produto.php');
require_once('../controladora/ProdutoRepositorio.php');

$produtoRepositorio = new ProdutoRepositorio($conn);
$produtos = $produtoRepositorio->buscarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!-- Define o conjunto de caracteres usado no documento, aqui é UTF-8 -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- Define a escala inicial e a largura da viewport para uma visualização responsiva em dispositivos móveis -->
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="stylesheet" href="../css/carrinho.css"> <!-- Link para o CSS externo -->
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/menu.css">


    
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Link para o Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <title>Sua Medida - Ateliê de costura</title>
</head>

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
                    <a class="nav-link" href="#section1">Compras
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section2">Sobre nós</a>
                </li>
            </ul>
</header>

<!--seção de navegação das paginas-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top"></nav>

<div id="section1" class="container-fluid bg-success text-white" style="padding:100px 20px;">
  
  <div class="container mt-5">

        <h1 style="font-family:'Dancing Script', cursive; font-size:50px;">Escolha as roupas que deseja adicionar ao seu carrinho</h1>
        <br><br><br>

       
        <div class="home">
    <?php 
    
    require_once "../controladora/conexao.php";
    require_once "../Modelo/Produto.php";
    require_once "../controladora/ProdutoRepositorio.php";

    $produtoRepositorio = new ProdutoRepositorio($conn);
    $itens = $produtoRepositorio->buscarTodos(); // Corrigido para usar o método correto
    
    foreach ($itens as $item): 
    ?>
        <div class="home">
            <img src="<?=$item->getImagem()?>" alt="<?=$item->getNome()?>"/>
            <div class="home-descricao">
                <h5> <?=$item->getNome()?> </h5>
                <p>Tamanho Único</p>
                <p class="preco">R$ <?=number_format($item->getPreco(), 2, ',', '.')?></p>
                <form method="POST" action="adicionar_ao_carrinho.php">
                    <input type="hidden" name="id" value="<?=$item->getId()?>"/>
                    <button type="submit" class="btn-adicionar-carrinho">Adicionar ao Carrinho</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

        <br>
         <!-- Finalizar compra -->
         <div class="text-center">
            <a href="finalizar_compra.php" class="btn-finalizar">Finalizar Compra</a>
        </div>
    </div>
    <br><br>  <br><br><br>

    <div id="section2" class="container-fluid bg-warning">
    <h1 style="font-family:'Dancing Script', cursive;font-size: 40px;">Sobre nós</h1> '
    <img src="../img/atelie.png" alt="estabelecimento" class="imagem">
    <!--historia-->
    <p>Acredito que a roupa tem uma capacidade única de transformar, não apenas a aparência, mas também a maneira como nos sentimos. Ao longo dos anos, tive a oportunidade de ver em primeira mão como uma peça de roupa bem feita, com o ajuste perfeito e pensada especialmente para quem a veste, pode ter um impacto profundo na autoestima de uma pessoa. Muitas vezes, as clientes chegavam ao meu ateliê com inseguranças visíveis, em busca de algo que as fizesse sentir mais bonitas, mais confiantes, mais elas mesmas. E era ali, através de uma conversa, de um toque no tecido, de um detalhe cuidadosamente pensado, que começava a transformação.

Com o projeto "Sua Medida", o objetivo é muito claro: criar roupas que não apenas sigam tendências, mas que celebrem a individualidade de cada cliente. Não se trata de impor um estilo, mas de valorizar as características únicas de cada corpo, realçando os pontos fortes e criando um equilíbrio que faça a pessoa se sentir confortável e segura com quem ela é. Cada cliente que sai do ateliê com uma peça feita sob medida para ela traz consigo um sorriso, uma sensação de leveza e autoconfiança, e isso é o que me move. A cada entrega, sinto uma alegria imensa em ver como uma roupa pode realmente fazer a diferença na forma como a pessoa se percebe e se relaciona com o mundo.

Além disso, nos últimos tempos, a sustentabilidade tem sido uma parte fundamental do meu processo criativo. Sempre acreditei que, ao cuidar das pessoas, também devemos cuidar do planeta. Trabalhar com materiais sustentáveis, otimizar o uso de recursos e garantir que as peças que crio não sejam apenas bonitas e funcionais, mas também responsáveis, é algo que se tornou cada vez mais essencial para mim. Afinal, quando pensamos em moda, precisamos lembrar que o nosso bem-estar está interligado ao bem-estar do meio ambiente. Cuidar da natureza é, sem dúvida, uma forma de cuidar de nós mesmos, e isso tem guiado cada escolha que faço, desde a escolha dos tecidos até o processo final de entrega da peça.

O que me inspira a continuar é, sem dúvida, a gratidão das clientes e o impacto positivo que uma peça personalizada tem na vida delas. Para mim, cada roupa é mais do que um produto, é uma experiência, uma história, e, acima de tudo, uma forma de expressar o que cada pessoa tem de mais autêntico.</p>
</div>
</div>

<br><br><br><br><br><br><br><br><br>


    <!-- Rodapé da página -->
    <footer>
    <div class="footer-container">
        <div class="footer-section">
            <!-- Mapa do endereço -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3661.827625287934!2d-46.32479342518252!3d-23.3944523554805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce87785706619d%3A0x32fab1c5bd6fe009!2sSua%20Medida%20Ateli%C3%AA%20de%20Costura!5e0!3m2!1spt-BR!2sbr!4v1724029747272!5m2!1spt-BR!2sbr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="footer-section">
            <h4>Início</h4>
            <br><br><br>
            <ul class="navbar-nav">
                <li class="nav-item">
        <center> <a class="nav-link" href="#section1">Roupas</a><center>
                </li>
                <li class="nav-item">
        <center> <a class="nav-link" href="#section2">Sobre nós</a><center>
                </li>
                <li class="nav-item">
        <center> <a class="nav-link" href="#section3">Cadastre-se</a><center>
                </li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Informações</h4>
            <br><br><br>
            <ul>
                <li> Sua Medida, transforma roupas personalizadas que refletem seu estilo. Nossa equipe dedicada cria peças com qualidade e criatividade, valorizando o processo artesanal e os detalhes que fazem a diferença. Aqui, seu estilo é a nossa inspiração. </li>
            </ul>
        </div>   
        <div class="footer-section social-media">
            <div class="footer-section"> 
                <h4>Contato</h4>
                <br><br><br>
                <a href="https://www.instagram.com/suamedidaatelie?igsh=MXF2ODNwNTl4cXRpNQ=="><i> <img src="../img/insta.jpeg"> </i></a>
                <a href="https://wa.me/5511953004751" target="_blank" class="btn-whatsapp"><i> <img src="../img/wpp.jpg"> </i></a>
            </div>
        </div>    
    </div> <!-- Fim do footer-container -->

    <div class="footer-copyright">
        &copy; 2024 Sua Medida - Ateliê de costura
    </div>
</footer>


</body>
</html>