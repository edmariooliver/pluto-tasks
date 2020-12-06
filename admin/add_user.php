<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../static/img/favicon.ico" />
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style_painel.css">
    <script src="../static/bootstrap.js"></script>
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
    <?php

        require('../app/model.php');
        use model\Usuario;
        if(!isset($_POST['surname'])){

            $_POST['name']='';
            $_POST['surname']='';
            $_POST['email']='';
            $_POST['password']=''; 
            $_POST['select'] = '';
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $tipo = $_POST['select'];
            echo $tipo;
            if(strlen($_POST['password'])>6){
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }else{
                $password='';
            }
            $user = new Usuario($name, $surname, $email, $password, $tipo);
            
            if($user->isValid()){
    
                $user->register();
                $_SESSION['user'] = $user;
                $_SESSION['session'] = true;

            }
        }
    ?>
  <div class='container'>
    <div class='row'>
        <div class='col'>
        </div>
    </div>
    <main class='caixa'>
        <div class='col'>
        </div>        
        <div class='col-sm-8 col-md-5 align-self-center form shadow bg-light p-3 mb-5 '>
            <div class="login">
            <form class = "" action="" method="post">
                <img class='rounded mx-auto d-block logo' src="static/img/logo.png" alt="">
                <input class="input-index" value="<?php echo $_POST['name']?>"placeholder='Nome'type ="text"  name="name"> <br>
                <input class="input-index" value="<?php echo $_POST['surname']?>" placeholder='Sobrenome'type ="text"  name="surname"> <br>
                <input class="input-index" value="<?php echo $_POST['email']?>"placeholder='E-mail'type ="email"  name="email"> <br>
                <input class="input-index" value="<?php echo $_POST['password']?>"placeholder='Senha' type ="password"  name="password"> <br>
                Tipo
                <select  class='form-control'name="select" id="">
                    <option value="admin">
                        Admin
                    </option>
                    <option value="normal">Normal</option>
                </select>
                <br>
                <input class="button-submit" type ="submit"  value ="CADASTRAR" name="submit">
                
            </form>
            </div>
        </div>
        <div class='col'> 
        </div>
        </main>
    </div>
    </div>
</body>
</html>