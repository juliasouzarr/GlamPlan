<?php
include '../model/conexao.php';
include("../model/session.php");

$sessao = new Sessao();
$sessao->valida_login_profissional();

$username = ($_SESSION['user']);

$pdo = Conexao::get_instance();
$sql = "SELECT id, name FROM services";
$stmt = $pdo->query($sql);
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

$name = "SELECT name FROM professional WHERE user = ?";
$stmt = $pdo->prepare($name);
$stmt->execute([$username]);
$professionals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Horários</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <header>
        <h1>GlamPlan</h1>
        <div>
        <a href="service-register.php">Cadastrar Serviço</a>
        <a href="professional-data.php">Atualizar Meus Dados</a>
        <a href="professional-index.php">Voltar</a>
        </div>
       
    </header>

    <div id="container">
        <h1>Ajuste Seus Horários</h1>

    </div>
</body>
</html>
