<?php
session_start();
$carrinho = $_SESSION['carrinho'] ?? [];
?>

<h1>Meu Carrinho</h1>
<table border="1">
    <thead>
        <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $total = 0;
        foreach ($carrinho as $item): 
            $subtotal = $item['preco'] * $item['quantidade'];
            $total += $subtotal;
        ?>
            <tr>
                <td><?=$item['nome']?></td>
                <td>R$ <?=number_format($item['preco'], 2, ',', '.')?></td>
                <td><?=$item['quantidade']?></td>
                <td>R$ <?=number_format($subtotal, 2, ',', '.')?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">Total</td>
            <td>R$ <?=number_format($total, 2, ',', '.')?></td>
        </tr>
    </tfoot>
</table>
