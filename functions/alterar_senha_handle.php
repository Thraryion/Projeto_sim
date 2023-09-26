<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("conexao.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novaSenha = $_POST['novaSenha'];
    $confirmarSenha = $_POST['confirmarSenha'];

    if ($novaSenha !== $confirmarSenha) {
        $_SESSION['error_message'] = 'As senhas não coincidem.';
        header('Location: alterar_senha.php');
        exit;
    }

    $servername = '127.0.0.1';
    $username = 'root';
    $password = '123456';
    $dbname = 'lp2';
    $dbdriver = 'pgsql';

    $conexaoBD = new ConexaoBD($dbdriver, $servername, $username, $password, $dbname);
    $conn = $conexaoBD->getConnection();

    $cpfSenha = $_SESSION['cpf'] . $novaSenha;
    
    $hashNovaSenha = password_hash($cpfSenha, PASSWORD_BCRYPT, ["cost" => 12]);

    $sql = "UPDATE funcionario SET hash_func = :hashNovaSenha WHERE cpf_func = :cpf";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':hashNovaSenha', $hashNovaSenha);
    $stmt->bindValue(':cpf', $_SESSION['cpf']); 

    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Senha alterada com sucesso.';
        header('Location: ../paginas/func.php'); 
        exit;
    } else {
        $_SESSION['error_message'] = 'Erro ao alterar a senha. Tente novamente mais tarde.';
        header('Location: alterar_senha.php');
        exit;
    }
} else {
    header('Location: alterar_senha.php'); 
    exit;
}
?>
