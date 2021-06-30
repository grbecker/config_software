<?php

include_once './classes/Email.php';

include_once './util/FormatValues.php';
include_once './util/TranslateClass.php';

use PHPUnit\Framework\TestCase;

class Testes extends TestCase {

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
    public function testTrasnlateLista() {
        $form = new TranslateClass();
        $this->assertEquals("Lista de categoria", $form->convert("CategoriaList", ""));                
    }    

    //teste 5
    public function testTrasnlateLancamento() {
        $form = new TranslateClass();
        $this->assertEquals("Lançamento - Receita", $form->convert("LancamentoForm", "R"));                
    }    
        
    //teste 7
    public function testValue() {
        $form = new FormatValues();
        $this->assertEquals(10, $form->decimalEN(10));
    }        
            
    //teste 8
    public function testTrasnlateRouteClass() {
        $form = new TranslateClass();
        $this->assertEquals(true, $form->routeClass("Categoria"));                
    }    
    
    //teste 9
    public function testTrasnlateRouteControl() {
        $form = new TranslateClass();
        $this->assertEquals(true, $form->routeControl("CategoriaList"));                
    }    

    //teste 10
    public function testSomaGastos() {
        $soma = new FormatValues();
        $soma->somaGasto(1000, "R");
        $soma->somaGasto(200, "R");
        $soma->somaGasto(100, "D");
        $this->assertEquals(1000, $soma->getSaldo());
    }
        
    //teste 1
    public function testValidarEmail1() {
        $email = new Email();        
	$this->assertEquals(true, $email->validarEmail("guilherme@psinf.com.br"));
    }

    //teste 2
    public function testDataNormal1() {
        $data = new FormatValues();
        $this->assertEquals('01/01/2020', $data->dataNormal("2020/01/01"));
    }

    //teste 3
    public function testDataSQL1() {
        $data = new FormatValues();
        $this->assertEquals("2020-01-01", $data->dataSQL("01/01/2020"));
    }

    //teste 4
    public function testTrasnlateLista1() {
        $form = new TranslateClass();
        $this->assertEquals("Lista de categoria", $form->convert("CategoriaList", ""));                
    }    

    //teste 5
    public function testTrasnlateLancamento1() {
        $form = new TranslateClass();
        $this->assertEquals("Lançamento - Receita", $form->convert("LancamentoForm", "R"));                
    }    
        
    //teste 6
    public function testValue1() {
        $form = new FormatValues();
        $this->assertEquals(10, $form->decimalEN(10));
    } 
    
    //teste 1
    public function testValidarEmail3() {
        $email = new Email();        
	$this->assertEquals(true, $email->validarEmail("guilherme@psinf.com.br"));
    }

    //teste 2
    public function testDataNormal3() {
        $data = new FormatValues();
        $this->assertEquals('01/01/2020', $data->dataNormal("2020/01/01"));
    }

    //teste 3
    public function testDataSQL3() {
        $data = new FormatValues();
        $this->assertEquals("2020-01-01", $data->dataSQL("01/01/2020"));
    }

    //teste 4
    public function testTrasnlateLista3() {
        $form = new TranslateClass();
        $this->assertEquals("Lista de categoria", $form->convert("CategoriaList", ""));                
    }    

    //teste 5
    public function testTrasnlateLancamento3() {
        $form = new TranslateClass();
        $this->assertEquals("Lançamento - Receita", $form->convert("LancamentoForm", "R"));                
    }    
        
    //teste 6
    public function testValue3() {
        $form = new FormatValues();
        $this->assertEquals(10, $form->decimalEN(10));
    }    
}
