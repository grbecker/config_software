<?php

class Migration {

    private $sql;

    public function __construct($table) {
        $this->sql = "CREATE TABLE IF NOT EXISTS `$table` (";
    }

    function addInt($col) {
        $this->sql .= "`$col` int(11) NOT NULL,";
    }

    function addString($col) {
        $this->sql .= "`$col` varchar(100) DEFAULT NULL,";
    }

    function addFloat($col) {
        $this->sql .= "`$col` FLOAT NULL,";
    }

    function create() {
        $this->sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1";        
        $conn = Connection::open();
        $result = $conn->prepare(str_replace(",)", ")", $this->sql));
        if (!$result->execute()) {
            return print_r($result->errorInfo());
        } else {
            return "Migration Verify: OK";
        }
    }

}
