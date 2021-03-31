<?php

require_once './db/Connection.php';
require_once 'Session.php';

class Lancamento {

    public static function find($id) {
        $conn = Connection::open();
        $result = $conn->prepare("SELECT * FROM lancamentos WHERE id_empresa = 1 AND id=:id");
        $result->execute([':id' => $id]);
        return $result->fetch();
    }

    public static function delete($id) {
        $conn = Connection::open();
        $result = $conn->prepare("DELETE FROM lancamentos WHERE id_empresa = 1 AND id=:id");
        $result->execute([':id' => $id]);
    }

    
    public static function allDay($where) {
        $conn = Connection::open();
        $result = $conn->query("SELECT "
                . "data, valor "
                . "FROM "
                . "lancamentos "
                . "WHERE lancamentos.id_empresa = 1 " . $where . " "
                . "GROUP BY data "
                . "ORDER BY data LIMIT 1000");
        return $result->fetchAll();
    }
    
    
    public static function all($where) {
        $conn = Connection::open();
        $result = $conn->query("SELECT "
                . "lancamentos.id as id, categoria.nome as nome, data, valor, tipo_pagamento.nome as tipo_nome, lancamentos.tipo as tipo, "
                . "complemento, paga, projeto.nome as projeto, status.nome as status "
                . "FROM "
                . "lancamentos "
                . "LEFT JOIN categoria ON lancamentos.id_empresa = categoria.id_empresa AND lancamentos.id_categoria = categoria.id "
                . "LEFT JOIN tipo ON lancamentos.tipo = tipo.id "
                . "LEFT JOIN tipo_pagamento ON lancamentos.id_empresa = tipo_pagamento.id_empresa AND lancamentos.id_pagamento = tipo_pagamento.id "
                . "LEFT JOIN projeto ON lancamentos.id_empresa = projeto.id_empresa AND lancamentos.id_projeto = projeto.id "
                . "LEFT JOIN status ON projeto.id_empresa = status.id_empresa AND projeto.status = status.id "
                . "WHERE lancamentos.id_empresa = 1 " . $where . " "
                . "ORDER BY tipo,data,tipo_nome LIMIT 1000");
        return $result->fetchAll();
    }

    public static function save($lancamento) {
        $conn = Connection::open();
        if (empty($lancamento['id'])) {
            $result = $conn->query("SELECT max(id) as next FROM lancamentos WHERE id_empresa = 1");
            $row = $result->fetch();
            $lancamento['id'] = (int) $row['next'] + 1;

            $sql = "INSERT INTO lancamentos (id_empresa, id, id_usuario, id_categoria, id_projeto, id_pagamento, data, valor, tipo, paga, complemento, anexo)
                                VALUES (:id_empresa, :id, :id_usuario, :id_categoria, :id_projeto, :id_pagamento, :data, :valor, :tipo, :paga, :complemento, :anexo)";
        } else {
            $sql = "UPDATE lancamentos SET 
                                  id_empresa  = :id_empresa,
                                  id   = :id,
                                  id_usuario = :id_usuario, 
                                  id_categoria = :id_categoria,
                                  id_projeto = :id_projeto,
                                  id_pagamento = :id_pagamento,
                                  data = :data,
                                  valor = :valor,
                                  tipo = :tipo,
                                  paga = :paga,
                                  complemento = :complemento,
                                  anexo = :anexo
                        WHERE id_empresa = :id_empresa AND id = :id";
        }
        $result = $conn->prepare($sql);
        $result->execute([':id_empresa' => 1,
            ':id' => $lancamento['id'],
            ':id_usuario' => Session::getValue('id_usuario'),
            ':id_categoria' => $lancamento['id_categoria'],
            ':id_pagamento' => $lancamento['id_pagamento'],
            ':id_projeto' => $lancamento['id_projeto'],
            ':data' => $lancamento['data'],
            ':valor' => $lancamento['valor'],
            ':tipo' => $lancamento['tipo'],
            ':paga' => $metodo = isset($lancamento['paga']) ? "S" : "N",
            ':complemento' => $lancamento['complemento'],
            ':anexo' => isset($lancamento['anexo']) ? $lancamento['anexo'] : ""                      
        ]);
        return $lancamento['id'];
    }

}
