<?php
include '../model/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $user = $_POST['user'] ?? '';
    $password = $_POST['password'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $expertise = $_POST['expertise'] ?? '';

    if (empty($user) || empty($password) || empty($cpf)) {
        die("Usuário, senha e CPF são obrigatórios.");
    }

    $sql = "INSERT INTO professional (name, user, password, cpf, email, phone, expertise) VALUES (?, ?, ?, ?, ?, ?, ?)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $user, $password, $cpf, $email, $phone, $expertise]);
        header("Location: ../view/professional-data.php");
        exit();
    } catch (PDOException $e) {
        die("Erro ao cadastrar profissional: " . $e->getMessage());
    }
} else {
    header("Location: ../view/professional-register.php");
    exit();
}
?>
