<?php

class TranslateClass {

    public static function convert($classe, $type) {
        switch ($classe) {
            case "DashboardForm":
                return "Dashboard";
            case "CategoriaList":
                return "Lista de categoria";
            case "CategoriaForm":
                return "Cadastro de categoria";
            case "TipoList":
                return "Lista Tipo Pagamento - ALTERADA";
            case "TipoForm":
                return "Cadastro Tipo pagamento";
            case "ProjetoList":
                return "Lista de Projetos";
            case "ProjetoForm":
                return "Cadastro de Projetos";
            case "LancamentoForm":
                if ($type == "D") {
                    return "Lançamento - Despesa";
                } else if ($type == "I") {
                    return "Lançamento - Investimento";
                } else if ($type == "R") {
                    return "Lançamento - Receita";
                } else {
                    return "";
                }
            case "LancamentoList":
                return "Relatório Financeiro";
            case "ContasReceberList":
                return "Relatório Contas Receber";
            default : "";
        }
    }

    public function routeClass($arquivo) {
        if (file_exists('./classes/' . $arquivo . '.php')) {
            return true;
        } else {
            return false;
        }
    }
    
    public function routeControl($arquivo) {
        if (file_exists('./control/' . $arquivo . '.php')) {
            return true;
        } else {
            return false;
        }
    }
}
