<?php

require_once 'classes/Categoria.php';
require_once 'util/TranslateClass.php';

class CategoriaList {

    private $html;

    public function __construct() {
        $this->html = file_get_contents('html/list.html');
    }

    public function delete($param) {
        try {
            $id = (int) $param['id'];
            Categoria::delete($id);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function load() {
        try {            
            $categoria = Categoria::all("");
            $items = "<table class=\"table table-striped table-hover\">"
                    . "<thead>"
                    . "<tr>"
                    . "<td>Nome</td>"
                    . "<td>Tipo</td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "</tr>"
                    . "</thead>"
                    . "<tbody>";
            foreach ($categoria as $row) {                               
                $cor = isset($_REQUEST['id']) && $_REQUEST['id'] == $row['id'] ? "class=\"table-success\"" : NULL;
                $items .= "<tr {$cor}>";
                $items .= "<td>{$row["nome"]}</td>";
                $items .= "<td>{$row["tipo_nome"]}</td>";
                $items .= "<td><a href=\"index.php?class=CategoriaForm&method=edit&id={$row["id"]}\"><i class=\"bi bi-pencil-square\"></i></a></td>";
                $items .= "<td><a href=\"index.php?class=CategoriaForm&method=delete&id={$row["id"]}\"><i class=\"bi bi-trash\"></i></a></td>";
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
        $this->html = str_replace('{classe}', 'index.php?class=CategoriaForm&' , $this->html);        
        return $this->html;
    }

}
