<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inicia a sessão
session_start();

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os campos de CPF e senha estão definidos no formulário
    if (isset($_POST['cpf'], $_POST['senha'])) {
        // Recupera os dados do formulário
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

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

        // Busca o registro do funcionário pelo CPF
        $sql = "SELECT * FROM funcionario WHERE cpf_func = '$cpf'";
        $result = $conn->query($sql);

        // Verifica se encontrou um registro
        if ($result && $result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Verifica se a senha está em branco (primeiro login)
            if (empty($row['hash_func'])) {
                // Gera o hash da senha
                $cpfSenha = $cpf . $senha;
                $hash = password_hash($cpfSenha, PASSWORD_BCRYPT, ["cost" => 12]);

                // Atualiza o registro do funcionário com o novo hash da senha
                $updateSql = "UPDATE funcionario SET hash_func = '$hash' WHERE cpf_func = '$cpf'";
                if ($conn->query($updateSql) === TRUE) {
                    echo 'Senha cadastrada com sucesso!';
                } else {
                    echo 'Erro ao cadastrar a senha: ' . $conn->error;
                }
            } else {
                // Verifica se a senha está correta
                if (password_verify($cpf . $senha, $row['hash_func'])) {
                    // Define a variável de sessão para armazenar o status do login
                    $_SESSION['loggedin'] = true;
                    $_SESSION['cpf'] = $cpf;
                    $_SESSION['departamento'] = $row['departamento_func'];

                    // Redireciona para a página do departamento correspondente
                    switch ($_SESSION['departamento']) {
                        case '0':
                            header('Location: ../paginas/diretor_rh.php');
                            exit;
                        case '1':
                            header('Location: ../paginas/rh.php');
                            exit;
                        case '2':
                            header('Location: ../paginas/vendas.php');
                            exit;
                        case '3':
                            header('Location: ../paginas/sac.php');
                            exit;
                        case '4':
                            header('Location: ../paginas/Diretor_vendas.php');
                            exit;
                        default:
                            // Departamento desconhecido, redireciona para uma página de erro
                            header('Location: ../paginas/erro.php');
                            exit;
                    }
                } else {
                    // Senha incorreta, exibe uma mensagem de erro
                    echo 'CPF ou senha incorretos.';
                }
            }
        } else {
            // Nenhum registro encontrado, exibe uma mensagem de erro
            echo 'CPF ou senha incorretos.';
        }

        // Fecha a conexão com o banco de dados
        $conn->close();
    } else {
        // Campos de CPF e senha não estão definidos, exibe uma mensagem de erro
        echo 'CPF ou senha não foram enviados.';
    }
}
?>
