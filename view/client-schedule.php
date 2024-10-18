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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- arquivos style -->
    <link href="../assets/style.css" rel="stylesheet">

    <title>Calendario</title>
    <style>
        html {
            --header-color: #ffd3ec;

            --header-button: #93d192;

            --color-weekdays: #d3ffd2;

            --box-shadow: #CBD4C2;

            --hover: #e8faed;

            --current-day: #c4ffd4;

            --event-color: #ab417f;

            --modal-event: #e9fae8;

            --color-day: rgb(255, 255, 255);
        }

        button {
            width: 75px;
            cursor: pointer;
            box-shadow: 0px 0px 2px gray;
            border: none;
            outline: none;
            padding: 5px;
            border-radius: 5px;
            color: white;
        }

        #header {
            padding: 10px;
            color: var(--header-color);
            font-size: 26px;
            font-family: sans-serif;
            display: flex;
            justify-content: space-between;
            text-transform: uppercase;
            font-weight: 800;        
        }

        #header button {
            background-color: var(--header-button);
        }

        #container {
            width: 770px
        }

        #weekdays {
            width: 100%;
            display: flex;
            color: var(--color-weekdays);

        }

        #weekdays div {
            width: 100px;
            padding: 10px;
            text-align: center;
        }

        #calendar {
            width: 100%;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
        }

        .day {
            width: 100px;
            padding: 10px;
            height: 100px;
            cursor: pointer;
            box-sizing: border-box;
            background-color: var(--color-day);
            margin: 5px;
            box-shadow: 0px 0px 3px var(--box-shadow);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-radius: 15%;
            color: grey;
        }

        .day:hover {
            background-color: var(--hover);
        }

        .day+#currentDay {
            background-color: var(--current-day);
        }

        .event {
            font-size: 10px;
            padding: 3px;
            background-color: var(--event-color);
            color: white;
            border-radius: 5px;
            max-height: 55px;
            overflow: hidden;
        }

        .padding {
            cursor: default !important;
            box-shadow: none !important;
        }

        #newEventModal,
        #deleteEventModal {
            display: none;
            z-index: 20;
            padding: 25px;
            background-color: var(--modal-event);
            box-shadow: 0px 0px 3px black;
            border-radius: 5px;
            width: 350px;
            top: 100px;
            left: calc(50% - 175px);
            position: absolute;
            font-family: sans-serif;
        }

        #newEventModal h2, #deleteEventModal h2{
            color: grey;
            margin-bottom: 10px;
        }

        #eventTitleInput, #clientNameInput, #eventTimeInput {
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 25px;
            border-radius: 3px;
            outline: none;
            border: none;
            box-shadow: 0px 0px 3px gray;
        }

        #eventTitleInput.error,  #clientNameInput.error,  #eventTimeInput.error {
            border: 2px solid red;
        }

        #cancelButton,
        #deleteButton {
            background-color: red;
        }

        #saveButton,
        #closeButton {
            background-color: green;
        }

        #eventText {
            font-size: 14px;
            color: grey;
        }

        #modalBackDrop {
            display: none;
            top: 0px;
            left: 0px;
            z-index: 10;
            width: 100vw;
            height: 100vh;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.8);
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
            
            <a href="client-index.php">Voltar</a>
           
        </div>
    </header>

    <div id="container">
        <div id="header">
            <div id="monthDisplay"></div>

            <div>
                <button id="backButton">Voltar</button>
                <button id="nextButton">Próximo</button>
            </div>

        </div>

        <div id="weekdays">
            <div>Domingo</div>
            <div>Segunda</div>
            <div>Terça</div>
            <div>Quarta</div>
            <div>Quinta</div>
            <div>Sexta</div>
            <div>Sábado</div>
        </div>


        <!-- div dinamic -->
        <div id="calendar"></div>


    </div>

    <div id="newEventModal">
        <h2>Novo Agendamento</h2>

        <input id="eventTitleInput" placeholder="Serviço" />
        <input id="clientNameInput" placeholder="Seu nome" />
        <input type="time" id="eventTimeInput" placeholder="Horário" />

        <button id="saveButton"> Salvar</button>
        <button id="cancelButton">Cancelar</button>
    </div>

    <div id="deleteEventModal">
        <h2>Agendamento</h2>

        <div id="eventText"></div><br>


        <button id="deleteButton"  onclick="return confirm('Tem certeza que deseja cancelar seu agendamento?');">Cancelar</button>
        <button id="closeButton">Fechar</button>
    </div>

    <div id="modalBackDrop"></div>


    <script src="../assets/scripts/main.js"></script>

</body>

</html>