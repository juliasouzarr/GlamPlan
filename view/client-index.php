<?php 
include '../model/conexao.php';
include ("../model/session.php");
$sessao = new Sessao();
$sessao->valida_login_cliente();
$pdo = Conexao::get_instance();
$username = ($_SESSION['user']);
$sql = "SELECT * FROM client WHERE user = ?";
$stmt = $pdo->prepare($sql);         
$stmt->execute([$username]);
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>GlamPlan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <header>
    <?php foreach ($clients as $client): ?>
        <h1>Seja bem vindo(a),  <?= htmlspecialchars($client['name']); ?></h1>
        <?php endforeach; ?>
      
        <div>
            <a href="client-data.php">Meus Dados</a>
            <a href="client-view.php">Profissionais Disponíveis</a>
            <a href="leave.php" onclick="return confirm('Tem certeza que deseja sair da sua conta?');">Sair</a>
           
        </div>
    </header>

    <div id="container">
        <div id="container-services">
        <h1>Meus agendamentos</h1>
            <!-- ADICIONAR PHP FOREACH PARA TRAZER OS AGENDAMENTOS VIA SELECT NO BANCO (TABELA SERVICOS) 
            ADICIONAR ÍCONE DE LIXEIRA PARA DELETAR SERVIÇO (LINKAR BOOTSTRAP OU USAR ICONE)-->
        </div>
    </div>

</body>

</html>