<?php


                                    #PLUTO TASKS#

#                                     Descrição
#                                       PT-BR                                    
#
# Projeto criado com intuito de colocar em pratica meus conhecimentos e para uso no dia-a-dia
# 
# Obs: Inglês fraco relevem os erros.
#
#                                Dev: Edmario Oliveira 



namespace model;

class Database{

    public $db;

    static function connect(){
        
        try{
            $db = new \PDO('mysql:host=localhost;dbname=sistema','root','');
            return $db;

        }catch(PDOException $erro){

            return "Não foi possivel conectar-se com o banco de dados: ".$erro->getMessage();
        }       
    }
}

class Usuario{

    private $id;
    private $name;
    private $surname;
    private $password;
    private $email;
    private $session;
    private $tipo;

    public function __construct($name, $surname, $email, $password, $tipo){

        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->tipo = $tipo;
    }
    
    public function getType(){

        #This function, is for return the type of user
        
        return $this->tipo;
    }
    public function getSession(){

        return $this->session;
    }

    public function getEmail(){

        return $this->email;
    }

    public function getId(){
        
        return $this->id;
    }
    public function getName(){

        return $this->name;
    }

    public function isValid(){

        #Function for verification if the data is valid
        #If is valid -> return true
        #Else is valid -> return false

        $this->email = self::clearData($this->email);
        $this->password = self::clearData($this->password);
        $this->name  = self::clearData($this->name);
        $this->surname = self::clearData($this->surname);
        
        $sql = "SELECT * FROM user WHERE email=?";
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(1, $this->email);
        $stmt->execute();

        $email = false;
        $name = false;
        $surname = false;
        $equal_email_not = false;
        
        if($stmt->rowCount() <1){

            $equal_email_not = true;
            $err_email = '';

        }else{

            $equal_email_not=false;
            $err_email = 'Já existe um email com esse endereço.<br>';
        }

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL) && strlen($this->email) > 1 ){

            $email = true;
            $err_mail= '';

        }else{

            $email = false;
            $err_mail= 'Email inválido.<br>';
        }

        if(preg_match('/^[a-zA-Z]+$/', $this->name) && strlen($this->name) > 1 ){

            $name = true;
            $err_name = '';

        }else{

            $name = false;
            $err_name = 'Nome inválido.<br>';
        } 

        if(preg_match('/^[a-zA-Z]+$/', $this->surname) && strlen($this->surname) > 1 ){
            
            $surname = true;
            $err_name = '';
            
        }else{
            
            $surname = false;
            $err_name = 'Nome invalido.<br>';
        }

        if(strlen($this->password) >6){

            $senha_val = true;
            $err_pass = '';

        }else{

            $senha_val = false;
            $err_pass = 'A senha deve conter pelo menos 8 caracteres.<br>';
        }

        if($email == true && $name == true && $surname == true && $equal_email_not == true && $senha_val==true){

            return true;
        
        }
        
        else{

            echo '<div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Dados inválidos!</h4>
            <p>'.$err_email.$err_mail.$err_name.$err_pass.'</p>
          </div>';
            return false;
        
        }
    }

    static function clearData($data){

        #Function for clear data 

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function read(){

        #Return data of especified user in instance 

        $sql = 'SELECT * FROM user WHERE email = ?, senha = ? ';

        $stmt= Database::connect()->prepare($sql);
        $stmt->bindValue(1, $this->email);
        $stmt->bindValue(2, $this->password);
        $stmt->execute();

        $read =  $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach($read as $value){
        
            echo $value['nome'];
            }
        }

    public function register(){
        
        #Register user

        $sql = "INSERT INTO user(nome, sobrenome, email, senha, tipo, data_criacao) VALUES (?, ?, ?, ?, ?, now())";
        $stmt = Database::connect()->prepare($sql);
       
        $stmt->bindValue(1, $this->name);
        $stmt->bindValue(2, $this->surname);
        $stmt->bindValue(3, $this->email);
        $stmt->bindValue(4, $this->password);
        $stmt->bindValue(5, $this->tipo);
        $stmt->execute();
        $this->session = true;
    }
    
    public function login(){
        
        #Login of user

        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(1, $this->email);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if(password_verify($this->password, $result[0]['senha'])){
            $this->email = $result[0]['email'];
            $this->surname = $result[0]['sobrenome'];
            $this->name = $result[0]['nome'];
            $this->id = $result[0]['user_id'];
            $this->password = $result[0]['senha'];
            $this->tipo = $result[0]['tipo'];
            $this->session = true;
            return true;


        }else{

            $this->session = false; 
            echo '<div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Dados inválidos!</h4></div>';
            return false;
 
        }
    }
} 

class Tarefa{

    private $id; 
    private $nome_tarefa;
    private $hora;
    private $data_acao;
    private $cor;
    private $id_user;
    private $data_create;

