<?php

require_once '../utils/seguranca.inc.php';
require_once '../dao/UsuarioDAO.inc.php';

protegerAdmin();

$usuarioLogado = getUsuarioLogado();

$opcao = isset($_REQUEST['opcao']) ? (int) $_REQUEST['opcao'] : 0;

if ($opcao == 1) {
    $usuarioDAO = new UsuarioDAO();
    $usuarios = $usuarioDAO->listarTodosExceto($usuarioLogado->id_usuario);

    $_SESSION['usuariosAdmin'] = $usuarios;

    header("Location: ../views/gerenciarUsuarios.php");
    exit;
}

if ($opcao == 2) {
    $idUsuario = (int) ($_POST['pIdUsuario'] ?? 0);
    $motivo = trim($_POST['pMotivo'] ?? '');

    if ($idUsuario > 0 && $idUsuario !== $usuarioLogado->id_usuario) {
        $usuarioDAO = new UsuarioDAO();
        $usuarioDAO->banir($idUsuario, $motivo !== '' ? $motivo : 'Não informado');
    }

    header("Location: controlerAdmin.php?opcao=1");
    exit;
}

if ($opcao == 3) {
    $idUsuario = (int) ($_POST['pIdUsuario'] ?? 0);

    if ($idUsuario > 0) {
        $usuarioDAO = new UsuarioDAO();
        $usuarioDAO->desbanir($idUsuario);
    }

    header("Location: controlerAdmin.php?opcao=1");
    exit;
}
