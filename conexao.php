<?php

error_reporting(E_ALL);
ini_set('display_error',1);



$servername = "localhost";  // ou o nome do seu servidor
$username = "ifhostgru_suamedida";  // nome de usuário do banco
$password = "ifspgru@2022";  // senha do banco (pode estar vazia se você estiver usando XAMPP)
$dbname = "ifhostgru_suamedida";  // nome do banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>