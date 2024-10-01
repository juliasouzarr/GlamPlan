<?php 
include("../model/client-session.php");
$sessao = new Sessao();
$sessao->valida_login();
?>

<?php
include '../model/conexao.php';
$pdo = Conexao::get_instance();
$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do cliente não fornecido.");
}

$sql = "SELECT * FROM client WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$client = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$client) {
    die("Cliente não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $user = $_POST['user'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $birth = $_POST['birth'] ?? '';
    $address = $_POST['address'] ?? '';
    $district = $_POST['district'] ?? '';
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $client['password'];

    if (empty($name) || empty($user) || empty($email)) {
        die("Nome, usuário e email são obrigatórios.");
    }

    $sql = "UPDATE client SET name = ?, user = ?, password = ?, email = ?, phone = ?, birth = ?, address = ?, district = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $user, $password, $email, $phone, $birth, $address, $district, $id]);

    header("Location: client-data.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div id="container-login">
        <h1>Editar Cliente</h1>
        <form action="client-page-update.php?id=<?= $client['id']; ?>" method="POST">
            <input type="text" placeholder="Nome" class="login-input" name="name" value="<?= htmlspecialchars($client['name']); ?>" required>
            <input type="text" placeholder="Usuário" class="login-input" name="user" value="<?= htmlspecialchars($client['user']); ?>" required>
            <input type="password" placeholder="Senha (deixe em branco para não alterar)" class="login-input" name="password">
            <input type="email" placeholder="Email" class="login-input" name="email" value="<?= htmlspecialchars($client['email']); ?>" required>
            <input type="text" placeholder="Telefone" class="login-input" name="phone" value="<?= htmlspecialchars($client['phone']); ?>">
            <input type="date" class="login-input" name="birth" value="<?= htmlspecialchars($client['birth']); ?>">
            <input type="text" placeholder="Endereço" class="login-input" name="address" value="<?= htmlspecialchars($client['address']); ?>">
            <input type="text" placeholder="Bairro" class="login-input" name="district" value="<?= htmlspecialchars($client['district']); ?>">
            <button type="submit" class="login-btn">Atualizar</button>
        </form>
        <p><a href="client-data.php">Voltar</a></p>
    </div>
</body>
</html>
