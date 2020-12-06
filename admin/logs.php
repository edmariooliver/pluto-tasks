<?php
    require('../app/model.php');
    use model\DadosGerais;
    use model\Log;
    session_start();
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
    <link rel="shortcut icon" href="../static/img/favicon.ico" />
    <script src="../static/bootstra.min.js"></script>
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
    <ul class='caixa'>
        <?php
            foreach(Log::log_list() as $value){
                echo'<li class="bloco">
                    <p class="autor">Data: '.$value['data_criacao'].'</p>
                    <p class="autor">Hora: '.$value['hora'].'</p>
                    <p class="autor">O.S: '.$value['os'].'</p>
                    </li>';
            }
        ?>
    </ul>

    </div>
</body>
</html>