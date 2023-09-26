<?php
class Autenticacao {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function autenticarUsuario($email, $senha) {
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":email", $email);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $cpfSenha = $result['cpf'] . $senha;

                echo "Valor de cpfSenha: ";
                var_dump($cpfSenha);

                echo "Valor de hash no banco de dados: ";
                var_dump($result['hash']);

                if (password_verify($cpfSenha, $result['hash'])) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['nome'] = $result['nome'];
                    
                    return true;
                } else {
                    echo "Falha na verificação de senha";
                }
            } else {
                echo "Nenhum usuário encontrado para o email fornecido";
            }
        } else {
            echo "Erro na execução da consulta SQL";
        }

        return false;
    }
}
?>
