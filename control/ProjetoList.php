<?php

require_once 'classes/Projeto.php';
require_once 'classes/Lancamento.php';
require_once 'util/TranslateClass.php';

class ProjetoList {

    private $html;

    public function __construct() {
        $this->html = file_get_contents('html/list.html');
    }

    public function delete($param) {
        try {
            $id = (int) $param['id'];
            Projeto::delete($id);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function load() {
        try {
            $projeto = Projeto::all("","status.ordem");
            $items = "<table class=\"table table-striped table-hover\">"
                    . "<thead>"
                    . "<tr>"
                    . "<td>Nome</td>"
                    . "<td>Valor</td>"
                    . "<td>Pago</td>"
                    . "<td><b>Saldo</b></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "</tr>"
                    . "</thead>"
                    . "<tbody>";
            $total = 0;
            $status = "";            
            foreach ($projeto as $row) {
                $valor = Lancamento::saldoProjeto($row["id"]);
                                                
                if ($status != $row["status"]) {
                    $items .= "<thead>"
                            . "<tr>"
                            . "<td><b>{$row["status"]}</b></td>"
                            . "<td></td>"
                            . "<td></td>"
                            . "<td></td>"
                            . "<td></td>"
                            . "<td></td>"
                            . "</tr>"
                            . "</thead>";
                }
                
                $status = $row["status"];
                
                $cor = isset($_REQUEST['id']) && $_REQUEST['id'] == $row['id'] ? "class=\"table-success\"" : NULL;
                $items .= "<tr {$cor}>";
                $items .= "<td>{$row["nome"]}</td>";
                $items .= "<td>" . number_format($row["valor"], 2, ',', '.') . "</td>";
                $items .= "<td><b>" . number_format($row["valor"] - $valor['valor'], 2, ',', '.') . "</b></td>";
                $items .= "<td><a href=\"index.php?class=ProjetoForm&method=edit?id={$row["id"]}\"><i class=\"bi bi-pencil-square\"></i></a></td>";
                $items .= "<td><a href=\"index.php?class=ProjetoForm&method=delete?id={$row["id"]}\"><i class=\"bi bi-trash\"></i></a></td>";
                $items .= "</tr>";
                $total = $total + ($row["valor"] - $valor['valor']);
            }
            $items .= "</tbody>"
                    . "<tr>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "<td><b>" . number_format($total, 2, ',', '.') . "</b></td>"
                    . "<td></td>"
                    . "<td></td>"
                    . "</tr>"
                    . "</table>";
            return $items;
        } catch (Exception $e) {
            $this->html = $e->getMessage();
        }
    }

    public function show() {
        $this->html = str_replace('{itens}', $this->load(), $this->html);
        $this->html = str_replace('{classe}', 'index.php?class=ProjetoForm', $this->html);
        return $this->html;
    }

}
