<?php

include_once '../classes/Email.php';
include_once '../classes/Projeto.php';
include_once '../classes/Usuario.php';

include_once '../control/LoginForm.php';

include_once '../util/FormatValues.php';
include_once '../util/TranslateClass.php';

use PHPUnit\Framework\TestCase;

class Testes extends TestCase {

    //teste 1
    public function testValidarEmail() {
        $email = new Email();
        $email->validarEmail("dddd");
    }

    //teste 2
    public function testDataNormal() {
        $data = new FormatValues();
        $this->assertEquals('01/01/2020', $data->dataNormal("2020-01-01"));
    }

    //teste 3
    public function testDataSQL() {
        $data = new FormatValues();
        $this->assertEquals("2020/01/01", $data->dataNormal("01/01/2020"));
    }

    //teste 4
    public function testLogin() {
        $form = new LoginForm();
        $form->loadTemplate("C:\wamp64\www\config_software\html\logidn.html");        
    }
    
    //teste 5
    public function testLoginOnLogin() {
        $form = new Login();
        $data = $form->
        $this->assertEquals("Lançamento - Receita", $data);                
    }
    
    
    //teste 6
    public function testExcluirProjeto() {
        $form = new Projeto();
        //$form->delete(0);
        //$form->delete("");
        $form->delete("A");
    }

    //teste 7
    public function testPesquisaProjeto() {
        $form = new Projeto();
        $data = $form->find("2");
        $this->assertEquals("GUILHERME E KARINA", $data['nome']);                
    }

    //teste 8
    public function testSalvarProjeto() {
        $data = [
            'id' => 3,
            'nome' => "TESTE NOME",
            'observacao' => "TESTE OBS",
            'status' => "1"
        ];        
        $form = new Projeto();       
        $retorno = $form->save($data);
        $this->assertEquals(3, $retorno);                
    }
                
    //teste 9
    public function testTrasnlate() {
        $form = new TranslateClass();
        $data = $form->convert("LancamentoForm", "R");
        $this->assertEquals("Lançamento - Receita", $data);                
    }
    
}
