<?php
$servername = "144.217.39.54";  // IP do servidor do banco de dados
$username = "hostdeprojetos";  // Usuário
$password = "ifspgru@2022";  // Senha
$dbname = "hostdeprojetos_suamedida";  // Nome do banco

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

echo "";
?>
