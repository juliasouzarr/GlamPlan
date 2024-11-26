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

$professional_id = $_POST['professional_id'];
$service = "SELECT id, name, value FROM services WHERE professional_id = ?";
$stmt = $pdo->prepare($service);
$stmt->execute([$professional_id]);
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);

$schedule = "SELECT id, time FROM schedules WHERE professional_id = ? AND avaliable = 1 ORDER BY time";
$stmt = $pdo->prepare($schedule);
$stmt->execute([$professional_id]);
$schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../assets/style.css" rel="stylesheet">
    <title>Agendamento de serviço</title>
    <style>
        #services {
            display: flex;
        }

        #schedules {
            display: grid;
            grid-template-columns: repeat(4, 25%);
        }

        .service-btn,
        .schedule-btn {
            padding: 8px 10px;
            margin: 20px;
            transition: .3s;
            border-radius: 8px;
            font-weight: 500;
            font-size: 15px;
            border: none;
        }

        .service-btn:hover,
        .schedule-btn:hover {
            background-color: green;
            color: white;
            font-weight: 700;
            cursor: pointer;
        }

        .selected {
            background-color: green !important;
            color: white !important;
            font-weight: 700;
        }

        .date-picker {
            padding: 8px 10px;
            margin: 20px;
            transition: .3s;
            border-radius: 8px;
            font-weight: 500;
            font-size: 15px;
            border: none;
        }

        #book-btn {
            padding: 10px 20px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: .3s;
            margin: 20px auto;
            display: block;
        }

        #book-btn:hover {
            background-color: darkblue;
        }
    </style>
</head>

<body>
    <header>
        <?php foreach ($clients as $client): ?>
            <h1>Agende seu serviço, <?= htmlspecialchars($client['name']); ?></h1>
        <?php endforeach; ?>

        <div>
            <a href="client-data.php">Meus Dados</a>
            <a href="client-view.php">Voltar</a>
        </div>
    </header>

    <div id="container">
        <div id="service-container">
            <h1>Escolha o serviço desejado</h1>
            <div id="services">
                <?php foreach ($services as $service): ?>
                    <button class="service-btn" data-service-id="<?= $service['id']; ?>">
                        <?= htmlspecialchars($service['name']); ?> - R$<?= htmlspecialchars($service['value']); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="schedule-container">
            <h1>Escolha a data e horário desejado</h1>
            <input type="date" id="selected-date" class="date-picker">
            <div id="schedules">
                <?php foreach ($schedules as $schedule): ?>
                    <button class="schedule-btn" data-schedule-id="<?= $schedule['id']; ?>">
                        <?= htmlspecialchars($schedule['time']); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
        <button id="book-btn">AGENDAR</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const datePicker = document.getElementById("selected-date");

            // Define o valor mínimo como a data atual
            const today = new Date().toISOString().split("T")[0];
            datePicker.setAttribute("min", today);

            let selectedService = null;
            let selectedSchedule = null;
            let selectedDate = null;

            document.querySelectorAll(".service-btn").forEach(button => {
                button.addEventListener("click", function () {
                    document.querySelectorAll(".service-btn").forEach(btn => btn.classList.remove("selected"));
                    this.classList.add("selected");
                    selectedService = this.getAttribute("data-service-id");
                });
            });

            document.querySelectorAll(".schedule-btn").forEach(button => {
                button.addEventListener("click", function () {
                    document.querySelectorAll(".schedule-btn").forEach(btn => btn.classList.remove("selected"));
                    this.classList.add("selected");
                    selectedSchedule = this.getAttribute("data-schedule-id");
                });
            });

            datePicker.addEventListener("change", function () {
                selectedDate = this.value;
            });

            document.getElementById("book-btn").addEventListener("click", function () {
                if (!selectedService || !selectedDate || !selectedSchedule) {
                    alert("Por favor, selecione um serviço, uma data e um horário.");
                    return;
                }

                const formData = new FormData();
                formData.append("service_id", selectedService);
                formData.append("date", selectedDate);
                formData.append("schedule_id", selectedSchedule);

                fetch("../controller/insert_appointment.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Agendamento realizado com sucesso!");
                        window.location.href = "client-view.php";
                    } else {
                        alert("Erro ao realizar o agendamento: " + data.message);
                    }
                })
                .catch(error => console.error("Erro:", error));
            });
        });
    </script>
</body>

</html>
