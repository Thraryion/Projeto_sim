<?php 
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

$nomeUsuario = $_SESSION['nome'];

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
          <a class="nav-link" href="#home">Home</a>
        </li>
      </ul>
      
      <div class="navbar-text mx-auto">Olá, <?php echo $nomeUsuario; ?></div>
        <a class="btn btn-outline-light" href="../functions/logout.php">Logout</a>

      </div>
  </div>
</nav>

<div id="home" class="carousel slide" data-mdb-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../imagens/home_01.jpg" class="d-block w-100" alt="treino"/>
    </div>
    <div class="carousel-item">
      <img src="../imagens/home_02_gympass.jpg"  class="d-block w-100" alt="aceitamos gympass"/>
    </div>
    <div class="carousel-item">
      <img src="../imagens/home_totalpass.jpg" class="d-block w-100" alt="aceitamos totalpass"/>
    </div>
  </div>
</div>

<div id="sobre-nos" class="text">
  <hr class="my-4">
    <h3 class="text-center mb-4 h3 fw-bold ">Sobre nós</h3>
        <p class="fst-italic ">
            Bem-vindo à Genesis, a sua nova casa de fitness e bem-estar!

            Aqui na Genesis, temos o compromisso de ajudá-lo a atingir os seus objetivos de fitness e saúde, independentemente de quais sejam. Seja você um novato em busca de uma rotina simples para começar ou um experiente apaixonado por fitness em busca de desafios mais intensos, temos tudo o que precisa para ajudá-lo a atingir esses objetivos.
            <br><br>
            Com uma equipe de instrutores treinados e experientes em várias áreas de fitness, incluindo musculação, natação, luta, pilates e muito mais, estamos dedicados a ajudar nossos membros a alcançar o seu potencial completo. Oferecemos uma grande variedade de aulas em grupo, com turmas para todas as idades e níveis de condicionamento físico.
            <br><br>
            A Academia Genesis é equipada com aparelhos modernos e de alta qualidade, idealizados para garantir que você obtenha os melhores resultados possíveis em seu treino. Além disso, temos uma equipe de limpeza dedicada e rigoroso plano de higiene, garantindo um ambiente seguro e saudável para todos os nossos membros.
            <br><br>
            Nós também acreditamos que uma boa alimentação é fundamental para o sucesso em programas de fitness, e é por isso que fornecemos serviços de nutrição especializada e consultas gratuitas para nossos membros. Para complementar a experiência completa de bem-estar, oferecemos ainda um spa, sauna e jacuzzi aos nosso convidados, tudo projetado para aumentar a sua experiência de bem-estar.
            <br><br>
            Junte-se a nós hoje e faça parte da nossa comunidade dinâmica! Com nossos preços acessíveis e ambiente acolhedor, temos certeza de que você encontrará o seu lugar perfeito para treinar. Venha nos visitar e veja por si mesmo por que a Academia Genesis é a melhor escolha para a sua saúde e bem-estar! 
        </p><br>
</div>

<hr class="my-4">
    <h6 class="text-center mb-4 h3 fw-bold ">Aulas</h6>
<hr class="my-4" />

<div class="card-group" id='servicos'>
  <div class="card">
    <img src="../imagens/musculacao.jpg" class="card-img-top" alt="musculação "/>
    <div class="card-body">
      <h5 class="card-title">musculação</h5>
      <p class="card-text">
      A musculação permite treinos curtos e variados, com alta ou baixa intensidade, trabalhando grupos musculares separadamente, garantindo mais força e resistência muscular e deixando o corpo menos suscetível a lesões.
      </p>
    </div>
  </div>
  <div class="card">
    <img src="../imagens/lutas.jpg" class="card-img-top" alt="lutas"/>
    <div class="card-body">
      <h5 class="card-title">lutas</h5>
      <p class="card-text">jiu-jitsu, muay thai, judo, boxe e taekwondo.</p>
    </div> 
  </div>
  <div class="card">
    <img src="../imagens/natacao.jpg" class="card-img-top" alt="natação"/>
    <div class="card-body">
      <h5 class="card-title">natação</h5>
      <p class="card-text">
      A natação é considerada um esporte completo, pois trabalha todos os nossos músculos, aumentando a força e tônus muscular sem riscos de lesões, pois os movimentos realizados na água possuem muito menos impacto do que no solo. Além disso, trabalha as articulações e ligamentos, aumentando a flexibilidade do corpo.
      </p>
    </div>
  </div>
</div>

<footer class="bg-dark text-center text-white">
<footer class="footer navbar-fixed-bottom">
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

