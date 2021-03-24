<?php

require_once './db/Connection.php';

class Pessoa {

    public static function find($codigo) {
        $conn = Connection::open();
        $result = $conn->prepare("SELECT * FROM clientes WHERE Cli_codigo=:Cli_codigo");
        $result->execute([':Cli_codigo' => $codigo]);
        return $result->fetch();
    }

    public static function delete($codigo) {
        $conn = Connection::open();
        $result = $conn->prepare("DELETE FROM clientes WHERE Cli_codigo=:Cli_codigo");
        $result->execute([':Cli_codigo' => $codigo]);
    }

    public static function all() {
        $conn = Connection::open();
        $result = $conn->query("SELECT * FROM clientes ORDER BY Cli_codigo LIMIT 1000");
        return $result->fetchAll();
    }

    public static function save($pessoa) {
        $conn = Connection::open();
        if (empty($pessoa['Cli_codigo'])) {
            $result = $conn->query("SELECT max(Cli_codigo) as next FROM clientes");
            $row = $result->fetch();
            $pessoa['Cli_codigo'] = (int) $row['next'] + 1;

            $sql = "INSERT INTO clientes (Cli_codigo, Cli_nome, Cli_endereco, Cli_bairro, Cli_telefone,
                                        Cli_email, Cli_cd_cidade)
                                VALUES ( :Cli_codigo, :Cli_nome, :Cli_endereco,
                                         :Cli_bairro, :Cli_telefone, :Cli_email, :Cli_cd_cidade )";
        } else {
            $sql = "UPDATE clientes SET Cli_nome  = :Cli_nome,
                                  Cli_endereco  = :Cli_endereco,
                                  Cli_bairro    = :Cli_bairro,
                                  Cli_telefone  = :Cli_telefone,
                                  Cli_email     = :Cli_email,
                                  Cli_cd_cidade = :Cli_cd_cidade
                        WHERE Cli_codigo = :Cli_codigo";
        }
        $result = $conn->prepare($sql);
        $result->execute([':Cli_codigo' => $pessoa['Cli_codigo'],
            ':Cli_nome' => $pessoa['Cli_nome'],
            ':Cli_endereco' => $pessoa['Cli_endereco'],
            ':Cli_bairro' => $pessoa['Cli_bairro'],
            ':Cli_telefone' => $pessoa['Cli_telefone'],
            ':Cli_email' => $pessoa['Cli_email'],
            ':Cli_cd_cidade' => $pessoa['Cli_cd_cidade']
        ]);
    }

}
