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

    $idDestinatario = (int) ($_GET['destinatario'] ?? 0);
    $assunto = $_GET['assunto'] ?? '';

    $query = '';
    if ($idDestinatario > 0) {
        $query = '?destinatario=' . $idDestinatario . '&assunto=' . urlencode($assunto);
    }

    header("Location: ../views/formMensagem.php" . $query);
    exit;
}

if ($opcao == 2) {
    $idDestinatario = (int) ($_POST['pDestinatario'] ?? 0);
    $assunto = trim($_POST['pAssunto'] ?? '');
    $corpo = trim($_POST['pCorpo'] ?? '');

    if ($idDestinatario <= 0 || $assunto === '' || $corpo === '') {
        header("Location: ../views/formMensagem.php?erro=1");
        exit;
    }

    $usuarioDAO = new UsuarioDAO();
    $destinatarios = $usuarioDAO->listarUsuariosExceto($idUsuarioLogado);

    $destinatarioValido = false;
    foreach ($destinatarios as $destinatario) {
        if ($destinatario->id_usuario == $idDestinatario) {
            $destinatarioValido = true;
            break;
        }
    }

    if (!$destinatarioValido) {
        header("Location: ../views/formMensagem.php?erro=1");
        exit;
    }

    $mensagem = new Mensagem();

    $mensagem->setMensagem(
        $idUsuarioLogado,
        $idDestinatario,
        $assunto,
        $corpo
    );

    $mensagemDAO = new MensagemDAO();

    try {
        $mensagemDAO->enviarMensagem($mensagem);
        header("Location: controlerMensagem.php?opcao=3");
        exit;
    } catch (Exception $e) {
        header("Location: ../views/formMensagem.php?erro=2");
        exit;
    }
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

    if ($mensagem != null) {
        $mensagemDAO->marcarComoLida($idMensagem, $idUsuarioLogado);
    }

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
if ($opcao == 6) {
    $mensagemDAO = new MensagemDAO();
    $mensagens = $mensagemDAO->listarEnviadas($idUsuarioLogado);

    $_SESSION['mensagensEnviadas'] = $mensagens;

    header("Location: ../views/mensagensEnviadas.php");
    exit;
}

if ($opcao == 7) {
    $idMensagem = (int) $_GET['id'];

    $mensagemDAO = new MensagemDAO();
    $mensagem = $mensagemDAO->buscarMensagemEnviada($idMensagem, $idUsuarioLogado);

    $_SESSION['mensagemEnviada'] = $mensagem;

    header("Location: ../views/visualizarMensagemEnviada.php");
    exit;
}