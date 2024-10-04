<?php
include '../model/conexao.php';

$pdo = Conexao::get_instance();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_id = $_POST['service_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $available = isset($_POST['available']) ? 1 : 0; // 1 se disponível, 0 se não

    // Inserir o novo horário na tabela schedules
    $sql = "INSERT INTO schedules (service_id, date, time, available) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$service_id, $date, $time, $available]);

    echo "Horário cadastrado com sucesso!";
}
?>
