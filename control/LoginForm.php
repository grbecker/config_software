<?php

require_once 'classes/Usuario.php';

class LoginForm {

    private $html;
    private $data;
    private $return;

    public function __construct() {
        $this->html = file_get_contents('html/login.html');
        $this->data = ['email' => null,
            'senha' => null];
    }

    public function onLogin($param) {
        try {
            $this->return = Usuario::login($param);
            $this->data = $param;      
            if (Session::getValue('logged')) {                
                echo "<script>window.location='index.php';</script>";                
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function onLogout($param) {
        Session::setValue('logged', FALSE);
        echo "<script>window.location='index.php';</script>";
    }

    public function show() {
        $this->html = str_replace('{retorno}', $this->return, $this->html);
        echo $this->html;                
    }

}
