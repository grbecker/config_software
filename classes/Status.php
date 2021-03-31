<?php

require_once './db/Connection.php';

class Status {

    public static function find($id) {
        $conn = Connection::open();
        $result = $conn->prepare("SELECT * FROM status WHERE id_empresa = 1 AND id=:id");
        $result->execute([':id' => $id]);
        return $result->fetch();
    }

    public static function delete($id) {
        $conn = Connection::open();
        $result = $conn->prepare("DELETE FROM status WHERE id_empresa = 1 AND id=:id");
        $result->execute([':id' => $id]);
    }

    public static function all() {
        $conn = Connection::open();
        $result = $conn->query("SELECT * FROM status WHERE id_empresa = 1 ORDER BY nome LIMIT 1000");
        return $result->fetchAll();
    }

    public static function save($status) {
        $conn = Connection::open();
        if (empty($status['id'])) {
            $result = $conn->query("SELECT max(id) as next FROM status WHERE id_empresa = 1");
            $row = $result->fetch();
            $status['id'] = (int) $row['next'] + 1;

            $sql = "INSERT INTO status (id_empresa, id, nome)
                                VALUES ( :id_empresa, :id, :nome)";
        } else {
            $sql = "UPDATE status SET 
                                  id_empresa  = :id_empresa,
                                  id   = :id,
                                  nome = :nome
                        WHERE id_empresa = :id_empresa AND id = :id";
        }
        $result = $conn->prepare($sql);
        $result->execute([':id_empresa' => 1,
            ':id' => $status['id'],
            ':nome' => $status['nome']
        ]);
        return $status['id'];
    }

}
