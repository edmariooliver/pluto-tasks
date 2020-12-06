<?php   
    session_start();
    require('app/model.php');
    use model\Usuario;
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="static/img/favicon.ico" />
    <link rel="stylesheet" href="static/css.css">
    <link rel="stylesheet" href="static/bootstrap.css">
    <script src="static/bootstrap.js"></script>
    <script src="static/bootstra.min.js"></script>
    <title>Cadastro</title>
</head>
<body class='bg-linea container-fluid'>
    <?php
        if(!isset($_POST['surname'])){

            $_POST['name']='';
            $_POST['surname']='';
            $_POST['email']='';
            $_POST['password']=''; 
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];

            if(strlen($_POST['password'])>6){
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }else{
                $password='';
            }
            $user = new Usuario($name, $surname, $email, $password, 'normal');
            
            if($user->isValid()){
    
                $user->register();
                $_SESSION['user'] = $user;
                $_SESSION['session'] = true;
                header('Location: /login.php');

            }
        }else{
            session_destroy();
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
            <form class = "" action="/cadastro.php" method="post">
                <img class='rounded mx-auto d-block logo' src="static/img/logo.png" alt="">
                <h3 class='text-center'>Pluto Tasks</h3>
                <hr>
                <h5 class="txt-head">CADASTRE-SE</h5>
                <input class="input-index" value="<?php echo $_POST['name']?>"placeholder='Nome'type ="text"  name="name"> <br>
                <input class="input-index" value="<?php echo $_POST['surname']?>" placeholder='Sobrenome'type ="text"  name="surname"> <br>
                <input class="input-index" value="<?php echo $_POST['email']?>"placeholder='E-mail'type ="email"  name="email"> <br>
                <input class="input-index" value="<?php echo $_POST['password']?>"placeholder='Senha' type ="password"  name="password"> <br>
                <input class="button-submit" type ="submit"  value ="CADASTRAR" name="submit">
                <br>
                <a style=' text-center 'href ="login.php" >Já tem uma conta?</a>
            </form>
            </div>
        </div>
        <div class='col'> 
        </div>
        </main>
        <p style='color:black;'class='text-center'>&copy;Todos os direitos reservados.</p>
    </div>
</body>
<?php require('base/end.php')?>