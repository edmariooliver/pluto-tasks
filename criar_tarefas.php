<?php
    require('app/model.php');
    use model\Tarefa;
    session_start();
    if(!$_SESSION['session']){
        header('Location: /login.php');
    }
?>
<?php require('base/header.php')?>
<body class="container-fluid" >
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $titulo = mb_strtoupper($_POST['titulo'],'utf-8');
        $cor = $_POST['color'];
        $data = $_POST['date'];
        $hora = $_POST['time'];

        $tarefa = new Tarefa($titulo, $_SESSION['user']->getId(), $data, $cor, $hora);
        $tarefa->create();
        $_SESSION['tarefa'] = $tarefa;
        $tarefa = '';
        header('Location: /tarefas.php');
    }
    ?>
    <div class="row header">
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
    <br>
    <div class='col'></div>
    <form class='col'method="post" action="/criar_tarefas.php">
        <br>
        <h3> CRIAR TAREFA</h3>
        <br>
        <label for="titulo">Título</label>
        <br>
        <input class="form-text" type = "text" name = "titulo">
        <br>
        <label for="date">Data:</label>
        <br>
        <input class="box-input form-control" type="date" name='date'>
        <br>
        <label for="time">Hora:</label>
        <br>
        <input class="box-input form-control" type="time" name='time'>
        <br>
        <input  class='btn btn-primary' type = "submit" value='Criar' name = "submit">
    </form>
    <div class='col'>

    </div>
</main>
<footer></footer>
</body>
<?php require('base/end.php')?>