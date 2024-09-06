<?php
include '../model/conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do cliente não fornecido.");
}

$sql = "DELETE FROM client WHERE id = ?";
$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([$id]);
    header("Location: client-data.php");
    exit();
} catch (PDOException $e) {
    die("Erro ao excluir cliente: " . $e->getMessage());
}
?>
