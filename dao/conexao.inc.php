<?php

class Conexao
{
    private $host = "localhost";
    private $dbname = "webforum";
    private $usuario = "root";
    private $senha = "";

    public function getConexao()
    {
        try {
            $con = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;charset=utf8",
                $this->usuario,
                $this->senha
            );

            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $con;
        } catch (PDOException $e) {
            die("Erro ao conectar com o banco: " . $e->getMessage());
        }
    }
}