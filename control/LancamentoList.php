<?php

require_once 'classes/Lancamento.php';
require_once 'util/TranslateClass.php';
require_once 'util/FormatValues.php';

class LancamentoList {

    private $html;
    private $data;
    private $loaded;
    private $valor_i = 0;
    private $valor_d = 0;
    private $valor_r = 0;

    public function __construct() {
        $this->html = file_get_contents('html/listLancamento.html');
        $this->data = [
            'data_inicial' => null,
            'data_final' => null,
            'tipo' => null,
            'pesquisa' => null
        ];
    }

    public function delete($param) {
        try {
            $id = (int) $param['id'];
            Lancamento::delete($id);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function somaTotal($tipo, $valor) {
        if ($tipo == "D") {
            $this->valor_d += $valor;
            return true;
        } else if ($tipo == "R") {
            $this->valor_r += $valor;
            return true;
        } else if ($tipo == "I") {
            $this->valor_i += $valor;
            return true;
        } else {
            return false;
        }
    }

    public function retornaIcone($tipo) {
        if ($tipo == 'D') {
            return '<i class="bi bi-graph-down text-danger"></i>';
        } else if ($tipo == 'R') {
            return '<i class="bi bi-graph-up text-success"></i>';
        } else if ($tipo == 'I') {
            return '<i class="bi bi-wallet2 text-warning"></i>';
        } else {
            return false;
        }
    }

    public function onReload($param) {
        try {
            $where = isset($param['data_inicial']) && trim($param['data_inicial']) != '' ? " AND data >=  \"" . FormatValues::dataSQL($param['data_inicial']) . "\"" : "";
            $where .= isset($param['data_final']) && trim($param['data_final']) != '' ? " AND data <=  \"" . FormatValues::dataSQL($param['data_final']) . "\"" : "";
            $where .= isset($param['tipo']) && trim($param['tipo']) != '' ? " AND lancamentos.tipo =  \"" . $param['tipo'] . "\"" : "";
            $where .= isset($param['tipo']) && trim($param['tipo']) != '' ? " AND lancamentos.tipo =  \"" . $param['tipo'] . "\"" : "";
            $where .= isset($param['pesquisa']) && trim($param['pesquisa']) != '' ?
                    " AND (categoria.nome LIKE \"%" . $param['pesquisa'] . "%\" OR "
                    . "complemento LIKE \"%" . $param['pesquisa'] . "%\" OR "
                    . "projeto.nome LIKE \"%" . $param['pesquisa'] . "%\" OR "
                    . "tipo_pagamento.nome LIKE \"%" . $param['pesquisa'] . "%\")" : "";
            $items = '';
            if ($where == '') {
                $where .= " AND extract(year from data)= " . date("Y");
                $where .= " AND extract(month from data)= " . date("m");
            }
            
            $lancamento = Lancamento::all($where);
            foreach ($lancamento as $row) {
                $item = file_get_contents('html/item.html');
                $item = str_replace('{active}', isset($_REQUEST['id']) && $_REQUEST['id'] == $row['id'] ? 'list-group-item-success' : NULL, $item);
                $item = str_replace('{href}', "lancamento-edit?type={$row['tipo']}&id={$row['id']}", $item);
                $item = str_replace('{categoria}', $row['nome'], $item);
                $item = str_replace('{data}', FormatValues::dataNormal($row['data']), $item);
                $item = str_replace('{valor}', number_format($row['valor'], 2, ',', '.'), $item);
                $item = str_replace('{complemento}', $row['complemento'], $item);
                $item = str_replace('{tipo_pagamento}', $row['tipo_nome'], $item);
                $item = str_replace('{paga}', $row['paga'] == 'S' ? 'text-success' : 'text-danger', $item);
                $item = str_replace('{tipo}', $this->retornaIcone($row['tipo']), $item);
                $item = str_replace('{projeto}', $row['projeto'], $item);
                $item = str_replace('{status}', $row['status'], $item);
                $this->somaTotal($row['tipo'], $row['valor']);
                $items .= $item;
            }
            $this->loaded = TRUE;
            $this->html = str_replace('{itens}', $items, $this->html);
        } catch (Exception $e) {
            $this->html = $e->getMessage();
        }
    }

    public function show() {
        if (!$this->loaded) {
            $this->html = str_replace('{itens}', $this->onReload(""), $this->html);
        }
        $this->html = str_replace('{classe}', 'tipo', $this->html);
        $this->html = str_replace('{action}', 'lancamento-serch', $this->html);
        $this->html = str_replace('{valor_despesa}', number_format($this->valor_d, 2, ',', '.'), $this->html);
        $this->html = str_replace('{valor_investimento}', number_format($this->valor_i, 2, ',', '.'), $this->html);
        $this->html = str_replace('{valor_receita}', number_format($this->valor_r, 2, ',', '.'), $this->html);



        $this->html = str_replace('{data_inicial}', isset($this->data['data_inicial']) ? $this->data['data_inicial'] : null, $this->html);
        $this->html = str_replace('{data_final}', isset($this->data['data_final']) ? $this->data['data_final'] : null, $this->html);
        $this->html = str_replace('{pesquisa}', isset($this->data['pesquisa']) ? $this->data['pesquisa'] : null, $this->html);
        $this->html = str_replace("option value='{$this->data['tipo']}'", "option selected value='{$this->data['tipo']}'", $this->html);


        return $this->html;
    }

}
