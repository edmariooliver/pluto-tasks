<?php
    require('../app/model.php');
    use model\DadosGerais;
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    if($_SESSION['admin_session'] == false){

        header('Location: login');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style_painel.css">
    <script src="../static/bootstrap.js"></script>
    <script src="../static/bootstra.min.js"></script>
    <link rel="shortcut icon" href="../static/img/favicon.ico" />

    <link href="https://fonts.googleapis.com/css2?family=Piedra&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <title>Painel de controle</title>
</head>
<body class='grid'>
    <header>Painel de controle</header>
    <div class="menu">
        <div>
        <ul class=''>
                <li class='button-home'><a href="/admin/controle_painel"><img class='svg' src="../static/img/home.svg" alt="">Início</a></li></li>
                <li class='item-menu'><a href="usuarios"><img class='svg' src="../static/img/painel_user.svg" alt="">Ger. usuários</a></li>
                <li class='item-menu'><a href="feedbacks"><img class='svg' src="../static/img/painel_feedback.svg" alt="">Feedbacks</a></li>
                <li class='item-menu'><a href="bugs_erros"><img class='svg' src="../static/img/painel_bug.svg" alt="">Bugs/Erros</a></li>
                <li class='item-menu'><a href="logs"><img class='svg' src="../static/img/painel_log.svg" alt="">Logs sistema</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        
        <h1><?php echo date('Y-m-d') ?></h1>

        <div class="bloco">
            <h2>Novos usuários hoje</h2>
            <h3 class='bloco-item'><?php echo DadosGerais::count_new('user')?></h3>
        </div>
        <div class="bloco">
            <h2>Novos reports hoje</h2>
            <h3 class='bloco-item'><?php echo DadosGerais::count_new('reports')?></strong></h3>
        </div>
        <div class="bloco">
            <h2>Novos feebacks hoje</h2>
            <h3 class='bloco-item'><?php echo DadosGerais::count_new('feedback')?></strong></h3>
        </div>

        <div class="bloco">
            <h2>Novos acessos hoje</h2>
            <h3 class='bloco-item'><?php echo DadosGerais::count_new('logs_sistema')?></strong></h3>
        </div>
    </div>

    </div>

</body>
</html>
