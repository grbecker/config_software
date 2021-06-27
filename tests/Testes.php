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
        $email->validarEmail("guilherme@psinf.com.br");
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
    public function testLogin() {
        $form = new LoginForm();
        $form->loadTemplate("C:\wamp64\www\config_software\html\lo5gin.html");        
    }
    
    //teste 5
    public function testExcluirUsuario() {
        $form = new Usuario();
        //$form->delete(0);
        //$form->delete("");
        $retorno = $form->delete("A");
        $this->assertEquals(true, $retorno);                               
    }
    
    //teste 6
    public function testUsuarioOnLogin() {
        $form = new Usuario();
        $usuario = [
            'email' => 'guilherme@psinf.com.br',
            'senha' => '12345'
        ];
        $data = $form->login($usuario);
        $this->assertEquals(true, $data);                
    }
    
    
    //teste 7
    public function testExcluirProjeto() {
        $form = new Projeto();
        //$form->delete(0);
        //$form->delete("");
        $retorno = $form->delete("100");
        $this->assertEquals(true, $retorno);                               
    }

    //teste 8
    public function testPesquisaProjeto() {
        $form = new Projeto();
        $data = $form->find("2");
        $this->assertEquals("GUILHERME E KdasdsadsaARINA", $data['nome']);                
    }

    //teste 9
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
                
    //teste 10
    public function testTrasnlate() {
        $form = new TranslateClass();
        $data = $form->convert("LancamentoForm", "R");
        $this->assertEquals("Lançamento - Receita", $data);                
    }    
}
