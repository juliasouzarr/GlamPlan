<?php
include '../model/conexao.php'; // Inclua o arquivo de conexão com o banco de dados

// Recupera todos os serviços
$sql = "SELECT * FROM services";
$stmt = $pdo->query($sql);
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços Cadastrados</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: rgba(0, 107, 0, 0.8);
            color: white;
        }
        td {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .btn-edit,
        .btn-delete {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
        .btn-edit {
            background-color: #4CAF50; /* Verde para editar */
            transition: background-color 0.3s;
        }
        .btn-edit:hover {
            background-color: #45a049;
        }
        .btn-delete {
            background-color: #f44336; /* Vermelho para excluir */
            transition: background-color 0.3s;
        }
        .btn-delete:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>
    <header>
        <h1>GlamPlan</h1>
        <a href="professional-index.php">Voltar</a>
    </header>
    <div id="container">
        <h1>Serviços Cadastrados</h1>
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
                <?php foreach ($services as $service): ?>
                <tr>
                    <td><?= htmlspecialchars($service['name']); ?></td>
                    <td><?= htmlspecialchars($service['duration']); ?></td>
                    <td><?= htmlspecialchars($service['value']); ?></td>
                    <td>
                        <a href="../view/service-edit.php?id=<?= $service['id']; ?>" class="btn-edit">Editar</a>
                        <a href="../view/service-delete.php?id=<?= $service['id']; ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este serviço?');">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
