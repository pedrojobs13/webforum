<?php

require_once '../utils/seguranca.inc.php';
require_once '../classes/Mensagem.inc.php';
require_once '../dao/MensagemDAO.inc.php';
require_once '../dao/UsuarioDAO.inc.php';

protegerPagina();

$usuarioLogado = getUsuarioLogado();
$idUsuarioLogado = $usuarioLogado->id_usuario;

$opcao = isset($_REQUEST['opcao']) ? (int) $_REQUEST['opcao'] : 0;

if ($opcao == 1) {
    $usuarioDAO = new UsuarioDAO();
    $destinatarios = $usuarioDAO->listarUsuariosExceto($idUsuarioLogado);

    $_SESSION['destinatarios'] = $destinatarios;

    header("Location: ../views/formMensagem.php");
    exit;
}

if ($opcao == 2) {
    $mensagem = new Mensagem();

    $mensagem->setMensagem(
        $idUsuarioLogado,
        $_POST['pDestinatario'],
        $_POST['pAssunto'],
        $_POST['pCorpo']
    );

    $mensagemDAO = new MensagemDAO();
    $mensagemDAO->enviarMensagem($mensagem);

    header("Location: controlerMensagem.php?opcao=3");
    exit;
}

if ($opcao == 3) {
    $mensagemDAO = new MensagemDAO();
    $mensagens = $mensagemDAO->listarRecebidas($idUsuarioLogado);

    $_SESSION['mensagens'] = $mensagens;

    header("Location: ../views/mensagensRecebidas.php");
    exit;
}

if ($opcao == 4) {
    $idMensagem = (int) $_GET['id'];

    $mensagemDAO = new MensagemDAO();
    $mensagem = $mensagemDAO->buscarMensagemRecebida($idMensagem, $idUsuarioLogado);

    $_SESSION['mensagem'] = $mensagem;

    header("Location: ../views/visualizarMensagem.php");
    exit;
}

if ($opcao == 5) {
    $idMensagem = (int) $_GET['id'];

    $mensagemDAO = new MensagemDAO();
    $mensagemDAO->removerMensagem($idMensagem, $idUsuarioLogado);

    header("Location: controlerMensagem.php?opcao=3");
    exit;
}