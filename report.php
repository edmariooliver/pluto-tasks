<?php 
    require('app/model.php');
    use model\Report;
    session_start();
?>
<?php require('base/header.php')?>
<body class="container-fluid">
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
        <a class="dropdown-item" href="/sair.php">Sair</a>
    </div>
</div>
</div>
</div>
<?php 
    if($_SERVER['REQUEST_METHOD']=='POST'){

        Report::reportar($_POST['titulo'], $_POST['texto'], $_SESSION['user']->getEmail());
    }
?>
<div class="row">
    <div class="col-2"></div>
    <div class="col text-center form-group">
    <h4>Reportar erro</h4>
        <form action="" class='' method='post'>
            <input required name ='titulo' placeholder='Escolha um titulo'class='form-control'type="text">
            <textarea name="texto" id="" cols="40" class='form-control' rows="10">Qual o problema?</textarea>
            <input type="submit" class="btn btn-primary btn-lg btn-block">   
        </form>
    </div>
    <div class="col-2"></div>
</div>
</body>
<?php require('base/end.php')?>