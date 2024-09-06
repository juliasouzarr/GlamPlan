<?php
include '../model/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $user = $_POST['user'] ?? '';
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $birth = $_POST['birth'] ?? '';
    $address = $_POST['address'] ?? '';
    $district = $_POST['district'] ?? '';

    if (empty($name) || empty($user) || empty($password) || empty($email)) {
        die("Nome, usuário, senha e email são obrigatórios.");
    }

    $sql = "INSERT INTO client (name, user, password, email, phone, birth, address, district) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $user, $password, $email, $phone, $birth, $address, $district]);
        header("Location: ../view/client-data.php");
        exit();
    } catch (PDOException $e) {
        die("Erro ao cadastrar cliente: " . $e->getMessage());
    }
} else {
    header("Location: ../view/client-register.php");
    exit();
}
?>
