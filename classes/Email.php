<?php

class Email {

    public static function validarEmail($email) {
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {            
            throw new Exception("{$email} não é um endereço de email correto!");
        } else {
            return true;
        }        
    }


}
