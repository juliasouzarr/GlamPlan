<?php
include '../model/conexao.php'; // Inclua o arquivo de conexão com o banco de dados

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do serviço não fornecido.");
}

// Exclui o serviço
$sql = "DELETE FROM service WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: ../view/service-data.php"); // Redireciona para a página de listagem
exit();
?>
