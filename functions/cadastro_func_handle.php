<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("conexao.php");
require_once("cadastrofuncionario.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $departamento = $_POST['departamento'];
    $email = $_POST['email'];

    $servername = '127.0.0.1';
    $username = 'root';
    $password = '123456';
    $dbname = 'lp2';
    $dbdriver = 'pgsql';

    $conexaoBD = new ConexaoBD($dbdriver, $servername, $username, $password, $dbname);
    $conn = $conexaoBD->getConnection();

    $cadastroFuncionario = new CadastroFuncionario($conn);

    if ($cadastroFuncionario->cadastrarFuncionario($cpf, $nome, $departamento, $email)) {
        echo '<script>alert("Dados enviados com sucesso!!");</script>';
        echo '<script>window.location.href = "../paginas/registro_func_rh.php";</script>';
    } else {
        echo '<script>alert("Não foi possível cadastrar!!");</script>';
        echo '<script>window.location.href = "../paginas/registro_func_rh.php";</script>';
    }
}
?>
