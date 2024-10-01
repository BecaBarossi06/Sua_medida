<?php
// Incluir arquivo de conexão
include("conexao.php");

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['pswd'];

    // Valida os dados (simples validação de exemplo)
    if (!empty($nome) && !empty($email) && !empty($senha)) {
        // Prepara o comando SQL para inserir os dados no banco
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";

        // Usa uma declaração preparada para prevenir SQL Injection
        if ($stmt = $conn->prepare($sql)) {
            // Vincula os parâmetros
            $stmt->bind_param("sss", $nome, $email, $senha_hashed);

            // Hash da senha para segurança
            $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

            // Executa a consulta
            if ($stmt->execute()) {
                // Exibe mensagem de sucesso e redireciona
                echo "Usuário cadastrado com sucesso!";
                header("Refresh: 2; url=login.php"); // Redireciona após 2 segundos para a página de login
                exit();
            } else {
                echo "Erro ao cadastrar usuário: " . $stmt->error;
            }

            // Fecha a declaração
            $stmt->close();
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}

// Fecha a conexão com o banco
$conn->close();
?>
