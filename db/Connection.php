<?php

class Connection {

    static $conn;

    public static function open() {

        if (empty(self::$conn)) {
            self::$conn = new PDO("mysql:host=localhost;port=3306;dbname=gastos", "root", "12345678");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$conn;
        } else {
            return self::$conn;
        }
    }

}
