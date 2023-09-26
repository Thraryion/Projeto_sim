<?php

$servername = 'localhost';
$username = 'root';
$password = '123456';
$dbname = 'lp2';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Falha na conexão com o banco de dados: ' . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS usuario (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    hash VARCHAR(255) NOT NULL,
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

$sql = "CREATE TABLE IF NOT EXISTS Cliente (
    id_cliente INT(11) AUTO_INCREMENT PRIMARY KEY,
    cpf_cliente VARCHAR (16) NOT NULL,
    nome_cliente VARCHAR(255) NOT NULL,
    plano VARCHAR(255) NOT NULL,
)";

$sql = "CREATE TABLE IF NOT EXISTS vendas (
    nome_Cliente INT(11) PRIMARY KEY,
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

$conn->close();
?>

