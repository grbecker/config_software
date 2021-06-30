<?php

class FormatValues {

    public $soma;

    public function __construct() {
        $this->soma;
    }

    public static function decimalEN($valor) {
        if (is_numeric($valor)) {
            return number_format($valor, 2, '.', '');
        } else {
            return false;
        }
    }

    public static function decimalPT($valor) {
        return number_format($valor, 2, ',', '.');
    }

    public static function dataNormal($data) {
        if (trim($data) == "") {
            return "";
        } else if (date("d/m/Y", strtotime(str_replace("-", "/", $data))) == "31/12/1969" || date("d/m/Y", strtotime(str_replace("-", "/", $data))) == "01/01/1970") {
            return "";
        } else {
            return date("d/m/Y", strtotime(str_replace("-", "/", $data)));
        }
    }

    public static function dataSQL($data) {
        if (trim($data) == "") {
            return "";
        } else {
            return date("Y-m-d", strtotime(str_replace("/", "-", $data)));
        }
    }

    public function somaGasto($valor, $tipo) {
        if ($tipo == "D") {
           $this->soma = $this->soma - $valor;
        } else {
           $this->soma = $this->soma + $valor;
        }
    }
    public function getSaldo() {
        return $this->soma;
    }
}
