<?php
include '../model/conexao.php'; 
$pdo = Conexao::get_instance();
$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do serviço não fornecido.");
}

// Recupera o serviço
$sql = "SELECT * FROM services WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$services = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$services) {
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
    $sql = "UPDATE services SET name = ?, duration = ?, value = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $duration, $value, $id]);

    header("Location:../view/professional-index.php"); 
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
        <form action="../view/service-edit.php?id=<?= $services['id']; ?>" method="POST">
            <input type="text" placeholder="Nome do serviço" class="login-input" name="service" value="<?= htmlspecialchars($services['name']); ?>" required>
            <input type="text" placeholder="Duração média" class="login-input" name="duration" value="<?= htmlspecialchars($services['duration']); ?>">
            <input type="text" placeholder="Valor médio" class="login-input" name="value" value="<?= htmlspecialchars($services['value']); ?>" required>
            <button type="submit" class="login-btn">Atualizar</button>
        </form>
        <p><a href="professional-index.php">Voltar</a></p>
    </div>
</body>
</html>
