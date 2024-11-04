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


session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user'])) {
    header("Location: ../view/client-login.php");
    exit();
}

$pdo = Conexao::get_instance();


$sql = "SELECT p.name AS professional_name
        FROM favorites f
        JOIN professional p ON f.professional_id = p.id
        WHERE f.client_id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$clientId]);
$favoriteProfessionals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Profissionais Favoritos - GlamPlan</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montaga&family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "Montserrat", sans-serif;
        }

        body {
            background-color: #cdaeff;
            color: white;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40px 5%;
            border-bottom: solid rgba(255, 255, 255, 0.253) .5px;
        }

        header h1 {
            font-weight: 800;
            font-size: 40px;
        }

        header a {
            text-decoration: none;
            color: white;
            padding: 0 20px;
            font-weight: 500;
            transition: .3s;
        }

        header a:hover {
            color: rgb(0, 107, 0);
            font-weight: 700;
        }

        .container {
            width: 75%;
            margin: 60px auto;
            text-align: center; /* Centraliza o texto dentro da div */
        }

        h1 {
            margin-bottom: 20px;
        }

        .alert {
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 700;
            border-radius: 8px;
            padding: 10px;
        }

        .list-group {
            list-style: none;
            padding: 0;
        }

        .list-group-item {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 10px;
            color: gray;
            margin: 10px 0; /* Espaçamento entre os itens da lista */
        }

        .btn {
            background-color: rgb(0, 107, 0);
            border: none;
            border-radius: 8px;
            color: white;
            padding: 10px 20px;
            font-size: 18px;
            transition: .4s;
            margin-top: 20px; /* Aumenta o espaço acima do botão */
        }

        .btn:hover {
            background-color: rgb(0, 179, 0);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>GlamPlan</h1>
        <nav>
            <a href="client-data.php">Atualizar Dados</a>
            <a href="client-view.php">Profissionais Disponíveis</a>
            <a href="schedule-view.php">Agendar Serviço</a>
            <a href="client-index.php">Voltar</a>
        </nav>
    </header>

    <div class="container mt-5">
        <h1>Meus Profissionais Favoritos</h1>

        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success" role="alert">
                Profissional favoritado com sucesso!
            </div>
        <?php elseif (isset($_GET['success']) && $_GET['success'] == 0): ?>
            <div class="alert alert-danger" role="alert">
                Erro ao favoritar o profissional!
            </div>
        <?php endif; ?>

        <?php if (count($favoriteProfessionals) > 0): ?>
            <ul class="list-group">
                <?php foreach ($favoriteProfessionals as $fav): ?>
                    <li class="list-group-item">
                        Profissional: <?= htmlspecialchars($fav['professional_name']) ?> 
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Você ainda não favoritou nenhum profissional.</p>
        <?php endif; ?>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
