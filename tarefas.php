<?php

    require('app/model.php');
    session_start();
    use model\Tarefa;
    use model\Usuario;
    $session = new Usuario('','','','','');
    
    if(!$_SESSION['session']){
        header('Location: /login.php');
    }
?>
<?php require('base/header.php')?>
<body class='container-fluid'>
    <div class="row header">
        <div class="col-9">
        <img class='logo-header' src="static/img/log.png" alt="">
        </div>
        <div class="col text-right">
        <div class="dropdown drop-menu">
            <a style='font-size:20px;text-decoration:none; color:black'class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img style='height:40px;width:;' class='icon-user' src="static/img/user.svg" alt="">
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="/sair.php">Sair</a>
            </div>
        </div>
        </div>
    </div>
<div class="row">
    <div class="col">
        <a href="report.php"><img style='height:30px;width:;margin:5px'src="static/img/bug.svg" alt="" data-toggle="tooltip" data-placement="top" title='Clique para reportar algum erro caso tenha econtrado'></a>
        <a href="feedback.php"><img style='height:30px;width:;margin:5px'src="static/img/feed.svg" alt="" data-toggle="tooltip" data-placement="top" title="Deixe seu feedback"></a>
    </div>
</div>
<div class='container'>
<div class='text-center' id='search'>
    <form action="/tarefas.php" method='post' class="">
        <input type="search" class='input-form' placeholder='Pesquisar tarefa...'name="search" id="">
        <input class="btn-search" value='Pesquisar'type="submit" value="">
    </form>
</div>

<div class="cotainer">
<main style='padding-left:10px'class='row text-left'>
    <div class="col-md-8 col">
        
        <div class="col-9">
        <table class='tabela table'>
        <h1 style="font-size:14pt;margin-top:30px"><a href="tarefas.php"> <img class='button-add' src="static/img/list.svg" alt=""></a> Mostrar tarefas</h1>
        <h1 style="font-size:14pt;margin-top:30px"class='float-left'><a href="criar_tarefas.php"><img class='button-add'src="static/img/add.svg" alt=""></a> Adicionar</h1>
            <thead>
            </thead>
            <tbody >
        <?php 
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $tarefa = $_SESSION['tarefas']->search_task_especific($_POST['search']);

                if($tarefa > 0){ 
                   foreach($tarefa as $value){
                    require('bloco_tarefa.php');}

                }else{

                    echo 'Nenhuma tarefa foi encontrada.';
                }
            }
            ?>
            </tbody>
            </table>
        </div>
        <div class="col col-tarefa">
            <table class='tabela table'>
            <thead>
            </thead>
            <tbody >
            <?php
                if($_SERVER['REQUEST_METHOD']!='POST'){
                    echo '<h6>HOJE</h6>';
                    echo'<hr>';
                    if($_SESSION['tarefas']->search_task('data_acao', date('Y-m-d'))>0) {
                        
                        foreach($_SESSION['tarefas']->search_task('data_acao', date('Y-m-d')) as $value){
                        require('bloco_tarefa');
                    }
                }else{
                    echo '<p>Opa, parece que hoje você está livre :)</p>';
                }
            }
            ?>
            </tbody>
            </table>
        </div>
        <div class="col col-tarefa">
            <table class='tabela table'>
            <thead>
            </thead>
            <tbody>
            <?php
                if($_SERVER['REQUEST_METHOD']!='POST'){
                    echo '<h6>TODAS</h6>';
                    echo'<hr>';
                    if($_SESSION['tarefas']->list_all()>0){
                        
                        
                        foreach($_SESSION['tarefas']->list_all() as $value){
                        require('bloco_tarefa.php');
                }
                }else{
                    
                    echo '<p><a href="criar_tarefas.php">Clique aqui para adicionar uma tarefa</a></p>';
                        }
                }
            ?>
            </tbody>
            </table>
        </div>
    </div>
</main>
</div>
</div>
</body>
<?php require('base/end.php')?>