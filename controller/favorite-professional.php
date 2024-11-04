<?php

include '../model/conexao.php';
$pdo = Conexao::get_instance();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_POST['client_id'];
    $professional_id = $_POST['professional_id'];
//    $service_id = $_POST['service_id'];

    if ($client_id && $professional_id) {
        $sql = "INSERT INTO favorites(client_id, professional_id, service_id) VALUES (?, ?, null)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$client_id, $professional_id]);

        // Redirecionar para a página de favoritos com um parâmetro de sucesso
        header("Location: ../view/favorites.php?success=1");
        exit();
    } else {
        // Redirecionar com erro se faltar algum dado
        header("Location: ../view/favorites.php?success=0");
        exit();
    }
}

