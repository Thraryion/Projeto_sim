<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("conexao.php");
require_once("autenticacaofun.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    $servername = '127.0.0.1';
    $username = 'root';
    $password = '123456';
    $dbname = 'lp2';
    $dbdriver = 'pgsql';

    $conexaoBD = new ConexaoBD($dbdriver, $servername, $username, $password, $dbname);
    $conn = $conexaoBD->getConnection();

    $autenticacaoFuncionario = new AutenticacaoFuncionario($conn);

    $authResult = $autenticacaoFuncionario->autenticarFuncionario($cpf, $senha);

    if ($authResult['authenticated']) {
        $_SESSION['loggedin'] = true;
        $_SESSION['cpf'] = $cpf;

        $department = $authResult['department'];

        if ($senha === '123456') {
            header('Location: ../paginas/alterar_senha.php');
            exit;
        } else {
            switch ($department) {
                case '1':
                    header('Location: ../paginas/func.php');
                    exit;
                default:
                    header('Location: ../paginas/erro.php');
                    exit;
            }
        }
    } else {
        echo '<script>alert("Senha incorreta ou Usuario nao encontrado!!");</script>';
        echo '<script>window.location.href = "../paginas/login_func.php";</script>';
        exit();
    }
}
?>
