<?php

require_once 'conexao.inc.php';
require_once '../classes/Mensagem.inc.php';

class MensagemDAO
{
    private $con;

    public function __construct()
    {
        $c = new Conexao();
        $this->con = $c->getConexao();
    }

    public function enviarMensagem(Mensagem $mensagem)
    {
        $sql = $this->con->prepare(
            "INSERT INTO mensagens 
             (id_remetente, id_destinatario, assunto, corpo)
             VALUES (:remetente, :destinatario, :assunto, :corpo)"
        );

        $sql->bindValue(':remetente', $mensagem->getIdRemetente());
        $sql->bindValue(':destinatario', $mensagem->getIdDestinatario());
        $sql->bindValue(':assunto', $mensagem->getAssunto());
        $sql->bindValue(':corpo', $mensagem->getCorpo());

        $sql->execute();
    }

    public function listarRecebidas($idUsuario)
    {
        $sql = $this->con->prepare(
            "SELECT 
                m.id_mensagem,
                m.assunto,
                m.data_envio,
                m.lida,
                u.nome AS remetente_nome,
                u.email AS remetente_email
             FROM mensagens m
             INNER JOIN usuarios u ON m.id_remetente = u.id_usuario
             WHERE m.id_destinatario = :id
             ORDER BY m.data_envio DESC"
        );

        $sql->bindValue(':id', $idUsuario);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    public function buscarMensagemRecebida($idMensagem, $idUsuario)
    {
        $sql = $this->con->prepare(
            "SELECT 
                m.id_mensagem,
                m.assunto,
                m.corpo,
                m.data_envio,
                u.nome AS remetente_nome,
                u.email AS remetente_email
             FROM mensagens m
             INNER JOIN usuarios u ON m.id_remetente = u.id_usuario
             WHERE m.id_mensagem = :idMensagem
             AND m.id_destinatario = :idUsuario"
        );

        $sql->bindValue(':idMensagem', $idMensagem);
        $sql->bindValue(':idUsuario', $idUsuario);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_OBJ);
    }

    public function removerMensagem($idMensagem, $idUsuario)
    {
        $sql = $this->con->prepare(
            "DELETE FROM mensagens
             WHERE id_mensagem = :idMensagem
             AND id_destinatario = :idUsuario"
        );

        $sql->bindValue(':idMensagem', $idMensagem);
        $sql->bindValue(':idUsuario', $idUsuario);

        $sql->execute();
    }

    public function marcarComoLida($idMensagem, $idUsuario)
    {
        $sql = $this->con->prepare(
            "UPDATE mensagens
         SET lida = 1
         WHERE id_mensagem = :idMensagem
         AND id_destinatario = :idUsuario"
        );

        $sql->bindValue(':idMensagem', $idMensagem);
        $sql->bindValue(':idUsuario', $idUsuario);

        $sql->execute();
    }

    public function listarEnviadas($idUsuario)
    {
        $sql = $this->con->prepare(
            "SELECT 
            m.id_mensagem,
            m.assunto,
            m.data_envio,
            m.lida,
            u.nome AS destinatario_nome,
            u.email AS destinatario_email
         FROM mensagens m
         INNER JOIN usuarios u ON m.id_destinatario = u.id_usuario
         WHERE m.id_remetente = :id
         ORDER BY m.data_envio DESC"
        );

        $sql->bindValue(':id', $idUsuario);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    public function buscarMensagemEnviada($idMensagem, $idUsuario)
    {
        $sql = $this->con->prepare(
            "SELECT 
            m.id_mensagem,
            m.assunto,
            m.corpo,
            m.data_envio,
            m.lida,
            u.nome AS destinatario_nome,
            u.email AS destinatario_email
         FROM mensagens m
         INNER JOIN usuarios u ON m.id_destinatario = u.id_usuario
         WHERE m.id_mensagem = :idMensagem
         AND m.id_remetente = :idUsuario"
        );

        $sql->bindValue(':idMensagem', $idMensagem);
        $sql->bindValue(':idUsuario', $idUsuario);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_OBJ);
    }

    public function contarNaoLidas($idUsuario)
    {
        $sql = $this->con->prepare(
            "SELECT COUNT(*) AS total
         FROM mensagens
         WHERE id_destinatario = :idUsuario
         AND lida = 0"
        );

        $sql->bindValue(':idUsuario', $idUsuario);
        $sql->execute();

        $resultado = $sql->fetch(PDO::FETCH_OBJ);

        return (int) $resultado->total;
    }
}