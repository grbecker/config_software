<?php

include_once './classes/Session.php';
include_once './classes/Email.php';

include_once './util/FormatValues.php';
include_once './util/TranslateClass.php';

use PHPUnit\Framework\TestCase;

class Testes extends TestCase {

    //teste 5
    public function testSession() {
        $form = new Session();
        $form->setValue("usuario", "guilherme@psinf.com.br");				
        $this->assertEquals("guilherme@psinf.com.br", $form->getValue("usuario"));
    }    

	//teste 1
    public function testValidarEmail() {
        $email = new Email();        
		$this->assertEquals(true, $email->validarEmail("guilherme@psinf.com.br"));
    }

    //teste 2
    public function testDataNormal() {
        $data = new FormatValues();
        $this->assertEquals('01/01/2020', $data->dataNormal("2020/01/01"));
    }

    //teste 3
    public function testDataSQL() {
        $data = new FormatValues();
        $this->assertEquals("2020-01-01", $data->dataSQL("01/01/2020"));
    }
	
    //teste 4
    public function testTrasnlate() {
        $form = new TranslateClass();
        $data = $form->convert("LancamentoForm", "R");
        $this->assertEquals("Lançamento - Receita", $data);                
    }    
		
}
