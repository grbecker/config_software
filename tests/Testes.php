<?php

include_once 'Email.php';

use PHPUnit\Framework\TestCase;

class Testes extends TestCase {
    //teste 1
    public function testValidarEmail() {
        $email = new Email();        
		$email->assertEquals(true, $email->validarEmail("guilherme@psinf.com.br"));
    }
}
