<?php
include '../model/conexao.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM professional WHERE id = ?";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        header("Location: ../view/professional-data.php");
        exit();
    } catch (PDOException $e) {
        die("Erro ao excluir profissional: " . $e->getMessage());
    }
} else {
    header("Location:../view/professional-data.php");
    exit();
}
?>
