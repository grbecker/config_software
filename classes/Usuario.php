<?php

require_once './db/Connection.php';
require_once 'Session.php';

//require_once 'C:\wamp64\www\config_software\db\Connection.php';
//require_once 'C:\wamp64\www\config_software\classes\Session.php';

class Usuario {

    public function __construct() {
        
    }

    public static function login($usuario) {
        $conn = Connection::open();
        $result = $conn->prepare("SELECT * FROM usuario WHERE email = :email AND senha = :senha");
        $result->execute([
            ':email' => $usuario['email'],
            ':senha' => md5($usuario['senha'])
        ]);
        if ($result->rowCount()) {
            $query = $result->fetch();
            Session::setValue('logged', TRUE);
            Session::setValue('id_usuario', $query['id']);
            Session::setValue('nome', $query['nome']);
            return true;
        } else {
            return "Usuário ou senha incorretos";
        }
    }

    public static function find($empresa, $id) {
        $result = $conn->prepare("SELECT * FROM usuario WHERE id_empresa=:id_empresa AND id = :id");
        $result->execute([':id_empresa' => $empresa,
            ':id' => $id]);
        return $result->fetch();
    }

    public static function delete($id) {
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            throw new Exception("Erro ao excluir usuário campo \"id\" não é valido!");
        } else if ($id != "" && $id != 0) {
            $result = $conn->prepare("DELETE FROM usuario WHERE id_empresa=:id_empresa AND id = :id");
            $result->execute([':id_empresa' => 1,
                ':id' => $id]);
            return true;
        } else {
            throw new Exception("Erro ao excluir usuário campo \"id\" obrigatório");
        }
    }

    public static function all($empresa) {
        $result = $conn->query("SELECT * FROM usuario WHERE id_empresa=:id_empresa ORDER BY nome LIMIT 1000");
        return $result->fetchAll();
    }

    public static function save($empresa, $usuario) {
        if (empty($usuario['id'])) {
            $result = $conn->query("SELECT max(id) as next FROM usuario");
            $row = $result->fetch();
            $pessoa['id'] = (int) $row['next'] + 1;

            $sql = "INSERT INTO usuario (id_empresa, id, nome, email, senha)
                                VALUES  (:id_empresa, :id, :nome, :email, :senha)";
        } else {
            $sql = "UPDATE usuario SET id_empresa  = :id_empresa,
                                  id  = :id,
                                  nome    = :nome,
                                  email  = :email,
                                  senha     = :senha 
                        WHERE id_empresa=:id_empresa AND id = :id";
        }
        $result = $conn->prepare($sql);
        $result->execute([
            ':id_empresa' => $usuario['id_empresa'],
            ':id' => $usuario['id'],
            ':nome' => $usuario['nome'],
            ':usuario' => $usuario['usuario'],
            ':senha' => $usuario['senha']
        ]);
    }

}
