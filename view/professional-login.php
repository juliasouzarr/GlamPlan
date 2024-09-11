<?php
session_start(); // Inicia a sessão

include '../model/conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'];
    $password = $_POST['password']; 

    $sql = "SELECT id, password FROM professional WHERE user = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $professional = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($professional && $password === $professional['password']) { // Comparar diretamente sem hash
        // Senha correta, armazena o ID do profissional na sessão
        $_SESSION['id'] = $professional['id'];
        header("Location: ../view/professional-index.php");
        exit();
    } else {
        echo "Usuário ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlamPlan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div id="container-login">
        <h1>Acesse sua conta</h1>
        <form action="professional-login.php" method="POST">
            <input type="text" placeholder="Usuário" class="login-input" name="user">
            <input type="password" placeholder="Senha" class="login-input" name="password">
            <button type="submit" class="login-btn">Entrar</button>
        </form>
        <p>Ainda não possui uma conta? <a href="professional-register.php">Cadastre-se!</a></p>
        <p>Esqueceu sua senha? <a href="password-recovery.php">Redefinir</a></p>
    </div>
</body>
</html>
