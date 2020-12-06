<?php require('base/header.php')?>
<body >
<div class="row header container-fluid">
        <div class="col-9">
        <img class='logo-header' src="static/img/log.png" alt="">
        </div>
        <div class="col text-right">
        <div class="dropdown drop-menu">
            <a style='font-size:20px;text-decoration:none; color:black'class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img style='height:30px;width:;margin:5px'src="static/img/user.svg" alt="">
            </a>
            <div class="container">        
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="/sair">Sair</a>
                </div>
            </div>
        </div>
        </div>
    </div>
<main class='row'>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deseja excluir essa tarefa?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-primary" data-dismiss="modal">Não</button>
            <a href="/delete.php?=<?php echo str_replace('/info_tarefa.php?=', '', $_SERVER['REQUEST_URI'])?>"><button type="button" class="btn-primary">Sim</button></a>
        </div>
        </div>
    </div>
    </div>
    <div class='row'>
    <hr>
    </div>
    <div class='col' style='margin-top:50px'>
    </div>
    <div class='col m-5'>
    <?php
        require('app/model.php');
        use model\Tarefa;
        session_start();
        $id = str_replace('/info_tarefa.php?=','',$_SERVER['REQUEST_URI']);

        $tarefa = new Tarefa('',$_SESSION['user']->getId(),'','','');
        foreach($tarefa->search_task('id_tarefa', $id) as $value){
 
            echo'
            <a href="#"  class="button" data-toggle="modal" data-target="#exampleModal"><img class = "button-alter" src="static/img/delete.svg" alt=""></a>
            <a href="update.php?='.$id.'"><img class = "button-alter" src="static/img/edit.svg" alt=""></a>
            <div style="width: 20rem"class="card">
                <h5 class="list-group-item"">Titulo :'.$value['nome_tarefa'].'</h5>
                <span class="list-group-item"><p class="item-tarefa"><img class="icon-info" src="static/img/calender.svg" alt="">'.str_replace('-','/',$value['data_acao']).'</p></span>
                <span class="list-group-item"><p class="item-tarefa"><img class = "icon-info" src="static/img/date.svg" alt="">Às: '.$value['hora'].'</p></span>
            </div>';
        }
    ?>
    </div>
    <div class='col'>

    </div>
</main>
<footer>
    
</footer>
</body>
<?php require('base/end.php')?>