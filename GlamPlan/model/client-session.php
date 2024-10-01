<?php

class Sessao
{
    public static function valida_login()
    {
     session_start();
     if(!isset($_SESSION['user'])){
          header("Location: ../view/client-login.php");
     }
     
    }
}