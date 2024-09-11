<?php
include '../model/conexao.php'; // Inclua o arquivo de conexão com o banco de dados

// Obtém a instância da conexão
$pdo = Conexao::get_instance();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $serviceId = $_POST['service_id'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $available = isset($_POST['available']) ? 1 : 0; // Checkbox é 1 se marcado, 0 se não marcado

    // Valida os dados
    if (empty($serviceId) || empty($date) || empty($time)) {
        die("Todos os campos são obrigatórios.");
    }

    // Prepara a consulta para inserção
    $sql = "INSERT INTO schedules (service_id, date, time, available) VALUES (?, ?, ?, ?)";

    try {
        // Prepara e executa a consulta
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$serviceId, $date, $time, $available]);

        // Redireciona após o salvamento
        header('Location: ../view/schedule-register-service.php');
        exit();
    } catch (PDOException $e) {
        die("Erro ao cadastrar horário: " . $e->getMessage());
    }
} else {
    // Se não for um POST, redireciona
    header('Location: ../view/schedule-register-service.php');
    exit();
}
?>
