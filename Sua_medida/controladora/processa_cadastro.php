<?php
session_start();
// Incluir arquivo de conexão
include("conexao.php");


// Função para validar a senha
function validarSenha($senha)
{
    // Definindo as variáveis para contar os tipos de caracteres
    $upperChars = 0;
    $lowerChars = 0;
    $specialChars = 0;
    $digits = 0;
    $length = strlen($senha);

    // Verifica se a senha tem pelo menos 6 caracteres
    if ($length < 6) {
        echo "A senha é muito curta. Sua senha deve possuir mais de seis dígitos.";
        header("Refresh: 4; url=../visao/index.php");
        exit();
    }

    // Verificando os critérios da senha
    for ($i = 0; $i < $length; $i++) {
        if (ctype_upper($senha[$i])) {
            $upperChars++;
        } elseif (ctype_lower($senha[$i])) {
            $lowerChars++;
        } elseif (ctype_digit($senha[$i])) {
            $digits++;
        } else {
            $specialChars++;
        }
    }

    // Verifica se todos os critérios estão atendidos
    if ($upperChars == 0) {
        echo "Senha Fraca! Sua senha deve conter Letra Maiúscula.";
        header("Refresh: 4; url=../visao/index.php");
        exit();
    }
    if ($lowerChars == 0) {
        echo "Senha Fraca! Sua senha deve conter Letra Minúscula.";
        header("Refresh: 4; url=../visao/index.php");
        exit();
    }
    if ($digits == 0) {
        echo "Senha Fraca! Sua senha deve conter Número.";
        header("Refresh: 4; url=../visao/index.php");
        exit();
    }
    if ($specialChars == 0) {
        echo "Senha Fraca! Sua senha deve conter Caracter Especial.";
        header("Refresh: 4; url=../visao/index.php");
        exit();
    }

    // Verifica a força da senha
    if ($length >= 10) {
        return "A força de sua senha é Forte.";
    } else {
        return "A força de sua senha é Média.";
    }
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['pswd'];

    // Valida os dados (simples validação de exemplo)
    if (!empty($nome) && !empty($email) && !empty($senha)) {
        // Valida a senha
        $resultadoValidacao = validarSenha($senha);

        // Se a senha for válida, realiza o cadastro
        if ($resultadoValidacao === "A força de sua senha é Forte." || $resultadoValidacao === "A força de sua senha é Média.") {
            // Hash da senha para segurança
            $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

            // Prepara o comando SQL para inserir os dados no banco
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";

            // Usa uma declaração preparada para prevenir SQL Injection
            if ($stmt = $conn->prepare($sql)) {
                // Vincula os parâmetros (deve ser feito após o hash da senha)
                $stmt->bind_param("sss", $nome, $email, $senha_hashed);

                // Executa a consulta
                if ($stmt->execute()) {
                    // Exibe mensagem de sucesso e redireciona
                    echo "Usuário cadastrado com sucesso!";
                    header("Refresh: 2; url=../visao/login.php"); // Redireciona após 2 segundos para a página de login
                    exit();
                } else {
                    echo "Erro ao cadastrar usuário: " . $stmt->error;
                }

                // Fecha a declaração
                $stmt->close();
            }
        } else {
            // Exibe a mensagem de erro da validação de senha
            echo "<p>$resultadoValidacao</p>";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
        header("Refresh: 4; url=../visao/index.php");
    }
}

// Fecha a conexão com o banco
$conn->close();
