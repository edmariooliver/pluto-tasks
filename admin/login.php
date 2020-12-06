<?php 

    require('../app/model.php');
    session_start();
    use Model\Usuario;
    use model\Tarefa;
    use model\Log;
    Log::register_log('');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="shortcut icon" href="../static/img/favicon.ico" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../static/css.css">
    <link rel="stylesheet" href="../static/bootstrap.css">
    <script src="static/bootstrap.js"></script>
    <script src="static/bootstra.min.js"></script>
    <title>Admin</title>
</head>
<body class='bg-linear'>
    <?php 

        if ($_SERVER['REQUEST_METHOD']=='POST'){

            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = new Usuario('','', $email, $password,'');
            
            if ($user->login()){
    
                $_SESSION['user'] = $user;
                var_dump($user);
                $tarefas = new Tarefa('', $user->getId(),'','','');
                $_SESSION['tarefas'] = $tarefas;
                $_SESSION['session'] = true;
                var_dump($user);
                $_SESSION['admin_session'] = true;
                if ($_SESSION['user']->getType() == 'admin'){
                 
                    header('Location: controle_painel');
                }
                else{
                    echo 'Login: Sucess';
                    header('Location: login');
                }
            }else{
                var_dump($user);
                $_SESSION['session'] = false;
                header('Location: login');
            }
        }
    ?>
    <div class='container'>
    <div class='row'>
        <div class='col'>
        </div>
    </div>
    <main class='row'>
        <div class='col'>
        </div>        
        <div class='col-sm-8 col-md-5 align-self-center form shadow bg-light p-3 mb-5 '>
            <div class="login">
            <form class = "" action="" method="post">
                <img class='rounded mx-auto d-block logo' src="static/img/logo.png" alt="">
                <h3 class='text-center'>ADMIN</h3>
                <hr>
                <h5 class="txt-head"></h5>
                <input class="input-index" placeholder='E-mail'type ="email"  name="email"> <br>
                <input class="input-index"  placeholder='Senha' type ="password"  name="password"> <br>
                <input class="button-submit" type ="submit"  value ="LOGIN" name="submit">
            </form>
            </div>
        </div>
        <div class='col'> 
        </div>
        </main>
    </div>
</body>
</html>
