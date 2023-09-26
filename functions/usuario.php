<?php
class Usuario {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrarUsuario($nome, $email, $senha, $cpf) {
        $cpfSenha = $cpf . $senha;
        $hash = password_hash($cpfSenha, PASSWORD_BCRYPT, ["cost" => 12]);
    
        try {
            $stmt = $this->conn->prepare("INSERT INTO usuario (nome, email, cpf, hash) VALUES (:nome, :email, :cpf, :hash)");
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':cpf', $cpf);
            $stmt->bindValue(':hash', $hash);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Erro ao registrar: ' . $e->getMessage();
            return false;
        }
    }    

    public function autenticarUsuario($email, $senha) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE email = :email");
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $cpfSenha = $result['cpf'] . $senha;

                if (password_verify($cpfSenha, $result['hash'])) {
                    return true; 
                }
            }

            return false; 
        } catch (PDOException $e) {
            error_log('Erro ao autenticar: ' . $e->getMessage()); // Log do erro
            return false;
        }
    }
}
?>
