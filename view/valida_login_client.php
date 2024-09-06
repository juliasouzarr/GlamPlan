<?php
session_start();

// Obtém os dados do formulário
$id = $_POST["id"]; 
$user = $_POST['user'];
$password = $_POST['password'];

try {
    // Estabelece a conexão com o banco de dados
    $pdo = new PDO("mysql:host=localhost;dbname=glamplan", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

try {
    // Prepara e executa a consulta SQL para validação do cliente
    $stmt = $pdo->prepare("SELECT * FROM client WHERE user = :user AND password = :password");
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    // Verifica se há um resultado
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        // Se usuário e senha estiverem corretos, cria uma sessão
        $_SESSION['user'] = $resultado['id'];
        header("Location: ../view/client-index.php"); // Redireciona para a página inicial
        exit(); // Garante que o script pare após o redirecionamento
    } else {
        // Se não houver resultado, redireciona de volta para a página de login
        header("Location: ../view/client-login.php"); // Ajuste o caminho conforme necessário
        exit(); // Garante que o script pare após o redirecionamento
    }
} catch (PDOException $e) {
    die("Erro ao autenticar: " . $e->getMessage());
}
?>