    public function __construct($titulo, $id_user, $data, $cor, $hora){

        $this->nome_tarefa = $titulo;
        $this->id_user = $id_user;
        $this->data_acao = $data;
        $this->cor = $cor;
        $this->hora = $hora;
        $this->data_create = 'now()';
    }

    public function getId(){

        return $this->id;
    }
    
    public function create(){

        #Create task

        $sql = 'INSERT INTO tarefas(nome_tarefa, id_user, cor, hora, data_acao, data_criacao) VALUES(?, ?, ?, ?, ?, now())';
        echo $sql;
        $stmt = Database::connect()->prepare($sql);

        $stmt->bindValue(1, $this->nome_tarefa);
        $stmt->bindValue(2, $this->id_user);
        $stmt->bindValue(3, $this->cor);
        $stmt->bindValue(4, $this->hora);
        $stmt->bindValue(5, $this->data_acao);
        $stmt->execute();
    
    }
    
    public function delete($id){
        
        #Delete task 

        $sql = 'DELETE FROM tarefas WHERE id_tarefa='.$id;
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute();
        
    }

    public function update($id, $nome, $cor, $data, $hora){
        
        #Alter task

        $sql = 'UPDATE tarefas SET nome_tarefa = "'.$nome .'", data_acao = "'.$data.'", data_criacao=now(), cor = "'.$cor.'", hora = "'.$hora.'" WHERE (id_tarefa = "'.$id.'")';
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute();

    }

    public function search_task($attr ,$id){

        #This function returns all data of user especified, if data equal 0 return 0 

        $sql = "SELECT nome_tarefa, id_tarefa, data_acao, cor, hora  FROM user u 
        join tarefas t 
        on u.user_id = t.id_user
        where id_user =  $this->id_user
        and $attr = '$id'";
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        if ($stmt->rowCount()  == 0 ){
 
            return 0;

        }else{

            return $result;
        }
    }

    public function search_task_especific($value){

        # This function returns data of task epecific 

        $sql = 'SELECT * FROM tarefas WHERE nome_tarefa LIKE "%'.$value.'%" && id_user = ' . $this->id_user;
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if ($stmt->rowCount()  == 0){

            return 0;

        }else{

            return $result;
        }
    }

    public function list_all(){
        
        #This function returns all tasks of especific user 

        $sql = "SELECT nome_tarefa, id_tarefa, data_acao, cor, hora  FROM user u 
                join tarefas t 
                on u.user_id = t.id_user
                where id_user =  $this->id_user
                order by data_acao desc";
                
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($stmt->rowCount() < 1){
         
            return 0;
        }else{
            
            return $result;
        }
        
    }
}

class Log{

    public static function register_log($usuario){

        # This function have -----BUG-----

        if(preg_match('/ Windows /',$_SERVER['HTTP_USER_AGENT'])){
            
            $os = 'windows';
        }
        if(preg_match('/ Android /',$_SERVER['HTTP_USER_AGENT'])){
            
            $os = 'Linux/Andoid';
        }
        if(preg_match('/ Linux /',$_SERVER['HTTP_USER_AGENT'])){
            
            $os = 'Linux';

        }else{

            $os='Outro';
        }
        $hora = date('H:m');
        $sql = 'INSERT INTO logs_sistema(user, data_criacao, hora, os) VALUES ('.$usuario.',now(),'.$hora.','. $os. ')';
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute();
    }
    public static function log_list(){
        
        #List logs

        $sql = 'SELECT * FROM logs_sistema';
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    
    }
}   

class Report{

    static function reportar($titulo, $texto, $email){
        
        $sql ='INSERT INTO reports(titulo, texto, email, data_criacao) VALUES(?,?,?,now())';
        $stmt= Database::connect()->prepare($sql);
        $stmt->bindValue(1, $titulo);
        $stmt->bindValue(2, $texto);
        $stmt->bindValue(3, $email);
        $stmt->execute();
    }

    static function report_list(){
        
        $sql = 'SELECT * FROM reports';
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    
    }
}
class Feedback{

    static function enviar_feedback($titulo, $texto, $email){
        
        $sql ='INSERT INTO feedback(titulo, texto, email, data_criacao) VALUES(?,?,?,now())';
        $stmt= Database::connect()->prepare($sql);
        $stmt->bindValue(1, $titulo);
        $stmt->bindValue(2, $texto);
        $stmt->bindValue(3, $email);
        $stmt->execute();
    }

    static function feedback_list(){
        
        $sql = 'SELECT * FROM feedback order by data_criacao';
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute();
        $result  = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
        
    }
}

class DadosGerais{

    static function count($attr){
        
        $sql ='SELECT * from '.$attr;
        $stmt= Database::connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    static function count_new($attr){
        
        $date = date('Y-m-d');
        $sql ='SELECT * from '.$attr.' WHERE data_criacao ="'. $date.'"';
        $stmt= Database::connect()->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

}