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
}