<?php 
include ("../model/client-session.php");


$sessao = new Sessao();
$sessao->valida_login();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>GlamPlan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <header>
        <h1>Seja bem vindo(a), <b>Cliente</b></h1>
        <!-- PRIORIDADE MENOR: ADICIONAR PHP PARA PERSONALIZAR O NOME DE ACORDO COM O USUÁRIO LOGADO -->
        <div>
            <a href="client-data.php">Atualizar Dados</a>

            <a href="client-view.php">Profissionais Disponíveis</a>
            <a href="schedule-view.php">Agendar serviço</a>
            <a href="leave.php">Sair</a>
           
        </div>
    </header>

    <div id="container">
        <div id="container-services">
        <h1>Meus agendamentos</h1>
            <!-- ADICIONAR PHP FOREACH PARA TRAZER OS AGENDAMENTOS VIA SELECT NO BANCO (TABELA SERVICOS) 
            ADICIONAR ÍCONE DE LIXEIRA PARA DELETAR SERVIÇO (LINKAR BOOTSTRAP OU USAR ICONE)-->
        </div>
    </div>

</body>

</html>