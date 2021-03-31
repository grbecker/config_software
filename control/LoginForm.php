<?php

//require_once './classes/Usuario.php';
require_once 'C:\wamp64\www\config_software\classes\Usuario.php';

class LoginForm {

    private $html;
    private $data;
    private $return;

    public function __construct() {
        try {
            $this->html = $this->loadTemplate('html/login.html');
        } catch (Exception $e) {
            $this->html = $e->getMessage();
        }
        $this->data = ['email' => null,
            'senha' => null];
    }

    public function loadTemplate($directory) {
        if (file_exists($directory)){
            return file_get_contents($directory);
        } else {
            throw new Exception("Erro ao carregar template \"{$directory}\"");
        }
    }

    public function onLogin($param) {
        try {
            $this->return = Usuario::login($param);
            $this->data = $param;
            if (Session::getValue('logged')) {
                echo "<script>window.location='home';</script>";
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function onLogout($param) {
        Session::setValue('logged', FALSE);
        echo "<script>window.location='home';</script>";
    }

    public function show() {
        $this->html = str_replace('{retorno}', $this->return, $this->html);
        echo $this->html;
    }

}
