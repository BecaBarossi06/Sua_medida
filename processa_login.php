<?php
session_start();
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['pswd'];

    // Verifica se o email e a senha foram fornecidos
    if (!empty($email) && !empty($senha)) {
        // Prepara o comando SQL para buscar o usuário
        $sql = "SELECT id, nome, email, senha, perfil FROM usuarios WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $nome, $email_db, $senha_hash, $perfil);
                $stmt->fetch();
                // Verifica a senha
                if (password_verify($senha, $senha_hash)) {
                    // Inicia a sessão e armazena as informações do usuário
                    $_SESSION['id'] = $id;
                    $_SESSION['nome'] = $nome;
                    $_SESSION['email'] = $email_db;
                    $_SESSION['perfil'] = $perfil;
                    header("Location: perfil.php");
                    exit();
                } else {
                    echo "Senha inválida.";
                }
            } else {
                echo "Usuário não encontrado.";
            }
            $stmt->close();
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
    $conn->close();
}
?>
