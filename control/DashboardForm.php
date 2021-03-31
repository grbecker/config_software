<?php

require_once 'classes/Lancamento.php';
require_once 'util/FormatValues.php';


class DashboardForm {

    private $html;
    private $js;

    public function __construct() {
        $this->html = file_get_contents('html/formDashboard.html');
        $this->js = file_get_contents('html/js/dashboard.js');

        $lancamentos = Lancamento::allDay("");
        $labels = "";
        $datasets = "";
        foreach ($lancamentos as $row) {
            if ($labels == "") {
                $labels .= "'" . FormatValues::dataNormal($row['data']) . "'";
                $datasets .= "'" . $row['valor'] . "'";
            } else {
                $labels .= ",'" . FormatValues::dataNormal($row['data']) . "'";
                $datasets .= ",'" . $row['valor'] . "'";
            }
        }
        
        $this->js = str_replace('{labels}', $labels, $this->js);
        $this->js = str_replace('{datasets}', $datasets, $this->js);
        
        $arquivo = fopen('html/js/dashboard.js', 'w');
        $texto = $this->js;
        fwrite($arquivo, $texto);
        fclose($arquivo);
    }

    public function show() {
        return $this->html;
    }

}
