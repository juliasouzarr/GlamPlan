<?php
include '../model/conexao.php'; // Inclua o arquivo de conexão com o banco de dados
include("../model/session.php");

$pdo = Conexao::get_instance();
$sessao = new Sessao();
$sessao->valida_login_profissional();

$username = ($_SESSION['user']);

$name = "SELECT id FROM professional WHERE user = ?";
$stmt = $pdo->prepare($name);
$stmt->execute([$username]);
$professionals = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtém a instância da conexão
$pdo = Conexao::get_instance();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $name = $_POST['service'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $value = $_POST['value'] ?? '';
    

    // Valida os dados
    if (empty($name) || empty($value)) {
        die("Nome do serviço e valor são obrigatórios.");
    }

    // Prepara a consulta para inserção
   
    foreach ($professionals as $professional): 
    $teste = $professional['id'] ?? '';
    endforeach; 

    $sql = "INSERT INTO services (name, duration, value, professional_id) VALUES (?, ?, ?, ?)";


    try {
        // Prepara e executa a consulta
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $duration, $value, $teste]);
        header("Location: ../view/professional-index.php"); // Redireciona para a página de listagem
        exit();
    } catch (PDOException $e) {
        die("Erro ao cadastrar serviço: " . $e->getMessage());
    }
} else {
    // Se o método não for POST, redireciona para o formulário
    header("Location: ../view/service-register.php");
    exit();
}

