<?php
    require('../app/model.php');
    session_start();
    use model\Tarefa;
    use model\Usuario;
    $session = new Usuario('','','','');
    if(!$_SESSION['session']){
        header('Location: /login.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../static/css.css">
    <link rel="stylesheet" href="../static/bootstrap.css">
    <script src="../static/bootstrap.js"></script>
    <script src="../static/bootstra.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet"><title>Home</title>
</head>
<body>
    <div class='row'>
        <div class='col text-center'>
            <img class='rounded mx-auto d-block logo-header' src="static/img/log.png" alt="Pluto Tasks">
        </div>
    </div>
    <header class='row '>
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class='collapse navbar-collapse' id="menu">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class='nav-item active'><a class='nav-link' href="/tarefas.php">VER TAREFAS</a></li>
                    <li class='nav-item active'><a class='nav-link' href="criar_tarefas.php">CRIAR TAREFAS</a></li>
                    <li class='nav-item active'><a class='nav-link' href="/sair.php">SAIR</a></li>
                <ul>
            </div>
        </nav>
    </header>
    <div>
        <div class='collapse bg-light' id='search'>
            <form action="tarefas.php" method='post' class="bg-dark p-4">
               <input type="search" class='input-form' placeholder='Pesquisar tarefa...'name="search" id="">
               <input class="btn-search" value='Pesquisar'type="submit" value="">
            </form>
        </div>
        <nav class="navbar navbar-dark bg-dark">
           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#search" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
           <img style='height:30px; width:30px'src="static/img/search.svg" alt="">
           </button>
        </nav>
    </div>

    <div class='row'>
        <div class='col-2'>        
        </div>
        <main class='col' style='margin-top:40px'>
        <h6>HOJE</h6>
        <ol class='row'> 
            <br>
            <?php 
                date_default_timezone_set('america/sao_paulo');
                $data = date('Y-m-d'); 
                $result = $_SESSION['tarefas']->search_task('data_acao', $data);

                if($result<1){
                    echo 'Nada agendado para hoje &#128522;';
                }else{
                    foreach($result as $value){
                        echo 
                        '<div class = "row">
                            <div class="card">
                                <li class="card-body" style ="background:rgb(0, 255, 42); border:2px solid rgb(0, 255, 42)"; color:grey">
                                    <h6 class="card-title">Título: '.$value['nome_tarefa'].'</h6>
                                    <h6>Marcado para: '.str_replace('-', '/',$value['data_acao']).'</h6>
                                    <h6>Às: '.$value['hora'].'</h6>
                                </li>    
                                <form action="info_tarefa.php" method="post">
                                    <input type="text" name ="id"class="idtarefa" style="display:none;"value ="'.$value['id_tarefa'].'">
                                    <input type="submit" class ="btn btn-primary" value="VER TAREFA">
                                </form>
                            </div>
                        </div>';
                    }
                }
            ?>
        </ol>
        <hr>
        <h6>OUTRAS</h6>
        <hr>
        <ol class='row'>
        <br>
        <?php
            if($_SERVER['REQUEST_METHOD']=="POST"){
                
                $search =strtoupper($_POST['search']);

                if($search==''){

                    $tarefas = $_SESSION['tarefas']->list_all();
                }else{
                     
                    $tarefas = $_SESSION['tarefas']->search_task_especific($search);
                }
                if($tarefas<1){

                    echo 'Nenhuma tarefa foi encontrada.';
                
                }else{
                    foreach($tarefas as $value){
                        echo 
                            '<div class = "col">
                                <div class="card">
                                    <li class="card-body" style ="border-top:4px solid'.$value['cor'].'">
                                        <h6 class="card-title">Título: '.$value['nome_tarefa'].'</h6>
                                        <h6>Marcado para: '.str_replace('-', '/',$value['data_acao']).'</h6>
                                        <h6>Às: '.$value['hora'].'</h6>
                                    </li>    
                                    <form action="info_tarefa.php" method="post">
                                        <input type="text" name ="id"class="idtarefa" style="display:none;"value ="'.$value['id_tarefa'].'">
                                        <input type="submit" class ="btn btn-primary" value ="VER TAREFA">
                                    </form>
                                </div>
                            </div>';
                    }
                }
            }else{
                $tarefas = $_SESSION['tarefas']->list_all();

                if($tarefas<1){
                echo'Você ainda não tem nada agendado.';
                // echo '<img src="static/img/not_found.jpg">';
                }else{
                    foreach($tarefas as $value){
                        echo 
                            '<div class = "row">
                                <div class="card">
                                    <li class="card-body" style ="border-top:4px solid'.$value['cor'].'">
                                        <h6 class="card-title">Título: '.$value['nome_tarefa'].'</h6>
                                        <h6>Marcado para: '.str_replace('-', '/',$value['data_acao']).'</h6>
                                        <h6>Às '.$value['hora'].'</h6>
                                        <p>Data de criação: '.$value['data_criacao'].'</p>
                                    </li>    
                                <form action="info_tarefa.php" method="post">
                                    <input type="text" name ="id"class="idtarefa" style="display:none;"value ="'.$value['id_tarefa'].'">
                                    <input type="submit" class ="btn btn-primary" value ="VER TAREFA">
                                </form>
                            </div>
                        </div>';
                    }
                }
            }
        ?>
        </ol>
    </main>
    </div>
<footer class='row'>
</footer>
</body>
</html>