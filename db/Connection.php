<?php

class Connection {

    static $conn;

    public static function open() {

        if (empty(self::$conn)) {
            self::$conn = new PDO("mysql:host=c107gastos.mysql.dbaas.com.br;port=3306;dbname=c107gastos", "c107gastos", "Senhapsi@1234");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$conn;
        } else {
            return self::$conn;
        }
    }

}
