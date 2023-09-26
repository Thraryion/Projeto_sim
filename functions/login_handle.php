<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("conexao.php");
require_once("autenticacao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $servername = '127.0.0.1';
    $username = 'root';
    $password = '123456';
    $dbname = 'lp2';
    $dbdriver = 'pgsql';

    $conexaoBD = new ConexaoBD($dbdriver,$servername, $username, $password, $dbname);
    $conexao = $conexaoBD->getConnection();

    $autenticacao = new Autenticacao($conexao);

    if ($autenticacao->autenticarUsuario($email, $senha)) {
        header('Location: ../paginas/logado.php');
        exit();
    } else {
        echo '<script>alert("Senha incorreta ou Usuario nao encontrado!!");</script>';
        echo '<script>window.location.href = "../paginas/login.php";</script>';
        exit();
    }
}
