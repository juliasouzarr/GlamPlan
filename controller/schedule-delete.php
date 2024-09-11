<?php
include '../model/conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do agendamento não fornecido.");
}

try {
    // Inicia a transação
    $pdo->beginTransaction();

    // Remove o agendamento
    $sql = "DELETE FROM appointments WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Atualiza o horário como disponível
    $sql = "UPDATE schedules SET available = 1 WHERE id = (SELECT schedule_id FROM appointments WHERE id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Confirma a transação
    $pdo->commit();

    header("Location: ../view/schedule-register-service.php");
    exit();
} catch (PDOException $e) {
    // Reverte a transação em caso de erro
    $pdo->rollBack();
    die("Erro ao excluir agendamento: " . $e->getMessage());
}
?>
