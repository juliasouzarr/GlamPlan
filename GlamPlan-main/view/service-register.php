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
        <h1>Cadastre um serviço</h1>
        <form action="../controller/insert-service.php" method="POST">
            <input type="text" placeholder="Nome do serviço" class="login-input" name="service" required>
            <input type="text" placeholder="Duração média" class="login-input" name="duration">
            <input type="text" placeholder="Valor médio" class="login-input" name="value" required>
            <button type="submit" class="login-btn">Cadastrar</button>
        </form>
        <p><a href="professional-index.php">Voltar</a></p>
    </div>
</body>
</html>
