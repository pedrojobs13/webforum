<?php

require_once '../utils/seguranca.inc.php';
require_once '../dao/MensagemDAO.inc.php';

protegerPagina();

$usuario = getUsuarioLogado();

$mensagemDAO = new MensagemDAO();
$totalNaoLidas = $mensagemDAO->contarNaoLidas($usuario->id_usuario);

$_SESSION['totalNaoLidas'] = $totalNaoLidas;

header("Location: ../views/areaRestrita.php");
exit;