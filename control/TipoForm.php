<?php

require_once 'classes/Tipo.php';

class TipoForm {

    private $html;
    private $data;

    public function __construct() {
        $this->html = file_get_contents('html/formTipo.html');
        $this->data = [
            'id' => null,
            'nome' => null,
            'icone' => null
        ];           
    }

    public function edit($param) {
        try {
            $id = (int) $param['id'];
            $this->data = Tipo::find($id);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function delete($param) {
        try {
            $id = (int) $param['id'];
            $this->data = Tipo::delete($id);
            echo "<script>window.location='index.php?class=TipoList&';</script>";
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function save($param) {
        try {
            $id = Tipo::save($param);
            //$this->data = $param;
            echo "<script>window.location='index.php?class=TipoList&?id={$id}';</script>";
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function show() {
        $this->html = str_replace('{action}', 'index.php?class=TipoForm&method=save&', $this->html);
        $this->html = str_replace('{id}', $this->data['id'], $this->html);
        $this->html = str_replace('{nome}', $this->data['nome'], $this->html);
        $this->html = str_replace('{icone}', $this->data['icone'], $this->html);
        return $this->html;
    }

}
