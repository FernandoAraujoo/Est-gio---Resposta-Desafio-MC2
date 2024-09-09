<?php // configurações necessárias para a execução do código
$host = "localhost";
$user = "root";
$pass = "";
$db = "agenda";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>