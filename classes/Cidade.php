<?php

class Cidade {

    public static function all() {
        $conn = new PDO("mysql:host=127.0.0.1;port=3306;dbname=psinf", "suporte-psinf", "Spsinf");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $result = $conn->query("SELECT * FROM cidades ORDER BY cid_codigo");
        return $result->fetchAll();
    }

}
