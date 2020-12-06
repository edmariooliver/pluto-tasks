<?php
    header('Content-type: text/html; charset=utf-8');
    setlocale( LC_ALL, 'pt_BR.utf-8', 'pt_BR', 'Portuguese_Brazil');
    require('app/model.php');
    use model\Tarefa;
    session_start();
    if(!$_SESSION['session']){
        header('Location: /login.php');
    }
?>
<?php require('base/header.php')?>
<body>
<div class="row header container-fluid">
        <div class="col-9">
        <img class='logo-header' src="static/img/log.png" alt="">
        </div>
        <div class="col text-right">
        <div class="dropdown drop-menu">
            <a style='font-size:20px;text-decoration:none; color:black'class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img style='height:30px;width:;margin:5px'src="static/img/user.svg" alt="">
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="/sair">Sair</a>
            </div>
        </div>
        </div>
    </div>

<main class='row'>
    <div class='col'></div>
    <div>
    <?php
        
        $tarefa = new Tarefa('',$_SESSION['user']->getId(),'','','');
        $value_uri = str_replace('/update.php?=','',$_SERVER['REQUEST_URI']);
        foreach($tarefa->search_task('id_tarefa', $value_uri) as $value){
            echo '
            <form class="box-criar-tarefa" method="post" action="">
                <br>
                <h3> CRIAR TAREFA</h3>
                <br>
                <label for="titulo">Título</label>
                <br>
                <input value="'.$value['nome_tarefa'].'" class="box-input form-text" type = "text" name = "titulo">
                <br>
                <label for="date">Data:</label>
                <br>
                <input value="'.$value['data_acao'].'" class="box-input form-control" type="date" name="date">
                <br>
                <label for="time">Hora:</label>
                <br>
                <input value="'.$value['hora'].'" class="box-input form-control" type="time" name="time">
                <br>
                <input  class="btn btn-primary" type = "submit" value="Criar" name = "submit">
            </form>';
        }
        if ($_SERVER['REQUEST_METHOD']=='POST'){
                
            $titulo = mb_strtoupper($_POST['titulo'], 'utf-8');
            $cor = $_POST['color'];
            $data = $_POST['date'];
            $hora = $_POST['time'];
            $id = str_replace('/update.php?=','',$_SERVER['REQUEST_URI']);
            echo $id;
            $tarefa->update($id, $titulo, $cor, $data, $hora);
            header('Location: /tarefas.php');
        }
    ?>
    </div>
    <div class='col'></div>
</main>
<footer>

</footer>
</body>
<?php require('base/end.php')?>