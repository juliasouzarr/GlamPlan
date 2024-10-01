<?php

require_once '../model/conexao.php';

class Client extends Conexao {
    
    public function login($username, $password) {
       
        $pdo = parent::get_instance();
        
        // Preparamos a consulta SQL
        $sql = "SELECT * FROM client WHERE user = ? AND password = ?";
        
        try {
            $stmt = $pdo->prepare($sql);         
           
            $stmt->execute([$username, $password]);
            
            // Verificamos se há algum resultado
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
           

            if ($user) {
                return $user;
            } else {
                return null;
            }
            
        } catch (PDOException $e) {
            return 'Erro na consulta: ' . $e->getMessage();
        }
    }
}

