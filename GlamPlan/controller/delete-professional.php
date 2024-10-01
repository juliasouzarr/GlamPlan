<?php
include '../model/conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do profissional não fornecido.");
}

try {
    // Preparar e executar a consulta para excluir o profissional
    $sql = "DELETE FROM professional WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    // Destruir a sessão do usuário
    session_start(); // Inicia a sessão
    session_unset();  // Remove todas as variáveis da sessão
    session_destroy(); // Destrói a sessão

    // Redirecionar para a página de login ou qualquer outra página
    header("Location: ../view/professional-login.php");
    exit();
} catch (PDOException $e) {
    die("Erro ao excluir profissional: " . $e->getMessage());
}
?>
