<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("conexao.php");
require_once("usuario.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';

    $servername = '127.0.0.1';
    $username = 'root';
    $password = '123456';
    $dbname = 'lp2';
    $dbdriver = 'pgsql';

    $conexaoBD = new ConexaoBD($dbdriver,$servername, $username, $password, $dbname);
    $conn = $conexaoBD->getConnection();

    $usuario = new Usuario($conn);

    if ($usuario->cadastrarUsuario($nome, $email, $senha, $cpf)) {
        echo '<script>alert("Dados enviados com sucesso!!");</script>';
        echo '<script>window.location.href = "../paginas/registro.php";</script>';
    } else {
        echo '<script>alert("Não foi possível cadastrar!!");</script>';
        echo '<script>window.location.href = "../paginas/registro.php";</script>';
    }
}
?>
