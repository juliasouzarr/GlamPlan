<?php

require_once 'conexao.php'; // Inclua o arquivo de conexão

class ProfessionalManager extends Conexao
{
    public function insert_professional($data)
    {
        $pdo = parent::get_instance();
        $sql = "INSERT INTO professional (name, user, password, cpf, email, phone, expertise) VALUES (:name, :user, :password, :cpf, :email, :phone, :expertise)";
        $statement = $pdo->prepare($sql);
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
    }

    public function list_professional()
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM professional ORDER BY id DESC";
        $statement = $pdo->query($sql);
        return $statement->fetchAll();
    }

    public function list_professional_by_id($id)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM professional WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete_professional($id)
    {
        $pdo = parent::get_instance();
        $sql = "DELETE FROM professional WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public function update_professional($data)
{
    $pdo = parent::get_instance();
    
    // Sempre atualiza a senha, mesmo que seja uma senha vazia
    $sql = "UPDATE professional
            SET name = :name,
                user = :user,
                password = :password,
                cpf = :cpf,
                email = :email,
                phone = :phone,
                expertise = :expertise
            WHERE id = :id";
    
    $statement = $pdo->prepare($sql);
    
    // Bind dos valores obrigatórios
    $statement->bindValue(":name", $data['name']);
    $statement->bindValue(":user", $data['user']);
    $statement->bindValue(":password", $data['password']); // Sempre inclui a senha
    $statement->bindValue(":cpf", $data['cpf']);
    $statement->bindValue(":email", $data['email']);
    $statement->bindValue(":phone", $data['phone']);
    $statement->bindValue(":expertise", $data['expertise']);
    $statement->bindValue(":id", $data['id']);
    
    $statement->execute();
}
}
?>
