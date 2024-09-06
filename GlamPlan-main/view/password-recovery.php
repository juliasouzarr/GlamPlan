<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div id="container-login">
        <h1>Recuperação de Senha</h1>
        <form action="../controller/password-recovery-request.php" method="post">
            <input type="text" placeholder="Digite seu usuário" class="login-input" name="user" required>
            <select name="user_type" class="login-input">
                <option value="client">Cliente</option>
                <option value="professional">Profissional</option>
            </select>
            
            <button type="submit" class="login-btn">Enviar Link de Recuperação</button>
        </form>
        <p><a href="client-login.php">Voltar ao Login</a></p>
    </div>
</body>
</html>
