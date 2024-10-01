<?php
include '../model/conexao.php';


$pdo = Conexao::get_instance();
$sql = "SELECT id, name FROM services";
$stmt = $pdo->query($sql);
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlamPlan - Cadastro de Horários</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <header>
        <h1>GlamPlan</h1>
        <div>
        <a href="service-register.php">Cadastrar Serviço</a>
        <a href="professional-index.php">Voltar</a>
        </div>
       
    </header>

    <div id="container">
        <h1>Cadastro de Horários</h1>
        <form action="../controller/schedule-save.php" method="POST">
            <label for="service">Serviço:</label>
            <select id="service" name="service_id" required>
                <option value="">Selecione um serviço</option>
                <?php foreach ($services as $service): ?>
                <option value="<?= htmlspecialchars($service['id']); ?>">
                    <?= htmlspecialchars($service['name']); ?>
                </option>
                <?php endforeach; ?>
            </select>
            <label for="date">Data:</label>
            <input type="date" id="date" name="date" required>
            <label for="time">Horário:</label>
            <input type="time" id="time" name="time" required>
            <label for="available">
                <input type="checkbox" id="available" name="available" checked>
                Disponível
            </label>
            <button type="submit" class="login-btn">Salvar Horário</button>
        </form>
    </div>
</body>
</html>
