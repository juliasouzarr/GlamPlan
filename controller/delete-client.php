<?php
include '../model/conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do cliente não fornecido.");
}

try {
    // Preparar e executar a consulta para excluir o cliente
    $sql = "DELETE FROM client WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Destruir a sessão do usuário
    session_start(); // Inicia a sessão
    session_unset();  // Remove todas as variáveis da sessão
    session_destroy(); // Destrói a sessão

    // Redirecionar para a página de login ou qualquer outra página
    header("Location: ../view/client-login.php");
    exit();
} catch (PDOException $e) {
    die("Erro ao excluir cliente: " . $e->getMessage());
}
?>
