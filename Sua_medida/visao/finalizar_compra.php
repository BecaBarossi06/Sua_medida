<?php
session_start();

// Função para remover item do carrinho
if (isset($_GET['remover'])) {
    $id_produto = $_GET['remover'];
    foreach ($_SESSION['carrinho'] as $key => $item) {
        if ($item['id'] == $id_produto) {
            unset($_SESSION['carrinho'][$key]);
            break;
        }
    }
    $_SESSION['carrinho'] = array_values($_SESSION['carrinho']); // Reindexar array
}

// Função para limpar o carrinho inteiro
if (isset($_GET['limpar'])) {
    unset($_SESSION['carrinho']);
}

// Verificar se o carrinho não está vazio
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "Seu carrinho está vazio!";
    header("Refresh: 1; url=../visao/perfil.php");
    exit();
}

$carrinho = $_SESSION['carrinho'];
$total = 0;

foreach ($carrinho as $item) {
    // Garantir que 'preco' seja tratado como número para somar corretamente
    $preco = str_replace([','], ['.'], $item['preco']);
    $total += (float)$preco;
}

// Montar a mensagem para o WhatsApp
$mensagem = "Oi, gostaria de saber mais sobre os seguintes produtos:\n";
foreach ($carrinho as $item) {
    $preco_formatado = number_format((float)str_replace([','], ['.'], $item['preco']), 2, ',', '.');
    $mensagem .=  $item['nome'] . "  R$ " . $preco_formatado . "\n";
}
$mensagem .= "\nTotal: R$ " . number_format($total, 2, ',', '.');
$mensagem_encoded = urlencode($mensagem);
$numero_telefone = "5511953004751";

$url_whatsapp = "https://api.whatsapp.com/send?phone={$numero_telefone}&text={$mensagem_encoded}";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="../css/carrinho.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Sua Medida - Ateliê de costura</title>
</head>
<header>
    <div id="area_cabecalho">
        <div id="area_logo">
            <h1 id="cor_logo"><span style="color: black;">Sua</span><span style="color: #8C8C8C;">Medida</span></h1>
        </div>
    </div>
</header>        
<body>
    <div class="container-finalizarcmp">
        <h1 style="text-align: center;">Finalizar Compra</h1>
    
        <p>Itens no seu carrinho:</p>
        <ul>
            <?php foreach ($carrinho as $item): ?>

                <li>                    <!-- Exibir nome e preço corretamente -->
                    <strong><?php echo $item['nome']; ?></strong> - R$ <?php echo number_format((float)str_replace([','], ['.'], $item['preco']), 2, ',', '.'); ?>
                    <button> <a href="?remover=<?php echo $item['id']; ?>" onclick="return confirm('Tem certeza que deseja remover este item?');" style="color:white;">Remover</a> </button>
                    <br> 
                    <!-- Exibir imagem do produto -->
                    <img src="<?php echo $item['imagem']; ?>" alt="<?php echo $item['imagem']; ?>" style="width: 100px; height: auto;">
                </li>
            <?php endforeach; ?>
        </ul>
        <hr>
        <h3>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></h3>

        <div class="btn-container">
            <div id="btn_voltar">
                <a href="perfil.php" class="btn btn-danger">Voltar</a>
            </div>
            <br><br>

            <div id="btn_limpar">
                <a href="?limpar=true" onclick="return confirm('Tem certeza que deseja limpar o carrinho?');" class="btn btn-danger">Limpar Carrinho</a>
            </div>

            <br><br>

            <div id="btn_finalizar">
                <a href="<?php echo $url_whatsapp; ?>" class="btn btn-success" target="_blank">Finalizar Compra no WhatsApp</a>
            </div>
        </div>
    </div>
</body>
</html>
