<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("../functions/conexao.php");
require_once("../functions/cliente.php");

$dbdriver = 'pgsql';
$servername = '127.0.0.1';
$username = 'root';
$password = '123456';
$dbname = 'lp2';

$conexaoBD = new ConexaoBD($dbdriver, $servername, $username, $password, $dbname);
$conn = $conexaoBD->getConnection();

session_start();

if (isset($_SESSION['nome_funcionario'])) {
  $nomeFuncionario = $_SESSION['nome_funcionario'];
} else {
  $nomeFuncionario = 'Nome do Funcionário Não Disponível';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Iron Fit</title>
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="../assets/mdb/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/mdb/css/mdb.min.css">
  <script type="text/javascript" src="../assets/mdb/js/mdb.min.js""></script>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">

    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="func.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../paginas/registro_cliente.php">Registro de Cliente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../paginas/registro_funcionario.php">Registro de Funcionário</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <span class="navbar-text mr-3"><?php echo "Bem-vindo, $nomeFuncionario"; ?></span>
        </li>
        <li class="nav-item">
          <form method="POST" action="../functions/logout.php">
            <button type="submit" name="logout" class="btn btn-link nav-link">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br><br>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("../functions/conexao.php");
require_once("../functions/cliente.php");

$dbdriver = 'pgsql';
$servername = '127.0.0.1';
$username = 'root';
$password = '123456';
$dbname = 'lp2';

$conexaoBD = new ConexaoBD($dbdriver, $servername, $username, $password, $dbname);
$conn = $conexaoBD->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir'])) {
    $idCliente = $_POST['id_func'];

    $cliente = new Cliente($conn);

    if ($cliente->excluirCliente($idCliente)) {
        echo 'Cliente excluído com sucesso!';
    } else {
        echo 'Erro ao excluir o cliente.';
    }
}

try {
    $sql = "SELECT * FROM cliente";

    $result = $conn->query($sql);

    if ($result) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Lista de Clientes</title>
    <!-- Adicione aqui os links para os estilos CSS, se necessário -->
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-3">Lista de Clientes</h1>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Plano</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><?php echo $row['id_cliente']; ?></td>
                        <td><?php echo $row['cpf_cliente']; ?></td>
                        <td><?php echo $row['nome_cliente']; ?></td>
                        <td><?php echo $row['plano']; ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="id_func" value="<?php echo $row['id_cliente']; ?>">
                                <button type="submit" name="excluir" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
    } else {
        echo 'Erro ao executar a consulta: ' . $conn->errorInfo();
    }
} catch (PDOException $e) {
    echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
}
$conn = null;
?>



<style>
    .fixarRodape {
        bottom: 0;
        position: fixed;
        width: 100%;
    }
</style>
   
    <footer class="bg-dark text-center text-white fixarRodape">

</style>
<div class="container p-4">
  <section class="mb-4">
    <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

    <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#!" role="button"><i class="fab fa-twitter"></i></a>

    <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="#!" role="button"><i class="fab fa-google"></i></a>

    <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#!" role="button"><i class="fab fa-instagram"></i></a>

    <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

    <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="#!" role="button"><i class="fab fa-github"></i></a>
  </section>
  
  <section class="">
    
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        <ul class="list-unstyled mb-0">
          <li>
            <a href="#sobre-nos" class="text-white">Sobre</a>
          </li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-6 mb-6 mb-md-0">
        <ul class="list-unstyled mb-0">
          <li>
            <a href="#servicos" class="text-white">serviços</a>
          </li>
        </ul>
      </div>
      <div class="col-lg-4 col-md-6 mb-6 mb-md-0">

        <ul class="list-unstyled mb-0">
          <li>
            <a href="../paginas/registro.php" class="text-white">registro</a>
          </li>
        </ul>
      </div>
      
    </div>
  </section>
</div>
</footer>
</body>
</html>