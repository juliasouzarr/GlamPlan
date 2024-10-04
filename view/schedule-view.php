<?php
include '../model/conexao.php';
$pdo = Conexao::get_instance();

$sql = "SELECT schedules.id, schedules.date, schedules.time, services.name AS service
        FROM schedules
        JOIN services ON schedules.service_id = services.id
        WHERE schedules.available = 1";
$stmt = $pdo->query($sql);
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

$message = ''; // Variável para a mensagem de sucesso

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $schedule_id = $_POST['schedule_id'];
    $client_name = $_POST['client_name'];
    
    // Marcar horário como não disponível
    $sql = "UPDATE schedules SET available = 0 WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$schedule_id]);  
    
    // Inserir agendamento
    $sql = "INSERT INTO appointments (schedule_id, client_name) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$schedule_id, $client_name]);

    $message = "Agendamento inserido com sucesso!"; // Definindo a mensagem de sucesso
    // Redirecionar para a mesma página com a mensagem
    header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Serviço - GlamPlan</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montaga&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        /* Seus estilos aqui (mantive o CSS anterior) */
        * {
            margin: 0;
            padding: 0;
            font-family: "Montserrat", sans-serif;
        }

        body {
            background-color: #cdaeff;
            color: white;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40px 5%;
            border-bottom: solid rgba(255, 255, 255, 0.253) .5px;
        }

        header h1 {
            font-weight: 800;
            font-size: 40px;
        }

        header a {
            text-decoration: none;
            color: white;
            padding: 0 20px;
            font-weight: 500;
            transition: .3s;
        }

        header a:hover {
            color: rgb(0, 107, 0);
            font-weight: 700;
        }

        .container {
            width: 75%;
            margin: 60px auto;
        }

        .form-check {
            margin: 10px 0;
        }

        .form-label {
            margin-top: 20px;
        }

        .btn {
            background-color: rgb(0, 107, 0);
            border: none;
            border-radius: 8px;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            transition: .4s;
        }

        .btn:hover {
            background-color: rgb(0, 179, 0);
            cursor: pointer;
        }

        .alert {
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 8px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>GlamPlan</h1>
        <nav>
            <a href="client-data.php">Atualizar Dados</a>
            <a href="client-view.php">Profissionais Disponíveis</a>
            <a href="schedule-view.php">Agendar Serviço</a>
            <a href="client-index.php">Voltar</a>
        </nav>
    </header>

    <div class="container">
        <h2>Escolha o horário desejado</h2>
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success">
                Agendamento inserido com sucesso!
            </div>
        <?php endif; ?>

        <form action="../view/schedule-view.php" method="POST">
            <?php if (count($schedules) > 0): ?>
                <?php foreach ($schedules as $schedule): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="schedule_id" value="<?= $schedule['id'] ?>" required>
                        <label class="form-check-label">
                            <?= htmlspecialchars($schedule['service']) ?> - <?= htmlspecialchars($schedule['date']) ?> às <?= htmlspecialchars($schedule['time']) ?>
                        </label>
                    </div>
                <?php endforeach; ?>
                <label for="client_name" class="form-label">Seu nome</label>
                <input type="text" class="login-input" name="client_name" required>
                <button type="submit" class="btn">Agendar</button>
            <?php else: ?>
                <p>Sem horários disponíveis.</p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
