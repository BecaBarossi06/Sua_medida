<?php
    include("../controladora/conexao.php");
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
    <link rel="stylesheet" href="../css/carrinho.css"> <!-- Link para o CSS externo -->

    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/menu.css">
    
    <!-- Link para a pasta e o arquivo de estilos CSS que define a aparência do documento -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Link para o Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Alkatra:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <title>Sua Medida - Ateliê de costura</title>
    <!-- Define o título da página, que aparece na aba do navegador -->

    
    
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
                <li class="nav-item">
                    <a class="nav-link" href="#section3">Cadastre-se</a>
      
              </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section4">Logue-se</a>
                </li>
            </ul>
</header>

<!--seção de navegação das paginas-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top"></nav>

<div id="section1" class="container-fluid bg-success text-white">
  
  <div class="container mt-5">
<br><br><br>
        <h1 style="font-family:'Dancing Script', cursive; font-size:50px;"> Quer fazer compras? Logue-se!</h1>
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
                    <img src="<?= htmlspecialchars($item->getImagem()) ?>" alt="<?= htmlspecialchars($item->getNome()) ?>" />
                    <div class="home-descricao">
                        <h5><?= htmlspecialchars($item->getNome()) ?></h5>
                        <p>Tamanho Único</p>
                        <p class="preco">R$ <?= number_format($item->getPreco(), 2, ',', '.') ?></p>
                    </div>
                </div>
            <?php
                endforeach;
            ?>
</div> 

       

   
   <br>
    

<div id="section2" class="container-fluid bg-warning">
    <h1 style="font-family:'Dancing Script', cursive;font-size: 40px;">Sobre nós</h1>
    <img src="../img/atelie.png" alt="estabelecimento" class="imagem">
    <!--historia-->
    <p>Acredito que a roupa tem uma capacidade única de transformar, não apenas a aparência, mas também a maneira como nos sentimos. Ao longo dos anos, tive a oportunidade de ver em primeira mão como uma peça de roupa bem feita, com o ajuste perfeito e pensada especialmente para quem a veste, pode ter um impacto profundo na autoestima de uma pessoa. Muitas vezes, as clientes chegavam ao meu ateliê com inseguranças visíveis, em busca de algo que as fizesse sentir mais bonitas, mais confiantes, mais elas mesmas. E era ali, através de uma conversa, de um toque no tecido, de um detalhe cuidadosamente pensado, que começava a transformação.

Com o projeto "Sua Medida", o objetivo é muito claro: criar roupas que não apenas sigam tendências, mas que celebrem a individualidade de cada cliente. Não se trata de impor um estilo, mas de valorizar as características únicas de cada corpo, realçando os pontos fortes e criando um equilíbrio que faça a pessoa se sentir confortável e segura com quem ela é. Cada cliente que sai do ateliê com uma peça feita sob medida para ela traz consigo um sorriso, uma sensação de leveza e autoconfiança, e isso é o que me move. A cada entrega, sinto uma alegria imensa em ver como uma roupa pode realmente fazer a diferença na forma como a pessoa se percebe e se relaciona com o mundo.

Além disso, nos últimos tempos, a sustentabilidade tem sido uma parte fundamental do meu processo criativo. Sempre acreditei que, ao cuidar das pessoas, também devemos cuidar do planeta. Trabalhar com materiais sustentáveis, otimizar o uso de recursos e garantir que as peças que crio não sejam apenas bonitas e funcionais, mas também responsáveis, é algo que se tornou cada vez mais essencial para mim. Afinal, quando pensamos em moda, precisamos lembrar que o nosso bem-estar está interligado ao bem-estar do meio ambiente. Cuidar da natureza é, sem dúvida, uma forma de cuidar de nós mesmos, e isso tem guiado cada escolha que faço, desde a escolha dos tecidos até o processo final de entrega da peça.

O que me inspira a continuar é, sem dúvida, a gratidão das clientes e o impacto positivo que uma peça personalizada tem na vida delas. Para mim, cada roupa é mais do que um produto, é uma experiência, uma história, e, acima de tudo, uma forma de expressar o que cada pessoa tem de mais autêntico.</p>
</div>
<br><br><br><br>
<div id="section3" class="container-fluid bg-secondary text-white" style="padding:100px 20px;">
    <!--formulario-->
    <div class="form-cadastrar">
  <h1 class="form-h1">Cadastre-se</h1>

      <form action="../controladora/processa_cadastro.php" method="POST">
    <div class="mb-3 mt-3">
      <label for="nome">Nome:</label>
      <input type="text" class="form-control" id="nome" placeholder="Digite seu nome" name="nome" required>
    </div>
    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Digite seu email" name="email" required>
    </div>
    <div class="mb-3">
      <label for="pwd">Senha:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Digite sua senha" name="pswd" required>
    </div>

    <div id="password-criteria">
    <p class="password-check" id="min-length">✔ A senha deve ter no mínimo 8 caracteres</p>
    <p class="password-check" id="uppercase">✔ Deve conter pelo menos uma letra maiúscula (A-Z)</p>
    <p class="password-check" id="number">✔ Deve conter pelo menos um número (0-9)</p>
    <p class="password-check" id="special-char">✔ Deve conter pelo menos um caractere especial (!@#$...)</p>
  </div>


    <button type="submit" class="btn-cadastrar">Enviar</button>
</form>
</div>
</div>
 
<div id="section4" class="container-fluid bg-secondary text-white" style="padding:100px 20px;">
<div class="form-login">
<h1 class="form-h1">Logue-se</h1>

<form action="../controladora/processa_login.php" method="POST">
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
            </div>
            <div class="mb-3">
                <label for="pswd">Senha:</label>
                <input type="password" class="form-control" id="pswd" name="pswd" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="btn-login">Login</button>

            
        </form>

        <h1 class="form-h1">Esqueceu sua senha?</h1>
        <form action="../controladora/redefinir_senha.php" method="POST">
    <div class="mb-3">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
    </div>
    <button type="submit" class="btn-redefinir">Redefinir senha</button>
</form>
        </div>
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
            <br><br><br>
            <ul class="navbar-nav">
                <li class="nav-item">
        <center> <a class="rodapelink" href="#section1">Roupas</a><center>
                </li>
                <li class="nav-item">
        <center> <a class="rodapelink" href="#section2">Sobre nós</a><center>
                </li>
                <li class="nav-item">
        <center> <a class="rodapelink" href="#section3">Cadastre-se</a><center>
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

<script>
  document.getElementById('pwd').addEventListener('input', function() {
    const password = this.value;
    const minLength = document.getElementById('min-length');
    const uppercase = document.getElementById('uppercase');
    const number = document.getElementById('number');
    const specialChar = document.getElementById('special-char');

    // Validação dos critérios
    const hasMinLength = password.length >= 8;
    const hasUppercase = /[A-Z]/.test(password);
    const hasNumber = /\d/.test(password);
    const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    // Atualização do estilo
    minLength.classList.toggle('valid', hasMinLength);
    uppercase.classList.toggle('valid', hasUppercase);
    number.classList.toggle('valid', hasNumber);
    specialChar.classList.toggle('valid', hasSpecialChar);
  });
</script>



</body>
</html>