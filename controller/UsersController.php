<?php
class UsersController extends ControllerBase{
    public $connect;
    public $adapter;
    public function __construct() {
        parent::__construct();
        $this->connect=new Connection();
        $this->adapter=$this->connect->connect();
    }
     
    public function index(){
         
        //Creamos el objeto usuario
        $user=new User($this->adapter);
         
        //Conseguimos todos los usuarios
        $allusers=$user->getAll();
        
        //Cargamos la vista index y le pasamos valores
        $this->view("userList",array(
            "allusers"=>$allusers,
            "Hola"    =>"Desde la Vista"
        ));
    }

    public function userForm(){
        $this->view("userForm","");
    }
     
    public function create(){
        if(isset($_POST["name"])){
            //Creamos un usuario
            $user=new User($this->adapter);
            $user->setName($_POST["name"]);
            $user->setLastname($_POST["lastname"]);
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST["password"]);
            $save=$user->save();
            
        }
        die(json_encode($save));
        //$this->redirect("Users", "index");
    }

    public function delete(){
        if(isset($_POST["id"])){
            $id=(int)$_POST["id"];
             
            $user=new User($this->adapter);
            $response=$user->deleteById($id);
        }
        die(json_encode($response));
        //$this->redirect("Users","index");
    }

 
}
?>