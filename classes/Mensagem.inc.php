<?php

class Mensagem
{
    private $id_mensagem;
    private $id_remetente;
    private $id_destinatario;
    private $assunto;
    private $corpo;
    private $data_envio;

    public function setMensagem($id_remetente, $id_destinatario, $assunto, $corpo)
    {
        $this->id_remetente = $id_remetente;
        $this->id_destinatario = $id_destinatario;
        $this->assunto = $assunto;
        $this->corpo = $corpo;
    }

    public function getIdMensagem()
    {
        return $this->id_mensagem;
    }

    public function setIdMensagem($id)
    {
        $this->id_mensagem = $id;
    }

    public function getIdRemetente()
    {
        return $this->id_remetente;
    }

    public function getIdDestinatario()
    {
        return $this->id_destinatario;
    }

    public function getAssunto()
    {
        return $this->assunto;
    }

    public function getCorpo()
    {
        return $this->corpo;
    }

    public function getDataEnvio()
    {
        return $this->data_envio;
    }

    public function setDataEnvio($data)
    {
        $this->data_envio = $data;
    }
}