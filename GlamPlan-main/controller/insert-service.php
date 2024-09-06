<?php
include '../model/conexao.php'; // Inclua o arquivo de conexão com o banco de dados

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
    $sql = "INSERT INTO service (name, duration, value) VALUES (?, ?, ?)";

    try {
        // Prepara e executa a consulta
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $duration, $value]);
        header("Location: ../view/service-data.php"); // Redireciona para a página de listagem
        exit();
    } catch (PDOException $e) {
        die("Erro ao cadastrar serviço: " . $e->getMessage());
    }
} else {
    // Se o método não for POST, redireciona para o formulário
    header("Location: ../view/service-register.php");
    exit();
}
?>
