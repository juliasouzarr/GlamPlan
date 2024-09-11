<?php
session_start(); // Inicia a sessão

include '../model/conexao.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'];
    $password = $_POST['password']; 

   
    $sql = "SELECT id, password FROM client WHERE user = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($client && password_verify($password, $client['password'])) {
        // Senha correta, armazena o ID do cliente na sessão
        $_SESSION['id'] = $client['id'];
        header("Location: ../view/client-index");
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
        <form action="valida_login_client.php" method="POST">
            <input type="text" placeholder="Usuário" class="login-input" name="user">
            <input type="password" placeholder="Senha" class="login-input" name="password">
            <button type="submit" class="login-btn">Entrar</button>
        </form>
        <p>Ainda não possui uma conta? <a href="client-register.php">Cadastre-se!</a></p>
        <p>Esqueceu sua senha? <a href="password-recovery.php">Redefinir</a></p>
    </div>
</body>
</html>