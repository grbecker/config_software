<?php

require_once 'classes/Tipo.php';
require_once 'util/TranslateClass.php';

class TipoList {

    private $html;

    public function __construct() {
        $this->html = file_get_contents('html/list.html');
    }

    public function delete($param) {
        try {
            $id = (int) $param['id'];
            Tipo::delete($id);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function load() {
        try {            
            $tipo = Tipo::all("");
            $items = "<table class=\"table table-striped table-hover\">"
                    . "<thead>"
                    . "<tr>"
                    . "<td>Nome</td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "</tr>"
                    . "</thead>"
                    . "<tbody>";
            foreach ($tipo as $row) {                               
                $cor = isset($_REQUEST['id']) && $_REQUEST['id'] == $row['id'] ? "class=\"table-success\"" : NULL;
                $items .= "<tr {$cor}>";
                $items .= "<td>{$row["nome"]}</td>";
                $items .= "<td><a href=\"tipo-edit?id={$row["id"]}\"><i class=\"bi bi-pencil-square\"></i></a></td>";
                $items .= "<td><a href=\"tipo-delete?id={$row["id"]}\"><i class=\"bi bi-trash\"></i></a></td>";
                $items .= "</tr>";
            }
            $items .= "</tbody>" .
                      "</table>";
            return $items;
        } catch (Exception $e) {
            $this->html = $e->getMessage();
        }
    }

    public function show() {        
        $this->html = str_replace('{itens}', $this->load() , $this->html);                
        $this->html = str_replace('{classe}', 'tipo' , $this->html);        
        return $this->html;
    }

}
