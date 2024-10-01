<?php
$host = 'localhost';
$dbname = 'glamplan';
$username = 'root';
$password = '';
class Conexao
{
    private static $instance;
   
    public static function get_instance()
    {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO(
                    "mysql:host=localhost;dbname=glamplan",
                    "root",
                    "",
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                );
            } catch (PDOException $e) {
               
                throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }
       
        return self::$instance;      
    }
}
?>
