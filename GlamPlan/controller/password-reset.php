<?php
require '../model/conexao.php'; // Inclua o arquivo de conexão

// Função para atualizar a senha
function resetPassword($token, $password) {
    global $pdo; // Assume que $pdo é a instância PDO global

    // Verificar o token
    $stmt = $pdo->prepare("SELECT email, user_type FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);
    $reset = $stmt->fetch();
    
    if (!$reset) {
        die("Token inválido.");
    }

    $email = $reset['email'];
    $userType = $reset['user_type'];
    $table = $userType === 'client' ? 'client' : 'professional';

    // Atualizar a senha
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("UPDATE $table SET password = ? WHERE email = ?");
    $stmt->execute([$hashedPassword, $email]);

    // Remover o token usado
    $stmt = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
    $stmt->execute([$token]);

    echo "Senha redefinida com sucesso.";
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $password = $_POST['password'];

    // Validação básica da senha
    if (strlen($password) < 6) {
        die("A senha deve ter pelo menos 6 caracteres.");
    }

    // Redefinir a senha
    resetPassword($token, $password);
}
?>
