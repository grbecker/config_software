<?php

class Connection {

    static $conn;

    public static function open() {

        if (empty(self::$conn)) {
            self::$conn = new PDO("mysql:host=127.0.0.1;port=3307;dbname=gastos", "root", "");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$conn;
        } else {
            return self::$conn;
        }
    }

}
