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
    $stmt = $pdo->prepare("SELECT * FROM professional WHERE user = :user AND password = :password");
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    // Obtém o resultado
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        // Se usuário e senha estiverem corretos, cria uma sessão
        $_SESSION['user'] = $resultado['id'];
        header("Location: ../view/professional-index.php"); // Redireciona para a página inicial do cliente
        exit(); // Garante que o script pare após o redirecionamento
    } else {
        // Se não houver resultado, redireciona de volta para a página de login
        header("Location: ../view/professional-login.php?error=USUARIO_INVALIDO"); // Adiciona um parâmetro de erro à URL
        exit(); // Garante que o script pare após o redirecionamento
    }
} catch (PDOException $e) {
    die("Erro ao autenticar: " . $e->getMessage());
}
?>
