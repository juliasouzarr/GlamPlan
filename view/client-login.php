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
        <form action="../controller/client-login-controller.php" method="POST">
            <?php if (isset($_SESSION['error'])): ?>
                <p style="color: red;"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
            <?php endif; ?>
            <input type="text" placeholder="Usuário" class="login-input" name="user" required>
            <input type="password" placeholder="Senha" class="login-input" name="password" required>
            <button type="submit" class="login-btn">Entrar</button>
        </form>
        <p>Ainda não possui uma conta? <a href="client-register.php">Cadastre-se!</a></p>
        <p>Esqueceu sua senha? <a href="password-recovery.php">Redefinir</a></p>
    </div>
</body>

</html>