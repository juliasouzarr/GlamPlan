<?php
include '../model/conexao.php';

// Consulta para obter os horários disponíveis
$sql = "SELECT schedules.id, schedules.date, schedules.time, services.name AS service
        FROM schedules
        JOIN services ON schedules.service_id = services.id
        WHERE schedules.available = 1";
$stmt = $pdo->query($sql);
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $schedule_id = $_POST['schedule_id'];
    $client_name = $_POST['client_name'];

    // Atualiza o horário como indisponível
    $sql = "UPDATE schedules SET available = 0 WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$schedule_id]);

    // Insere o agendamento
    $sql = "INSERT INTO appointments (schedule_id, client_name) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$schedule_id, $client_name]);

    echo "Agendamento inserido com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment - GlamPlan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Escolha o horário desejado</h1>
    <form action="../view/schedule-view.php" method="POST">
        <?php if (count($schedules) > 0): ?>
            <?php foreach ($schedules as $schedule): ?>
                <div>
                    <input type="radio" name="schedule_id" value="<?= $schedule['id'] ?>" required>
                    <?= htmlspecialchars($schedule['service']) ?> - <?= htmlspecialchars($schedule['date']) ?> at <?= htmlspecialchars($schedule['time']) ?>
                </div>
            <?php endforeach; ?>
            <label for="client_name">Seu nome</label>
            <input type="text" name="client_name" required>

            <button type="submit">Agendar</button>
        <?php else: ?>
            <p>Sem horários disponíveis.</p>
        <?php endif; ?>
    </form>
</body>
</html>
