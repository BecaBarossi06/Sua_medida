<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $novaSenha = $_POST['nova_senha'];
    $confirmarSenha = $_POST['confirmar_senha'];

    if ($novaSenha === $confirmarSenha) {
        // Conectar ao banco de dados
        $conn = new mysqli('localhost', 'usuario', 'senha', 'suamedida');

        // Verificar se o token é válido
        $query = $conn->prepare("SELECT id FROM usuarios WHERE reset_token = ?");
        $query->bind_param("s", $token);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Atualizar a senha
            $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $query = $conn->prepare("UPDATE usuarios SET senha = ?, reset_token = NULL, reset_expiracao = NULL WHERE id = ?");
            $query->bind_param("si", $novaSenhaHash, $user['id']);
            $query->execute();

            echo "Senha redefinida com sucesso!";
        } else {
            echo "Token inválido.";
        }
    } else {
        echo "As senhas não coincidem.";
    }
}
?>