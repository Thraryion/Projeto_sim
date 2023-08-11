<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $servername = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'lp1';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Falha na conexão com o banco de dados: ' . $conn->connect_error);
    }

    $sql = "SELECT * FROM usuario WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $cpfSenha = $row['cpf'] . $senha;

        if (password_verify($cpfSenha, $row['hash'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            
            header('Location: ../projetos/Index.php');
            exit();
        } else {
                $error_message = 'Senha incorreta!';
                // Redireciona de volta para a página de login com a mensagem de erro
                header('Location: ../paginas/login.php?error=' . urlencode($error_message));
                exit();

        }
    } else {
        $error_message = 'Usuário não encontrado!';
    }

    $conn->close();
}
?>

