<?php
// Substitua as informações do banco de dados com as suas próprias
$servername = 'localhost';
$username = 'root';
$password = 'root';
$dbname = 'lp1';

// Cria uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se ocorreu algum erro na conexão
if ($conn->connect_error) {
    die('Falha na conexão com o banco de dados: ' . $conn->connect_error);
}

// Cria a tabela 'usuario' caso não exista
$sql = "CREATE TABLE IF NOT EXISTS usuario (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    hash VARCHAR(255) NOT NULL
)";

$sql = "CREATE TABLE IF NOT EXISTS departamento (
    id_departamento INT(11) AUTO_INCREMENT PRIMARY KEY,
    nome_departamento VARCHAR(255) NOT NULL,
)";

$sql = "CREATE TABLE IF NOT EXISTS funcionario (
    id_func INT(11) AUTO_INCREMENT PRIMARY KEY,
    cpf_func VARCHAR (16) NOT NULL,
    nome_func VARCHAR(255) NOT NULL,
    departamento_func id (11) NOT NULL,
    email_func VARCHAR(255) NOT NULL,
    hash_func VARCHAR(255) NOT NULL
    FOREIGN KEY (departamento_func) REFERENCES departamento(id_departamento)
)";


$sql = "CREATE TABLE IF NOT EXISTS sugestoes (
    id_sugestao INT(11) AUTO_INCREMENT PRIMARY KEY,
    sugestao VARCHAR(3000) NOT NULL,
)";

$sql = "CREATE TABLE IF NOT EXISTS vendas (
    id_Venda INT(11) PRIMARY KEY,
    id_func_venda INT(11) NOT NULL,
    data_venda DATETIME NOT NULL,
    valor_venda DOUBLE NOT NULL,
    FOREIGN KEY (id_func_venda) REFERENCES funcionario(id_func)
)";



if ($conn->query($sql) === TRUE) {
    echo 'Tabela "usuario" criada com sucesso!';
} else {
    echo 'Erro ao criar tabela: ' . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

