<?php
class AutenticacaoFuncionario {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function autenticarFuncionario($cpf, $senha) {
        $sql = "SELECT * FROM funcionario WHERE cpf_func = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $cpf);
        
        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result !== false) {
                $hashFuncionario = $result['hash_func'];

                if (empty($hashFuncionario)) {
                    $cpfSenha = $cpf . $senha;
                    $hash = password_hash($cpfSenha, PASSWORD_BCRYPT, ["cost" => 12]);

                    $updateSql = "UPDATE funcionario SET hash_func = ? WHERE cpf_func = ?";
                    $updateStmt = $this->conn->prepare($updateSql);
                    $updateStmt->bindValue(1, $hash);
                    $updateStmt->bindValue(2, $cpf);

                    if ($updateStmt->execute()) {
                        return ['authenticated' => true, 'department' => $result['departamento_func']];
                    } else {
                        return ['authenticated' => false];
                    }
                } elseif (password_verify($cpf . $senha, $hashFuncionario)) {
                    return ['authenticated' => true, 'department' => $result['departamento_func']];
                }
            }
        }

        return ['authenticated' => false];
    }
}
?>
