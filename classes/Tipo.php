<?php

require_once './db/Connection.php';

class Tipo {

    public static function find($id) {
        $conn = Connection::open();
        $result = $conn->prepare("SELECT * FROM tipo_pagamento WHERE id_empresa = 1 AND id=:id");
        $result->execute([':id' => $id]);
        return $result->fetch();
    }

    public static function delete($id) {
        $conn = Connection::open();
        $result = $conn->prepare("DELETE FROM tipo_pagamento WHERE id_empresa = 1 AND id=:id");
        $result->execute([':id' => $id]);
    }

    public static function all($where) {
        $conn = Connection::open();                  
        $result = $conn->query("SELECT * FROM tipo_pagamento WHERE id_empresa = 1 {$where} ORDER BY nome LIMIT 1000");
        return $result->fetchAll();
    }

    public static function save($tipo) {
        $conn = Connection::open();
        if (empty($tipo['id'])) {
            $result = $conn->query("SELECT max(id) as next FROM tipo_pagamento WHERE id_empresa = 1");
            $row = $result->fetch();
            $tipo['id'] = (int) $row['next'] + 1;

            $sql = "INSERT INTO tipo_pagamento (id_empresa, id, nome, icone)
                                VALUES ( :id_empresa, :id, :nome, :icone)";
        } else {
            $sql = "UPDATE tipo_pagamento SET 
                                  id_empresa  = :id_empresa,
                                  id   = :id,
                                  nome = :nome,
                                  icone = :icone
                        WHERE id_empresa = :id_empresa AND id = :id";
        }
        $result = $conn->prepare($sql);
        $result->execute([':id_empresa' => 1,
            ':id' => $tipo['id'],
            ':nome' => $tipo['nome'],
            ':icone' => $tipo['icone']
        ]);
        return $tipo['id'];
    }

}
