<?php
// Classe para gerenciar a conexão com o banco de dados
class Conexao {
    // Instância única da conexão
    private static $instance;

    // Método para obter a instância da conexão
    public static function get_instance() {
        // Verifica se a instância já foi criada
        if (!isset(self::$instance)) {
            // Configurações do banco de dados
            $host = 'localhost';
            $dbname = 'glamplan';
            $username = 'root';
            $password = '';

            try {
                // Tenta criar uma nova instância PDO
                self::$instance = new PDO(
                    "mysql:host=$host;dbname=$dbname",
                    $username,
                    $password,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
                );
                // Define o modo de erro para exceções
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Trata exceções de conexão com o banco de dados
                die("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }
        // Retorna a instância da conexão
        return self::$instance;
    }
}

// Exemplo de uso da classe Conexao
try {
    // Obtém a instância da conexão
    $pdo = Conexao::get_instance();
    // Executa alguma operação com a conexão
} catch (PDOException $e) {
    die("Erro ao obter a instância da conexão: " . $e->getMessage());
}
?>
