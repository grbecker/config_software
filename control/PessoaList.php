<?php

require_once 'classes/Pessoa.php';

class PessoaList {

    private $html;

    public function __construct() {
        $this->html = file_get_contents('html/list.html');
    }

    public function delete($param) {
        try {
            $id = (int) $param['id'];
            Pessoa::delete($id);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function load() {
        try {
            $pessoas = Pessoa::all();
            $items = '';
            foreach ($pessoas as $pessoa) {
                $item = file_get_contents('html/item.html');
                $item = str_replace('{Cli_codigo}', $pessoa['Cli_codigo'], $item);
                $item = str_replace('{Cli_nome}', $pessoa['Cli_nome'], $item);
                $item = str_replace('{Cli_endereco}', $pessoa['Cli_endereco'], $item);
                $item = str_replace('{Cli_bairro}', $pessoa['Cli_bairro'], $item);
                $item = str_replace('{Cli_telefone}', $pessoa['Cli_telefone'], $item);

                $items .= $item;
            }
            $this->html = str_replace('{items}', $items, $this->html);
        } catch (Exception $e) {
            $this->html = $e->getMessage();
        }
    }

    public function show() {
        $this->load();
        return $this->html;
    }

}
