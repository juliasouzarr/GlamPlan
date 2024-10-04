<?php 

require_once 'assets\twilio-php-main\src\Twilio\autoload.php';
use Twilio\Rest\Client;

$sid    = "AC79d0f25711a9ceb25e02531275c4e3f0";
$token  = "316b92d19bb1968469034bd17bdd3a4a";
$twilioNumber = 'whatsapp:+5531973490301';

$host = 'localhost';
$dbname = 'glamplan';
$username = 'root';
$password = '';

$conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

$id = $_GET['id'] ?? null;
$sql = "SELECT * FROM appointments WHERE schedule_id = ?";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $clienteNome = $row["client_name"];
} else {
    echo "Cliente não encontrado nos agendamentos.";
}

$sql = "SELECT * FROM schedules WHERE id = ?";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $dataAgendamento = $row["date"];
    $horaAgendamento = $row["time"];
} else {
    echo "Hora e data não encontradas.";
}

$sql = "SELECT * FROM client WHERE name = $clienteNome";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $numCliente = $row["phone"];
} else {
    echo "Número não encontrado.";
}

$conn->close();

// Formatar a mensagem
$mensagem = "Olá $clienteNome, este é um lembrete de seu agendamento no dia $dataAgendamento às $horaAgendamento. Até lá!";

// Criar um cliente Twilio
$client = new Client(username: $sid, password: $token);

// Enviar a mensagem
$message = $client->messages->create(
    to: 'whatsapp:$numCliente', 
    options: array(
        'from' => $twilioNumber,
        'body' => $mensagem
    )
);

?>