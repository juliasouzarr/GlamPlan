<?php

include '../model/conexao.php';
include '../model/professional-manager.class.php';

$manager = new ProfessionalManager();


if (!empty($_POST)) {
    $manager->insert_professional($_POST);
    header("Location: ../view/professional-index.php?cod=1");
    
}

