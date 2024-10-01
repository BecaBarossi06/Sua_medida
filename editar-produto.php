<?php
session_start();
$usuarios = $_SESSION['usuarios']
?>
<!doctype html>
<?php
// Verifica se os dados foram recebidos via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Obtém os dados enviados
  $usuarios = $_SESSION['usuarios'];
  $nome = $_SESSION['nomeusuario'];

  // Faz alguma coisa com os dados recebidos, se necessário
  // ...

  // Configura as variáveis de sessão, se necessário
  $_SESSION['usuarios'] = $usuarios;
  $_SESSION['nomeusuario'] = $nome;

} else {
  header("Location: login.php");
  exit;
}
include 'menu.php';
include 'conexao.php';
include 'Produto.php';
include 'ProdutoRepositorio.php';

$produtosRepositorio = new ProdutoRepositorio($conn);

?>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/form.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="img/logo.jpeg" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Editar Produto</title>
</head>

<body>
  <main>
    <section class="container-admin-banner">

      <h1>Editar Produto</h1>

    </section>
    <section class="container-form">
      <form method="POST" action="processar-editar-produto.php" id="editarForm" enctype="multipart/form-data">

        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" value="<?= $produto->getNome(); ?>" required>

        <label for="preco">Preço</label>
        <input type="text" id="preco" name="preco" value="<?= $produto->getPreco(); ?>" required>

        <?php $imagemfake = $produto->getImagem();


        // Remove a parte "C:\fakepath\" do valor (apenas no caso de navegadores baseados em Windows)
        $imagem = basename($imagemfake);

        // Agora, $imagem conterá apenas o nome do arquivo, sem a parte "C:\fakepath\"
        ?>
        <label for="imagem">Envie uma nova imagem do produto ou mantenha a imagem atual:
          <div class="container-foto">
            <img src="<?= $produto->getImagem(); ?>" alt="<?= $produto->getImagem(); ?>" width="200">
          </div><?= $produto->getImagem();//$imagem;
           ?>
        </label>
        <input type="file" name="imagem" accept="image/*" id="imagem" value="<?php echo $imagem; ?>">
        <input type='hidden' name='nomeusuario' value=<?= $_SESSION['nomeusuario'];?>>
        <input type='hidden' name='usuarios' value=<?= $_SESSION['usuarios'];?>>
        <input type="hidden" name="id" id="id" value="<?= $produto->getId(); ?>">
        <input type="submit" name="editar" class="botao-cadastrar" value="Editar produto" />
      </form>

    </section>
  </main>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="js/index.js"></script>
</body>

</html>