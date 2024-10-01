<?php
// Verificar se o formulário foi enviado
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Conectar ao banco de dados
    $conn = new mysqli('localhost', 'root', '', 'suamedida');

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
    }

    // Verificar se o e-mail existe no banco de dados
    $query = $conn->prepare("SELECT id, reset_expiracao FROM usuarios WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $expiracao = $user['reset_expiracao'];

        if (strtotime($expiracao) > time()) {
            // O token é válido e não expirou, exibir o formulário de redefinição de senha
            ?>
            <form method="POST" action="processa_redefinicao.php">
                <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <label for="nova_senha">Nova Senha:</label>
                <input type="password" name="nova_senha" required>
                <label for="confirmar_senha">Confirmar Senha:</label>
                <input type="password" name="confirmar_senha" required>
                <button type="submit">Redefinir Senha</button>
            </form>
            <?php
        } else {
            echo "O link de redefinição de senha expirou.";
        }
    } else {
        echo "E-mail não encontrado.";
    }

    $query->close();
    $conn->close();
} else {
    // Exibir o formulário para o usuário inserir o e-mail
    ?>
    <form method="POST" action="">
        <label for="email">Digite seu e-mail para redefinir a senha:</label>
        <input type="email" name="email" required>
        <button type="submit">Enviar</button>
    </form>
    <?php
}
?>
