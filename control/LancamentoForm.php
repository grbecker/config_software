<?php

require_once 'classes/Categoria.php';
require_once 'classes/Tipo.php';
require_once 'classes/Lancamento.php';
require_once 'classes/Projeto.php';


class LancamentoForm {

    private $html;
    private $data;

    public function __construct() {
        $this->html = file_get_contents('html/formLancamento.html');
        $this->data = [
            'id' => null,
            'tipo' => isset($_REQUEST['type']) ? $_REQUEST['type'] : "D",
            'id_categoria' => null,
            'id_pagamento' => null,
            'id_projeto' => null,
            'data' => null,
            'valor' => null,
            'complemento' => null,
            'paga' => null,
            'anexo' => null
            ];

        $projetos = Projeto::all("","nome");
        $select = "<option></option>";
        foreach ($projetos as $row) {
            $select .= "<option id='projeto' value='{$row['id']}'>{$row['nome']}</option>";
        }               
        $this->html = str_replace('{projetos}', $select, $this->html);                 
        $tipos = Tipo::all("");
        $select = "<option></option>";
        foreach ($tipos as $row) {
            $select .= "<option id='tipo' value='{$row['id']}'>{$row['nome']}</option>";
        }               
        $this->html = str_replace('{tipos}', $select, $this->html);        

        $where = isset($_REQUEST['type']) ? ' AND categoria.tipo = "'.$_REQUEST['type'].'"' : "";                
        $categoria = Categoria::all($where);
        $select = "<option></option>";
        foreach ($categoria as $row) {
            $select .= "<option id='categoria' value='{$row['id']}'>{$row['nome']}</option>";
        }               
        $this->html = str_replace('{categorias}', $select, $this->html);        
        
    }        
        
        
    public function edit($param) {
        try {            
            
            $id = (int) $param['id'];
            $this->data = Lancamento::find($id);
            if ($this->data['paga'] == 'S') {
                $this->data['paga'] = 'checked';
            } else {
                $this->data['paga'] = '';
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function delete($param) {
        try {
            $id = (int) $param['id'];
            $this->data = Lancamento::delete($id);
            echo "<script>window.location='index.php?class=LancamentoList&';</script>";
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
       
    public function save($param) {
        try {
            $id = Lancamento::save($param);
            //$this->data = $param;
            echo "<script>window.location='index.php?class=LancamentoList&id={$id}';</script>";
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function show() {                
        $this->html = str_replace('{action}', 'index.php?class=LancamentoForm&method=save&', $this->html);
        $this->html = str_replace('{id}', $this->data['id'], $this->html);
        $this->html = str_replace('{tipo}', $this->data['tipo'], $this->html);


        $this->html = str_replace("option id='projeto' value='{$this->data['id_projeto']}'", "option selected value='{$this->data['id_projeto']}'", $this->html);
        $this->html = str_replace("option id='tipo' value='{$this->data['id_pagamento']}'", "option selected value='{$this->data['id_pagamento']}'", $this->html);
        $this->html = str_replace("option id='categoria' value='{$this->data['id_categoria']}'", "option selected value='{$this->data['id_categoria']}'", $this->html);
        
        $this->html = str_replace('{data}', $this->data['data'], $this->html);
        $this->html = str_replace('{valor}', $this->data['valor'], $this->html);
        $this->html = str_replace('{paga}', $this->data['paga'], $this->html);
        $this->html = str_replace('{anexo}', $this->data['anexo'], $this->html);
        $this->html = str_replace('{complemento}', $this->data['complemento'], $this->html);
        return $this->html;
    }

}
