<?php
session_start();
require_once('../controladora/conexao.php');
require_once ('../controladora/ProdutoRepositorio.php');
require_once ('../Modelo/Produto.php');

?>


<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/cadastrar-produto.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="../img/logo.jpeg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Cadastrar Produto</title>
</head>

<body class="cadastrar">
    <main>
        <section class="container-admin-banner">

            <h1>Cadastro de Produtos</h1>

        </section>
        <section class="container-form">
            <form action="../controladora/processar-produtos.php" method="POST" enctype="multipart/form-data">


                <label for="nome" style="color:black;">Nome do Produto</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" required>
                <br>
                <label for="tipo" style="color:black;">Tipo</label>
                <input type="text" id="tipo" name="tipo" placeholder="Digite o tipo do produto" required>
                 <br>
                <label for="preco" style="color:black;">Preço</label>
                <input type="text" id="preco" name="preco" placeholder="Digite um preço" required>
                <br>
                <input type="file" name="imagem" id="imagem">
                <br>
                <input type="submit" name="cadastro" class="botao-cadastrar-produto" value="Cadastrar produto" style="width:100%;" />
                <br>
            
                
    


               
            </form>

        </section>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/index.js"></script>

    <script>
        $(document).ready(function() {
            $('#preco').maskMoney({
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });
        });
    </script>
</body>

</html>