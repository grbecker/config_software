<?php

require_once 'classes/Categoria.php';

class CategoriaForm {

    private $html;
    private $data;

    public function __construct() {
        $this->html = file_get_contents('html/formCategoria.html');
        $this->data = [
            'id' => null,
            'nome' => null,
            'tipo' => null,
            'essencial' => null
            ];
        $tipos = [
            'D' => 'Despesas',
            'R' => 'Receitas',
            'I' => 'Investimentos'
            ];
        $tipo = "<option></option>";
        foreach ($tipos as $row) {
            $tipo .= "<option value='{$row[0]}'>{$row}</option>";
        }               
        $this->html = str_replace('{tipos}', $tipo, $this->html);        
        
        $essenciais = [
            'S' => 'Essencial',
            'E' => 'Emergência',
            'N' => 'Outros'
            ];                      
        $essencial = "<option></option>";
        foreach ($essenciais as $row) {
            $essencial .= "<option value='{$row[0]}'>{$row}</option>";
        }               
        $this->html = str_replace('{essencial}', $essencial, $this->html);                       
        }

    public function edit($param) {
        try {
            $id = (int) $param['id'];
            $this->data = Categoria::find($id);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function delete($param) {
        try {
            $id = (int) $param['id'];
            $this->data = Categoria::delete($id);
            echo "<script>window.location='index.php?class=CategoriaList&';</script>";
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
       
    public function save($param) {
        try {
            $id = Categoria::save($param);
            //$this->data = $param;
            echo "<script>window.location='index.php?class=CategoriaList&?id={$id}';</script>";
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function show() {
        $this->html = str_replace('{action}', 'index.php?class=CategoriaForm&method=save&', $this->html);
        $this->html = str_replace('{id}', $this->data['id'], $this->html);
        $this->html = str_replace('{nome}', $this->data['nome'], $this->html);
        $this->html = str_replace("option value='{$this->data['tipo']}'", "option selected value='{$this->data['tipo']}'", $this->html);
        $this->html = str_replace("option value='{$this->data['essencial']}'", "option selected value='{$this->data['essencial']}'", $this->html);
        return $this->html;
    }

}
