<?php

include_once './classes/Email.php';

use PHPUnit\Framework\TestCase;

class Testes extends TestCase {
    //teste 1
    public function testValidarEmail() {
        $email = new Email();        
		$this->assertEquals(true, $email->validarEmail("guilherme@psinf.com.br"));
    }
        $this->assertEquals("Lançamento - Receita", $data);                
}
