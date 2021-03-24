<?php

require_once './db/Connection.php';

class Cidade {    

    public static function all() {
        $conn = Connection::open();
        $result = $conn->query("SELECT * FROM cidades ORDER BY cid_codigo");
        return $result->fetchAll();
    }

}
