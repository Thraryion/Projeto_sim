<<?php
class CadastroFuncionario {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrarFuncionario($cpf, $nome, $departamentoId, $email) {
        
        $senhaAleatoria = '123456'; 

        $cpfSenha = $cpf . $senhaAleatoria;

        $hashSenha = password_hash($cpfSenha, PASSWORD_BCRYPT, ["cost" => 12]);

        $sql = "INSERT INTO funcionario (cpf_func, nome_func, departamento_func_id, email_func, hash_func) VALUES (:cpf, :nome, :departamento, :email, :hash)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':departamento', $departamentoId);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':hash', $hashSenha);

        if ($stmt->execute()) {
            return $senhaAleatoria;
        } else {
            return false;
        }
    }
}
?>

