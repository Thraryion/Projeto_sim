<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Alterar Senha</title>
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="../assets/mdb/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/mdb/css/mdb.min.css">
  <script type="text/javascript" src="../assets/mdb/js/mdb.min.js"></script>
</head>
<body>
  <div class="container">
    <h2>Alterar Senha</h2>
    <?php
      session_start();
      if (isset($_SESSION['error_message'])) {
          echo '<div class="alert alert-danger" role="alert">'.$_SESSION['error_message'].'</div>';
          unset($_SESSION['error_message']);
      }
    ?>
    <form action="../functions/alterar_senha_handle.php" method="POST">
      <div class="mb-3">
        <label for="novaSenha" class="form-label">Nova Senha</label>
        <input type="password" class="form-control" id="novaSenha" name="novaSenha" required>
      </div>
      <div class="mb-3">
        <label for="confirmarSenha" class="form-label">Confirmar Nova Senha</label>
        <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" required>
      </div>
      <button type="submit" class="btn btn-primary">Alterar Senha</button>
    </form>
  </div>
</body>
</html>
