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

    public function buscarPorNomeOuEmail($termo, $idUsuarioLogado, $limite = 10)
    {
        $sql = $this->con->prepare(
            "SELECT id_usuario, nome, email
             FROM usuarios
             WHERE id_usuario <> :id
             AND banido = 0
             AND (nome LIKE :termo OR email LIKE :termo)
             ORDER BY nome
             LIMIT :limite"
        );

        $sql->bindValue(':id', $idUsuarioLogado);
        $sql->bindValue(':termo', '%' . $termo . '%');
        $sql->bindValue(':limite', $limite, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    public function existeExceto($idUsuario, $idUsuarioLogado)
    {
        $sql = $this->con->prepare(
            "SELECT id_usuario
             FROM usuarios
             WHERE id_usuario = :idUsuario
             AND id_usuario <> :idUsuarioLogado
             AND banido = 0"
        );

        $sql->bindValue(':idUsuario', $idUsuario);
        $sql->bindValue(':idUsuarioLogado', $idUsuarioLogado);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_OBJ) !== false;
    }

    public function estaBanido($idUsuario)
    {
        $sql = $this->con->prepare(
            "SELECT banido FROM usuarios WHERE id_usuario = :id"
        );

        $sql->bindValue(':id', $idUsuario);
        $sql->execute();

        $resultado = $sql->fetch(PDO::FETCH_OBJ);

        return $resultado && (int) $resultado->banido === 1;
    }

    public function listarTodosExceto($idUsuarioLogado)
    {
        $sql = $this->con->prepare(
            "SELECT id_usuario, nome, email, role, banido, motivo_banimento
             FROM usuarios
             WHERE id_usuario <> :id
             ORDER BY nome"
        );

        $sql->bindValue(':id', $idUsuarioLogado);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    public function banir($idUsuario, $motivo)
    {
        $sql = $this->con->prepare(
            "UPDATE usuarios
             SET banido = 1, motivo_banimento = :motivo
             WHERE id_usuario = :id
             AND role <> 'admin'"
        );

        $sql->bindValue(':motivo', $motivo);
        $sql->bindValue(':id', $idUsuario);
        $sql->execute();
    }

    public function desbanir($idUsuario)
    {
        $sql = $this->con->prepare(
            "UPDATE usuarios
             SET banido = 0, motivo_banimento = NULL
             WHERE id_usuario = :id"
        );

        $sql->bindValue(':id', $idUsuario);
        $sql->execute();
    }
}