<?php 

include 'config-conexao.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$atividade_id = $_GET['id'];

$sql = "DELETE FROM atividades WHERE id='$atividade_id' AND usuario_id='$usuario_id'";

if ($conn->query($sql) === TRUE) {
    echo "deletou";
} else {
    echo "Erro ao deletar atividade: " . $conn->error;
}

header("Location: atividades");
$conn->close();

?>