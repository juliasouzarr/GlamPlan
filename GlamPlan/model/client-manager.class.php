<?php

require_once 'conexao.php'; // Inclua o arquivo de conexão


class ClientManager extends Conexao
{
    public function insert_client($data)
    {
        $pdo = parent::get_instance();
    
        // Verifica se o nome de usuário já existe
        $checkSql = "SELECT COUNT(*) FROM client WHERE user = :user";
        $checkStmt = $pdo->prepare($checkSql);
        $checkStmt->bindParam(':user', $data['user']);
        $checkStmt->execute();
        $userExists = $checkStmt->fetchColumn();
        
        if ($userExists) {
            throw new Exception("O nome de usuário já está em uso.");
            
        }
        
        // Corrige o SQL para garantir que os parâmetros correspondam
        $sql = "INSERT INTO client (name, user, password, email, phone, birth, address, district) 
                VALUES (:name, :user, :password, :email, :phone, :birth, :address, :district)";
        
        $stmt = $pdo->prepare($sql);
    
        // Vincula os parâmetros
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':user', $data['user']);
        $stmt->bindParam(':password', $data['password']); // Corrigido para usar o valor diretamente
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':birth', $data['birth']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':district', $data['district']);
        
        // Executa a query
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            // Trata exceções de execução da query
            die("Erro ao inserir dados no banco de dados: " . $e->getMessage());
        }
    }
    
    public function list_client()
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM client ORDER BY id DESC";
        $statement = $pdo->query($sql);
        return $statement->fetchAll(PDO::FETCH_ASSOC); // Retorne como array associativo
    }

    public function list_client_by_id($id)
    {
        $pdo = parent::get_instance();   
        $sql = "SELECT * FROM client WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function delete_client($id)
    {
        $pdo = parent::get_instance();
        $sql = "DELETE FROM client WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public function update_client($data)
    {
        $pdo = parent::get_instance();
        $sql = "UPDATE client
                SET name = :name,
                    user = :user,
                    password = :password,
                    email = :email,
                    phone = :phone,
                    birth = :birth,
                    address = :address,
                    district = :district
                WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":name", $data['name']);
        $statement->bindValue(":user", $data['user']);
        $statement->bindValue(":password",$data['password']);
        $statement->bindValue(":email", $data['email']);
        $statement->bindValue(":phone", $data['phone']);
        $statement->bindValue(":birth", $data['birth']);
        $statement->bindValue(":address", $data['address']);
        $statement->bindValue(":district", $data['district']);
        $statement->bindValue(":id", $data['id']);
        $statement->execute();
    }
}
?>
