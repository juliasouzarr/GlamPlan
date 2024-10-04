<?php
session_start(); // Iniciar a sessão
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
    <title>GlamPlan</title>
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        
        tr:hover {
            background-color: #A020F0;
        }

        .btn {
            background-color: #4CAF50; 
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s; /* Efeito de transição */
        }

        .btn:hover {
            background-color: #45a049; /* Verde escuro ao passar o mouse */
        }
    </style>
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
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($professionals as $professional): ?>
        <tr>
    <td><?= htmlspecialchars($professional['name']); ?></td>
    <td><?= htmlspecialchars($professional['email']); ?></td>
    <td><?= htmlspecialchars($professional['phone']); ?></td>
    <td><?= htmlspecialchars($professional['expertise']); ?></td>
    <td>
        <form action="../controller/favorite-professional.php" method="POST">
            <input type="hidden" name="client_id" value="<?= $_SESSION['user']; ?>">
            <input type="hidden" name="professional_id" value="<?= $professional['id']; ?>">
            <input type="hidden" name="service_id" value="1"> <!-- Ajuste conforme necessário -->
            <button type="submit" class="btn btn-success">Favoritar</button>
        </form>
    </td>
</tr>
<?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
