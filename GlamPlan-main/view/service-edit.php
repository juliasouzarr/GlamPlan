<?php
include '../model/conexao.php'; // Inclua o arquivo de conexão com o banco de dados

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do serviço não fornecido.");
}

// Recupera o serviço
$sql = "SELECT * FROM service WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$service = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$service) {
    die("Serviço não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['service'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $value = $_POST['value'] ?? '';

    if (empty($name) || empty($value)) {
        die("Nome do serviço e valor são obrigatórios.");
    }

    // Atualiza o serviço
    $sql = "UPDATE service SET name = ?, duration = ?, value = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $duration, $value, $id]);

    header("Location:../view/service-data.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Serviço</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div id="container-login">
        <h1>Editar Serviço</h1>
        <form action="service-edit.php?id=<?= $service['id']; ?>" method="POST">
            <input type="text" placeholder="Nome do serviço" class="login-input" name="service" value="<?= htmlspecialchars($service['name']); ?>" required>
            <input type="text" placeholder="Duração média" class="login-input" name="duration" value="<?= htmlspecialchars($service['duration']); ?>">
            <input type="text" placeholder="Valor médio" class="login-input" name="value" value="<?= htmlspecialchars($service['value']); ?>" required>
            <button type="submit" class="login-btn">Atualizar</button>
        </form>
        <p><a href="service-data.php">Voltar</a></p>
    </div>
</body>
</html>
