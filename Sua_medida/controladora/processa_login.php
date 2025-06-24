<?php
session_start();
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['pswd'];

    if (!empty($email) && !empty($senha)) {
        $sql = "SELECT id, nome, email, senha, perfil FROM usuarios WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $nome, $email, $senha_hashed, $perfil);
                $stmt->fetch();

                if (password_verify($senha, $senha_hashed)) {
                    // Inicia a sessão e armazena as informações do usuário
                    $_SESSION['id'] = $id;
                    $_SESSION['nome'] = $nome;
                    $_SESSION['email'] = $email;
                    $_SESSION['perfil'] = $perfil;
                    if($perfil == 'admin'){
                        header("Location: ../visao/admin.php");
                    }else{
                        header("Location: ../visao/perfil.php");
                    }
                    
                    exit();
                } else {
                    echo "Senha inválida.";
                }
            } else {
                echo "Usuário não encontrado.";
                header("Refresh: 2; url=../visao/index.php"); // Redireciona após 2 segundos para a página de login
                exit();
            }
            $stmt->close();
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
    $conn->close();
}
?>

