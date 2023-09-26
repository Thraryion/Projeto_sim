<?php
class Cliente {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrarCliente($cpf, $nome, $plano) {
        $sql = "INSERT INTO Cliente (cpf_cliente, nome_cliente, plano) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $cpf, PDO::PARAM_STR);
        $stmt->bindValue(2, $nome, PDO::PARAM_STR);
        $stmt->bindValue(3, $plano, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            return false; 
        }
    }

    public function excluirCliente($idCliente) {
        $sql = "DELETE FROM Cliente WHERE id_cliente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $idCliente, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
}
?>
