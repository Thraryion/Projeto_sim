<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera os dados do formulário
    $sugestao = isset($_POST['sugestoes']) ? $_POST['sugestoes'] : '';

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

    // Prepara a consulta SQL para inserir a sugestão no banco de dados
    $stmt = $conn->prepare("INSERT INTO sugestoes (sugestao) VALUES (?)");
    $stmt->bind_param("s", $sugestao);

    // Executa a consulta
    if ($stmt->execute()) {
        echo 'Sugestão salva com sucesso!';
    } else {
        echo 'Erro ao salvar a sugestão: ' . $stmt->error;
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
?>