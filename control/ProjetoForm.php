<?php

require_once 'classes/Projeto.php';
require_once 'classes/Status.php';

class ProjetoForm {

    private $html;
    private $data;

    public function __construct() {
        $this->html = file_get_contents('html/formProjeto.html');
        $this->data = [
            'id' => null,
            'nome' => null,
            'observacao' => null,
            'status' => null
        ];
        
        $status = Status::all();
        $select = "<option></option>";
        foreach ($status as $row) {
            $select .= "<option value='{$row['id']}'>{$row['nome']}</option>";
        }               
        $this->html = str_replace('{status}', $select, $this->html); 
                
    }

    public function edit($param) {
        try {
            $id = (int) $param['id'];
            $this->data = Projeto::find($id);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function delete($param) {
        try {
            $id = (int) $param['id'];
            $this->data = Projeto::delete($id);
            echo "<script>window.location='projeto-list';</script>";
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function save($param) {
        try {
            $id = Projeto::save($param);
            //$this->data = $param;
            echo "<script>window.location='projeto-list?id={$id}';</script>";
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function show() {
        $this->html = str_replace('{action}', 'projeto-save', $this->html);
        $this->html = str_replace('{id}', $this->data['id'], $this->html);
        $this->html = str_replace('{nome}', $this->data['nome'], $this->html);
        $this->html = str_replace('{observacao}', $this->data['observacao'], $this->html);
        $this->html = str_replace("option value='{$this->data['status']}'", "option selected value='{$this->data['status']}'", $this->html);        
        return $this->html;
    }

}
