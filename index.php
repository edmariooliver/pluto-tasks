<?php 

  require('app/model.php');
  use model\Log;
  Log::register_log('');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="static/img/favicon.ico"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="static/css.css">
    <link rel="stylesheet" href="static/bootstrap.css">
    <script src="static/bootstrap.js"></script>
    <script src="static/bootstra.min.js"></script>
    <title>Pluto Tasks</title>
</head>
<body class="container-fluid">
    <div class="row header text-center bg-dark">
        <div class="col">
          <img class='text-center logo-header' src="static/img/log.png" alt="">
          <a href="/login.php"><button class='btn-primary float-right btn-enter'>Entrar</button></a>
        </div>
    </div>
    <div class='row text-center first'>
        <div class="col"></div>
        <div class='col-8 '>
            <h1 class='text-center'>Otimize seu tempo</h1>
            <h5 class='text-center'>Para orgainzar tarefas do cotidiano, trabalhos escolares, projetos e tudo que você quiser ou precisar.</h5>   
            <a href="/cadastro.php"><button class='button-home' >COMEÇAR</button></a>
        </div>
        <div class="col">
          
        </div>
    </div>

    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    
    <div class='container row-two text-center'>
    <div class="card-deck text-center">
  <div class="card text-center">
    <img class='svg' src="static/img/time.svg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Produtividade</h5>
      <p class="card-text">Aumente sua produtividade em um ambiente organizado.</p>
    </div>
  </div>
  <div class="card text-center">
    <img class='svg' src="static/img/table.svg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Facilidade</h5>
      <p class="card-text">Facil criação, edição e exclusão de tarefas.</p>
    </div>
  </div>
  <div class="card text-center">
    <img class='svg'src="static/img/ta_now.svg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Veja as tarefas do dia</h5>
      <p class="card-text">Tarefas do dia ficam destacadas no topo da página.</p>
    </div>
  </div>
</div>
</div>

    <!-- +++++++++++++++++++++++++++++++++++++++++++++++ -->


    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <div class="row text-center footer-home">
        <div class="col"></div>
        <div class="col">
          <img class='logo-footer'src="static/img/logo-footer.png" alt="">
          <br>
          <img class='svg-footer'src="static/img/facebook.svg" alt="">
          <img class='svg-footer'src="static/img/instagram.svg" alt="">
          <p>&copy;Copyright <?php echo date('Y')?>. Todos os direitos reservados.</p>
        </div>
        <div class="col"></div>
    </div>
</body>
<?php require('base/end.php')?>