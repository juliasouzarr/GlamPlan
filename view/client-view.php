<?php
include '../model/conexao.php';
$pdo = Conexao::get_instance();

$sql = "SELECT * FROM professional";
$stmt = $pdo->query($sql);
$professionals = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h1>GlamPlan</h1>
        <div>
            <a href="client-data.php">Atualizar Dados</a>
            <a href="client-view.php">Profissionais Disponíveis</a>
            <a href="schedule-view.php">Agendar serviço</a>
            <a href="client-index.php">Voltar</a>
           
        </div>
    </header>

    <div id="container">
        <div id="container-services">
        <h1>Conheça nossos profissionais</h1>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Especialidade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($professionals as $professional): ?>
                <tr>
                    <td><?= htmlspecialchars($professional['name']); ?></td>
                    <td><?= htmlspecialchars($professional['email']); ?></td>
                    <td><?= htmlspecialchars($professional['phone']); ?></td>
                    <td><?= htmlspecialchars($professional['expertise']); ?></td>
                  
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>

</body>

</html>