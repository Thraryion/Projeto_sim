<?php
class ConexaoBD {
    private $conexao;

    public function __construct($dbdriver, $servername, $username, $password, $dbname) {
        try {
            $this->conexao = new PDO("$dbdriver:host=$servername;dbname=$dbname", $username, $password);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Falha na conexão com o banco de dados: ' . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conexao;
    }
}
?>
