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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Dados</title>
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
        #delete{
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
    <h1>GlamPlan</h1>
        <div>
        <a href="schedule-view.php">Agendar Serviço</a>
        <a href="client-index.php">Voltar</a>
        </div>
    </header>
    <div id="container">
        <h1>Meus Dados</h1>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Usuário</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data de Nascimento</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?= htmlspecialchars($client['name']); ?></td>
                    <td><?= htmlspecialchars($client['user']); ?></td>
                    <td><?= htmlspecialchars($client['email']); ?></td>
                    <td><?= htmlspecialchars($client['phone']); ?></td>
                    <td><?= htmlspecialchars($client['birth']); ?></td>
                    <td><?= htmlspecialchars($client['address']); ?></td>
                    <td><?= htmlspecialchars($client['district']); ?></td>
                    <td>
                        <a href="client-page-update.php?id=<?= $client['id']; ?>" class="btn-edit">Editar</a>
                       
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a id="delete" href="../controller/delete-client.php?id=<?= $client['id']; ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir a conta?');">Excluir Minha Conta</a>
    </div>
</body>
</html>