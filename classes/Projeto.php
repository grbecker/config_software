<?php

require_once './db/Connection.php';
//require_once 'C:\wamp64\www\config_software\db\Connection.php';

class Projeto {

    public static function find($id) {        
        if ($id != "") {        
        $conn = Connection::open();
        $result = $conn->prepare("SELECT * FROM projeto WHERE id_empresa = 1 AND id=:id");
        $result->execute([':id' => $id]);
        return $result->fetch();
        } else {
            throw new Exception("Erro ao pesquisa projeto campo \"id\" obrigatório");
        }
    }

    public static function delete($id) {       
        if (!filter_var($id, FILTER_VALIDATE_INT)) {  
            throw new Exception("Erro ao excluir projeto campo \"id\" não é valido!");            
        } else if ($id != "" && $id != 0) {
            $conn = Connection::open();
            $result = $conn->prepare("DELETE FROM projeto WHERE id_empresa = 1 AND id=:id");
            $result->execute([':id' => $id]);
            return true;
        } else {
            throw new Exception("Erro ao excluir projeto campo \"id\" obrigatório");
        }
    }

    public static function all($where, $orderby) {
        $conn = Connection::open();
        if ($orderby == ""){
            $orderby = "nome";
        }
        $result = $conn->query("SELECT projeto.id as id, projeto.nome as nome, projeto.valor as valor, projeto.observacao as observacao, status.nome as status, status.ordem, status.cor as cor FROM projeto LEFT JOIN status ON projeto.id_empresa = status.id_empresa AND projeto.status = status.id WHERE projeto.id_empresa = 1 $where ORDER BY $orderby LIMIT 1000");
        return $result->fetchAll();
    }

    public static function save($projeto) {
        $conn = Connection::open();
        if (empty($projeto['id'])) {
            $result = $conn->query("SELECT max(id) as next FROM projeto WHERE id_empresa = 1");
            $row = $result->fetch();
            $projeto['id'] = (int) $row['next'] + 1;

            $sql = "INSERT INTO projeto (id_empresa, id, nome, observacao, status, valor)
                                VALUES ( :id_empresa, :id, :nome, :observacao, :status, :valor)";
        } else {
            $sql = "UPDATE projeto SET 
                                  id_empresa  = :id_empresa,
                                  id   = :id,
                                  nome = :nome,
                                  observacao = :observacao,
                                  status = :status, 
                                  valor = :valor                                  
                        WHERE id_empresa = :id_empresa AND id = :id";
        }
        $result = $conn->prepare($sql);
        $result->execute([':id_empresa' => 1,
            ':id' => $projeto['id'],
            ':nome' => $projeto['nome'],
            ':observacao' => $projeto['observacao'],
            ':valor' => $projeto['valor'],
            ':status' => $projeto['status']
        ]);
        return $projeto['id'];
    }

}
