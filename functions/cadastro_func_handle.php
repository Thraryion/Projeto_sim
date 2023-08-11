<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do formulário
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $departamento = $_POST['departamento'];
    $email = $_POST['email'];

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

    // Prepara a consulta SQL para inserir o funcionário no banco de dados
    $stmt = $conn->prepare("INSERT INTO funcionario (cpf_func, nome_func, departamento_func, email_func) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $cpf, $nome, $departamento, $email);

    // Executa a consulta
    if ($stmt->execute()) {
        echo 'Cadastro realizado com sucesso!';
    } else {
        echo 'Erro ao cadastrar o funcionário: ' . $stmt->error;
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>
