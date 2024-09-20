<?php

$username = $_POST['user'];
$password = $_POST['password'];

session_start();

require_once '../model/client.class.php';


// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $username = isset($_POST['user']) ? trim($_POST['user']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    
    $userModel = new Client();
    $user = $userModel->login($username, $password);
    
    if ($user) {
        $_SESSION['user'] = $user['user'];
        $_SESSION['password'] = $user['password'];
        header('Location: ../view/client-index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Credenciais inválidas. Por favor, tente novamente.';
    }
} else {
    $_SESSION['error'] = 'Método de requisição inválido.';
}

require_once '../view/client-login.php';


