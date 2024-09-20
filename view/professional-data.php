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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profissionais Cadastrados</title>
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
            background-color: #4CAF50;
            transition: background-color 0.3s;
        }
        .btn-edit:hover {
            background-color: #45a049;
        }
        .btn-delete {
            background-color: #f44336;
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
        <div>
        <a href="service-register.php">Cadastrar Serviço</a>
        <a href="schedule-register-service.php">Cadastrar Horários</a>
        <a href="professional-index.php">Voltar</a>
        </div>
       
    </header>
    <div id="container">
        <h1>Meus Dados Profissionais</h1>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Usuário</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Especialidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($professionals as $professional): ?>
                <tr>
                    <td><?= htmlspecialchars($professional['name']); ?></td>
                    <td><?= htmlspecialchars($professional['user']); ?></td>
                    <td><?= htmlspecialchars($professional['cpf']); ?></td>
                    <td><?= htmlspecialchars($professional['email']); ?></td>
                    <td><?= htmlspecialchars($professional['phone']); ?></td>
                    <td><?= htmlspecialchars($professional['expertise']); ?></td>
                    <td>
                        <a href="professional-page-update.php?id=<?= $professional['id']; ?>" class="btn-edit">Editar</a>
                        <a href="../controller/delete-professional.php?id=<?= $professional['id']; ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir esta conta profissional?');">Excluir Conta</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
