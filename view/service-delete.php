<?php
include '../model/conexao.php'; 
$pdo = Conexao::get_instance();
$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do serviço não fornecido.");
}
$sql = "DELETE FROM services WHERE id = ?";
$stmt = $pdo->prepare(query: $sql);
$stmt->execute(params: [$id]);

header(header: "Location: ../view/professional-index.php"); 
exit();
?>
