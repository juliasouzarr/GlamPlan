<?php

class Sessao
{
    public static function valida_login_cliente()
    {
     session_start();
     if(!isset($_SESSION['user'])){
          header("Location: ../view/client-login.php");
     }
     
    }

    public static function valida_login_profissional()
    {
     session_start();
     if(!isset($_SESSION['user'])){
          header("Location: ../view/professional-login.php");
     }
     
    }
}