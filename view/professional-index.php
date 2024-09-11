<?php
include '../model/conexao.php'; // Conecta ao banco de dados

// Consulta para obter todos os serviços
$sql = "SELECT id, name, duration, value FROM services";
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
        /* Estilos básicos para a tabela */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color:#9613df;
        }
        .btn-edit, .btn-delete {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 3px;
            margin: 0 5px;
        }
        .btn-edit {
            background-color: #4CAF50; /* Green */
        }
        .btn-delete {
            background-color: #f44336; /* Red */
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
            <a href="professional-data.php">Atualizar Dados</a>
            <a href="schedule-register-service.php">Cadastrar Horários</a>
            <a href="#">Vincular Empresa</a>
            <a href="#">Área do Cliente</a>
        </div>
    </header>

    <div id="container">
        <div id="container-services">
            <h1>Seus Serviços</h1>

            <!-- Exibe a tabela de serviços cadastrados -->
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Duração</th>
                        <th>Valor</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($services) > 0): ?>
                        <?php foreach ($services as $service): ?>
                        <tr>
                            <td><?= htmlspecialchars($service['name']); ?></td>
                            <td><?= htmlspecialchars($service['duration']); ?></td>
                            <td><?= htmlspecialchars($service['value']); ?></td>
                            
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
