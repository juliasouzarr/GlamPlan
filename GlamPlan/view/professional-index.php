<?php
include '../model/conexao.php'; 
$sql = "SELECT id, name, duration, value FROM services";
$pdo = Conexao::get_instance();
$stmt = $pdo->query($sql);
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlamPlan</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
     
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: rgba(0, 107, 0, 0.8);;
        }
        .btn-edit, .btn-delete {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
            margin: 0 5px;
        }
        .btn-edit {
            background-color: #4CAF50; 
        }
        .btn-delete {
            background-color: #f44336; 
        }
        .btn-delete:hover {
            background-color: #c62828;
        }
    </style>
</head>

<body>
    <header>
        <h1>Seja bem vindo(a), <b>Julia</b></h1>
        <!-- PRIORIDADE MENOR: ADICIONAR PHP PARA PERSONALIZAR O NOME DE ACORDO COM O USUÁRIO LOGADO -->
        <div>
            <a href="service-register.php">Cadastrar Serviço</a>
            <a href="professional-data.php">Atualizar Meus Dados</a>
            <a href="schedule-register-service.php">Meus Horários</a>
           
        </div>
    </header>

    <div id="container">
        <div id="container-services">
            <h1>Seus Serviços</h1>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Duração</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($services) > 0): ?>
                        <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?= htmlspecialchars($service['name']); ?></td>
                            <td><?= htmlspecialchars($service['duration']); ?> min</td>
                            <td><?= htmlspecialchars($service['value']); ?></td>
                            <td>
                        <a href="../view/service-edit.php?id=<?= $service['id']; ?>" class="btn-edit">Editar</a>
                        <a href="../view/service-delete.php?id=<?= $service['id']; ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este serviço?');">Excluir</a>
                    </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Nenhum serviço cadastrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
