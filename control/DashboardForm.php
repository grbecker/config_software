<?php

require_once 'classes/Lancamento.php';
require_once 'classes/Projeto.php';
require_once 'util/FormatValues.php';

class DashboardForm {

    private $html;
    private $js;

    public function __construct() {
        $this->html = file_get_contents('html/formDashboard.html');

        $lancamentos = Lancamento::dashboard("");
        $this->html = str_replace('{despesas}', number_format($lancamentos['despesas'], 2, ',', '.'), $this->html);
        $this->html = str_replace('{receitas}', number_format($lancamentos['receitas'], 2, ',', '.'), $this->html);
        $this->html = str_replace('{caixa}', number_format($lancamentos['receitas'] - $lancamentos['despesas'], 2, ',', '.'), $this->html);

        $lancamentos = Lancamento::contasReceber("");
        $total = 0;
        foreach ($lancamentos as $row) {
            if ($row['valor_projeto'] - $row['valor'] > 0) {
                $total = $total + ($row['valor_projeto'] - $row['valor']);
            }
        }
        $this->html = str_replace('{emaberto}', number_format("0", 2, ',', '.'), $this->html);


        $projeto = Projeto::all("", "status.ordem");
        $item = "";
        $items = "";
        $status = "";
        $ultimoStatus = "";
        $ultimaCor = "";
        
        $list = "";
        foreach ($projeto as $row) {
            
            
            if ($status == "") {
                $status = $row["status"];
                $ultimoStatus = $row["status"];
                $ultimaCor = $row["cor"];                
            }
            
            if ($status != $row["status"]) {
                $item = file_get_contents('html/card.html');
                $item = str_replace('{status}', $ultimoStatus, $item);
                $item = str_replace('{cor}', $ultimaCor, $item);
                $item = str_replace('{list}', $list, $item);
                $items .= $item;
                $list = "";
            }
            $ultimaCor = $row["cor"];            
            $list .= "<li class=\"list-group-item d-flex justify-content-between align-items-start\">
                <div class=\"ms-2 me-auto\">
                    <div class=\"fw-bold\">{$row['nome']}</div>                    
                </div>
                
                <span>R$ " . number_format($row["valor"], 2, ',', '.') ." </span> 
                <a href=\"index.php?class=ProjetoForm&method=edit&?id={$row["id"]}\"> <i class=\"bi bi-pencil-square\"></i> </a>    
            </li>";
            $ultimoStatus = $row["status"];
            $status = $row["status"];
        }
        $this->html = str_replace('{cards}', $items, $this->html);
        $lancamentos = Lancamento::allDay("");
        $labels = "";
        $datasets = "";
        foreach ($lancamentos as $row) {


            if ($row['mes'] < 10) {
                $fmes = "0" . $row['mes'];
            } else {
                $fmes = $row['mes'];
            }
            if ($labels == "") {
                $labels .= "'" . $fmes . "-" . $row['ano'] . "'";
                $datasets .= "'" . FormatValues::decimalEN($row['total']) . "'";
            } else {
                $labels .= ",'" . $fmes . "-" . $row['ano'] . "'";
                $datasets .= ",'" . FormatValues::decimalEN($row['total']) . "'";
            }
        }

        $this->js = "        (function () {
        'use strict'
          feather.replace()
          // Graphs
          var ctx = document.getElementById('myChart')
          // eslint-disable-next-line no-unused-vars
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: [
              {labels}
              ],
              datasets: [{
                data: [
                {datasets}
                ],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: false
                  }
                }]
              },
              legend: {
                display: false
              }
            }
          })
        })()";

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
