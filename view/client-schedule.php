<?php
include '../model/conexao.php';
include("../model/session.php");

$pdo = Conexao::get_instance();
$sessao = new Sessao();
$sessao->valida_login_cliente();

$username = ($_SESSION['user']);

$name = "SELECT name FROM client WHERE user = ?";
$stmt = $pdo->prepare($name);
$stmt->execute([$username]);
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);


$professional_id = $_POST['professional_id'];
$service = "SELECT name FROM services WHERE professional_id = ?";
$stmt = $pdo->prepare($service);
$stmt->execute([$professional_id]);
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../assets/style.css" rel="stylesheet">
    <title>Agendamento de serviço</title>
     <style>
        #services{
            display: flex;
        }
        #service{
            border: solid green 1.5px;
            padding: 8px 10px;
            margin: 20px;
            transition: .3s;
            border-radius: 8px;
        }
        #service:hover{
            background-color: green;
            cursor: pointer;
        }

     </style>
</head>

<body>
<header>
    <?php foreach ($clients as $client): ?>
        <h1>Agende seu serviço,  <?= htmlspecialchars($client['name']); ?></h1>
    <?php endforeach; ?>
      
    <div>
        <a href="client-data.php">Meus Dados</a>
        <a href="client-view.php">Voltar</a>      
    </div>
</header>

<div id="container">
    <div id="service-container">
        <h1>Escolha o serviço desejado</h1>
        <div id="services">
        <?php foreach ($services as $service): ?>
            <a id="service"><?= htmlspecialchars($service['name']); ?></a>
        <?php endforeach; ?>
        </div>
    </div>
</div>

    

</body>

</html>