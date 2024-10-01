<?php
include '../model/conexao.php'; 
$pdo = Conexao::get_instance();
$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do serviço não fornecido.");
}
$sql = "DELETE FROM services WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: ../view/professional-login.php"); 
exit();
?>
