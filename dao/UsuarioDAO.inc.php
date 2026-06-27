<?php

require_once 'conexao.inc.php';
require_once '../classes/Usuario.inc.php';

class UsuarioDAO
{
    private $con;

    public function __construct()
    {
        $c = new Conexao();
        $this->con = $c->getConexao();
    }

    public function cadastrarUsuario(Usuario $usuario)
    {
        $sql = $this->con->prepare(
            "INSERT INTO usuarios (nome, email, senha)
             VALUES (:nome, :email, :senha)"
        );

        $senhaCriptografada = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);

        $sql->bindValue(':nome', $usuario->getNome());
        $sql->bindValue(':email', $usuario->getEmail());
        $sql->bindValue(':senha', $senhaCriptografada);

        $sql->execute();
    }

    public function autenticar($email, $senha)
    {
        $sql = $this->con->prepare(
            "SELECT * FROM usuarios WHERE email = :email LIMIT 1"
        );

        $sql->bindValue(':email', $email);
        $sql->execute();

        $usuario = $sql->fetch(PDO::FETCH_OBJ);

        if ($usuario && password_verify($senha, $usuario->senha)) {
            return $usuario;
        }

        return null;
    }

    public function listarUsuariosExceto($idUsuarioLogado)
    {
        $sql = $this->con->prepare(
            "SELECT id_usuario, nome, email
             FROM usuarios
             WHERE id_usuario <> :id
             ORDER BY nome"
        );

        $sql->bindValue(':id', $idUsuarioLogado);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
}