<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do formulário
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';

    // Concatena o CPF e a senha
    $cpfSenha = $cpf . $senha;

    // Gera o hash
    $hash = password_hash($cpfSenha, PASSWORD_BCRYPT, ["cost" => 12]);

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

    // Insere os dados na tabela 'usuario'
    $sql = "INSERT INTO usuario (nome, email, cpf, hash) VALUES ('$nome', '$email', '$cpf', '$hash')";

    if ($conn->query($sql) === TRUE) {
        echo 'Registro realizado com sucesso!';
    } else {
        echo 'Erro ao registrar: ' . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
