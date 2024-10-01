<?php
$servername = "localhost";  // ou o nome do seu servidor
$username = "root";  // nome de usuário do banco
$password = "";  // senha do banco (pode estar vazia se você estiver usando XAMPP)
$dbname = "suamedida";  // nome do banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>