<?php
require '../model/conexao.php'; // Inclua o arquivo de conexão

// Função para enviar o e-mail de recuperação
function sendRecoveryEmail($user, $userType) {
    // Gerar um token único
    $token = bin2hex(random_bytes(50)); // 100 caracteres hexadecimais

    // Salvar o token e o e-mail no banco de dados (exemplo simplificado)
    global $pdo; // Assume que $pdo é a instância PDO global
    $stmt = $pdo->prepare("INSERT INTO password_resets (user, token, user_type) VALUES (?, ?, ?)");
    $stmt->execute([$user, $token, $userType]);

    // Enviar o e-mail com o link de recuperação
    $recoveryLink = "http://localhost/GlamPlan-main/view/password-reset.php?token=$token";
    $subject = "Recuperação de Senha";
    $message = "Clique no link abaixo para recuperar sua senha:\n$recoveryLink";
    $headers = "From: no-reply@glamplan.com";

    mail($user, $subject, $message, $headers);
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'];
    $userType = $_POST['user_type'];

    if (!in_array($userType, ['client', 'professional'])) {
        die("Tipo de usuário inválido.");
    }

    // Validação básica do usuário
    if (empty($user)) {
        die("Usuário inválido.");
    }

    // Verifica se o usuário existe no banco de dados
    global $pdo; // Assume que $pdo é a instância PDO global

    $table = $userType === 'client' ? 'client' : 'professional';
    $column = 'user'; // Supondo que o nome do campo é 'user'
    $stmt = $pdo->prepare("SELECT id FROM $table WHERE $column = ?");
    $stmt->execute([$user]);
    if ($stmt->rowCount() === 0) {
        die("Nenhum usuário encontrado com esse nome.");
    }

    // Envia o e-mail de recuperação
    sendRecoveryEmail($user, $userType);

    echo "Um e-mail de recuperação foi enviado.";
}
?>
