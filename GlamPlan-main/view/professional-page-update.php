<?php
include '../model/conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do profissional não fornecido.");
}

$sql = "SELECT * FROM professional WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$professional = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$professional) {
    die("Profissional não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $user = $_POST['user'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $expertise = $_POST['expertise'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $password = $_POST['password'] ?? $professional['password'];

    if (empty($user) || empty($cpf)) {
        die("Usuário e CPF são obrigatórios.");
    }

    $sql = "UPDATE professional SET name = ?, user = ?, password = ?, email = ?, phone = ?, expertise = ?, cpf = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $user, $password, $email, $phone, $expertise, $cpf, $id]);

    header("Location: professional-data.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Profissional</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div id="container-login">
        <h1>Editar Profissional</h1>
        <form action="professional-page-update.php?id=<?= $professional['id']; ?>" method="POST">
            <input type="text" placeholder="Nome" class="login-input" name="name" value="<?= htmlspecialchars($professional['name']); ?>">
            <input type="text" placeholder="Usuário" class="login-input" name="user" value="<?= htmlspecialchars($professional['user']); ?>" required>
            <input type="password" placeholder="Senha" class="login-input" name="password">
            <input type="text" placeholder="CPF" class="login-input" name="cpf" value="<?= htmlspecialchars($professional['cpf']); ?>" required>
            <input type="email" placeholder="Email" class="login-input" name="email" value="<?= htmlspecialchars($professional['email']); ?>">
            <input type="text" placeholder="Telefone" class="login-input" name="phone" value="<?= htmlspecialchars($professional['phone']); ?>">
            <input type="text" placeholder="Especialidade" class="login-input" name="expertise" value="<?= htmlspecialchars($professional['expertise']); ?>">
            <button type="submit" class="login-btn">Atualizar</button>
        </form>
        <p><a href="professional-data.php">Voltar</a></p>
       <p> <a href="service-register.php">Cadastrar Serviço</a> </p>
   
      <p>  <a href="schedule-register-service.php">Cadastrar Horários</a> </p>
   
    </div>
</body>
</html>
