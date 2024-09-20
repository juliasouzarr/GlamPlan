<?php
session_start();

$id = $_POST['id']; 
$user = $_POST['user'];
$password = $_POST['password'];

try {
    $pdo = new PDO("mysql:host=localhost;dbname=glamplan", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

try {
  
    $stmt = $pdo->prepare("SELECT * FROM professional WHERE user = :user AND password = :password");
    $stmt->bindParam(':user', $user);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
 
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
     
        $_SESSION['user'] = $resultado['id'];
        header("Location: ../view/professional-index.php"); 
        exit(); 
    } else {
       
        header("Location: ../view/professional-login.php?error=USUARIO_INVALIDO");
        exit(); 
    }
} catch (PDOException $e) {
    die("Erro ao autenticar: " . $e->getMessage());
}
?>
