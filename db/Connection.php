<?php

class Connection {

    static $conn;

    public static function open() {

        if (empty(self::$conn)) {            
			//self::$conn = new PDO("mysql:host=172.18.0.3;port=3307;dbname=gastos", "root", "");
			self::$conn = new PDO("mysql:host=mysql_homolog;dbname=gastos", "gastos", "12345678");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$conn;
        } else {
            return self::$conn;
        }
    }

}
