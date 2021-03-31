<?php

require_once './db/Connection.php';

class Categoria {

    public static function find($id) {
        $conn = Connection::open();
        $result = $conn->prepare("SELECT * FROM categoria WHERE id_empresa = 1 AND id=:id");
        $result->execute([':id' => $id]);
        return $result->fetch();
    }

    public static function delete($id) {
        $conn = Connection::open();
        $result = $conn->prepare("DELETE FROM categoria WHERE id_empresa = 1 AND id=:id");
        $result->execute([':id' => $id]);
    }

    public static function all($where) {
        $conn = Connection::open();
        $result = $conn->query("SELECT categoria.id as id, categoria.nome as nome, categoria.tipo as id_tipo, tipo.nome as tipo_nome FROM categoria LEFT JOIN tipo ON categoria.tipo = tipo.id WHERE id_empresa = 1 {$where} ORDER BY nome LIMIT 1000");
        return $result->fetchAll();
    }

    public static function save($categoria) {
        $conn = Connection::open();
        if (empty($categoria['id'])) {
            $result = $conn->query("SELECT max(id) as next FROM categoria WHERE id_empresa = 1");
            $row = $result->fetch();
            $categoria['id'] = (int) $row['next'] + 1;

            $sql = "INSERT INTO categoria (id_empresa, id, nome, tipo, essencial)
                                VALUES ( :id_empresa, :id, :nome, :tipo, :essencial)";
        } else {
            $sql = "UPDATE categoria SET 
                                  id_empresa  = :id_empresa,
                                  id   = :id,
                                  nome = :nome,
                                  tipo = :tipo,
                                  essencial = :essencial
                        WHERE id_empresa = :id_empresa AND id = :id";
        }
        $result = $conn->prepare($sql);
        $result->execute([':id_empresa' => 1,
            ':id' => $categoria['id'],
            ':nome' => $categoria['nome'],
            ':tipo' => $categoria['tipo'],
            ':essencial' => $categoria['essencial']
        ]);
        return $categoria['id'];
    }

}
