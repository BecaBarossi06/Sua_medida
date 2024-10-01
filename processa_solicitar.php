<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Conexão com o banco de dados
    $conn = new mysqli('localhost', 'usuario', 'senha', 'suamedida');

    // Verificar se o e-mail existe no banco de dados
    $query = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Gerar um token de redefinição único
        $token = bin2hex(random_bytes(32)); // Token único de 64 caracteres
        $expiracao = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token válido por 1 hora

        // Salvar o token e a data de expiração no banco de dados
        $query = $conn->prepare("UPDATE usuarios SET reset_token = ?, reset_expiracao = ? WHERE id = ?");
        $query->bind_param("ssi", $token, $expiracao, $user['id']);
        $query->execute();

        // Montar o link de redefinição de senha
        $resetLink action="processa_solicitar.php" . $token;

        // Enviar e-mail para o usuário
        $to = $email;
        $subject = "Redefinição de Senha";
        $message = "Clique no link abaixo para redefinir sua senha:\n\n" . $resetLink;
        $headers = 'From: no-reply@seusite.com' . "\r\n" .
                   'Reply-To: no-reply@seusite.com' . "\r\n" .
                   'X-Mailer: PHP/' . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            echo "Um e-mail foi enviado para $email com instruções para redefinir sua senha.";
        } else {
            echo "Erro ao enviar e-mail. Tente novamente.";
        }
    } else {
        echo "E-mail não encontrado.";
    }
}
?>