<?php

include '../model/conexao.php';
include '../model/client-manager.class.php';

$manager = new ClientManager();

if (!empty($_POST)) {
    $manager->insert_client($_POST);
    header("Location: ../view/client-index.php?cod=1");
    
}