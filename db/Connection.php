<?php

class Connection {

    private function __construct() {
        
    }

    static $user = "root";
    static $pass = "Spsinf";
    static $database = "psinf";
    static $host = "127.0.0.1";
    static $port = "3306";

    public static function connectionAdmin() {
        $conn = new PDO("mysql:host=127.0.01;port=3306;dbname=psinf", "root", "Spsinf@2021");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

    public static function open() {
        $conn = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

}
