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

<nav class="navbar navbar-expand-lg bg-dark navbar-dark ">
  <div class="container-fluid">

    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      <li class="nav-item">
          <a class="nav-link" href="../projetos/index.php">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          login
          </a>
               <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li>
              <a class="dropdown-item" href="../paginas/login.php">Entrar</a>
            </li>
            <li>
              <a class="dropdown-item" href="../paginas/registro.php">Registro</a>
            </li>
            <li>
            <a class="dropdown-item" href="../paginas/sugestoes.php">Sugestões</a>
            </li>
            <li>
            <a class="dropdown-item" href="../paginas/login_func.php">Login de funcionarios</a>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>
<br><br>

<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

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
// Verifica se o departamento é de vendas
if ($_SESSION['departamento'] == '4') {
    // Consulta as vendas no banco de dados
    $sql = "SELECT id_venda, id_func_venda, data_venda, valor_venda FROM vendas";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo '<h2>Vendas Realizadas</h2>';
        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID Venda</th>';
        echo '<th>ID Funcionário</th>';
        echo '<th>Data</th>';
        echo '<th>Valor</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        // Exibe os dados das vendas
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id_venda'] . '</td>';
            echo '<td>' . $row['id_func_venda'] . '</td>';
            echo '<td>' . $row['data_venda'] . '</td>';
            echo '<td>' . $row['valor_venda'] . '</td>';
            echo '</tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'Nenhuma venda encontrada.';
    }
}

// ...
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
            <a href="../paginas/sugestoes.php" class="text-white">sugestões</a>
          </li>
        </ul>
      </div>
      
    </div>
  </section>
</div>
</footer>
</body>
</html>