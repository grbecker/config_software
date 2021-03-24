<?php

require_once './db/Connection.php';
require_once './classes/Session.php';


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
            Session::setValue('logged', TRUE);
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

    public static function delete($empresa, $id) {
        $result = $conn->prepare("DELETE FROM usuario WHERE id_empresa=:id_empresa AND id = :id");
        $result->execute([':id_empresa' => $empresa, 
                          ':id' => $id]);
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
