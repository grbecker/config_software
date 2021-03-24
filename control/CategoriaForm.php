<?php

require_once 'classes/Pessoa.php';
require_once 'classes/Cidade.php';

class PessoaForm {

    private $html;
    private $data;

    public function __construct() {
        $this->html = file_get_contents('html/form.html');
        $this->data = ['Cli_codigo' => null,
            'Cli_nome' => null,
            'Cli_endereco' => null,
            'Cli_bairro' => null,
            'Cli_telefone' => null,
            'Cli_email' => null,
            'Cli_cd_cidade' => null,
            'Cli_telefone' => null                        
            ];

        $cidades = '';
        foreach (Cidade::all() as $cidade) {
            $cidades .= "<option value='{$cidade['Cid_codigo']}'> {$cidade['Cid_nome']} </option>";
        }
        $this->html = str_replace('{cidades}', $cidades, $this->html);
    }

    public function edit($param) {
        try {
            $codigo = (int) $param['id'];
            $this->data = Pessoa::find($codigo);
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function save($param) {
        try {
            Pessoa::save($param);
            $this->data = $param;
            print "Pessoa salva com sucesso";
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }

    public function show() {
        $this->html = str_replace('{Cli_codigo}', $this->data['Cli_codigo'], $this->html);
        $this->html = str_replace('{Cli_nome}', $this->data['Cli_nome'], $this->html);
        $this->html = str_replace('{Cli_endereco}', $this->data['Cli_endereco'], $this->html);
        $this->html = str_replace('{Cli_bairro}', $this->data['Cli_bairro'], $this->html);
        $this->html = str_replace('{Cli_telefone}', $this->data['Cli_telefone'], $this->html);
        $this->html = str_replace('{Cli_email}', $this->data['Cli_email'], $this->html);
        $this->html = str_replace('{Cli_cd_cidade}', $this->data['Cli_cd_cidade'], $this->html);

        $this->html = str_replace("option value='{$this->data['Cli_cd_cidade']}'", "option selected=1 value='{$this->data['Cli_cd_cidade']}'", $this->html);
        print $this->html;
    }

}
