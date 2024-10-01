<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div id="container-login">
        <h1>Redefinir Senha</h1>
        <?php
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            // Validar o token e obter o e-mail e tipo de usuário associado
            // Isso pode incluir a validação do token e a verificação se ele é válido
            ?>
            <form action="../controller/password-reset.php" method="post">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <input type="password" placeholder="Nova senha" class="login-input" name="password" required>
                <button type="submit" class="login-btn">Redefinir Senha</button>
            </form>
            <?php
        } else {
            echo "Token inválido.";
        }
        ?>
    </div>
</body>
</html>
