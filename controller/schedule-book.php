<?php
include '../model/conexao.php';

$pdo = Conexao::get_instance();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $schedule_id = $_POST['schedule_id'];
    $client_name = $_POST['client_name'];

    // Atualizar o horário como não disponível
    $sql = "UPDATE schedules SET available = 0 WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$schedule_id]);

    // Inserir o agendamento na tabela appointments
    $sql = "INSERT INTO appointments (schedule_id, client_name) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$schedule_id, $client_name]);

    echo "Agendamento inserido com sucesso!";
}
?>
