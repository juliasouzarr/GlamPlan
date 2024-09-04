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
        <h1>Crie sua conta</h1>
        <form action="#">
            <input type="text" placeholder="Como você gostaria de ser chamado(a)?" class="login-input" name="name">
            <input type="text" placeholder="Nome de usuário *" class="login-input" name="user" required>
            <input type="password" placeholder="Senha *" class="login-input" name="password" required>
            <input type="email" placeholder="Email *" class="login-input" name="email" required>
            <input type="text" placeholder="Celular" class="login-input" name="phone">
            <label for="birth">Data de Nascimento:</label>
            <input type="date" class="login-input" name="birth">
            <input type="text" placeholder="Endereço" class="login-input" name="address">
            <input type="text" placeholder="Bairro" class="login-input" name="district">
            <button type="submit" class="login-btn">Cadastrar</button>
        </form>
        <p>Já possui uma conta? <a href="client-login.php">Faça login!</a></p>
    </div>
 
    
</body>

</html>