<?php

function iniciarSessao()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function protegerPagina()
{
    iniciarSessao();

    if (!isset($_SESSION['usuarioLogado'])) {
        header("Location: ../views/formLogin.php?erro=2");
        exit;
    }

    require_once __DIR__ . '/../dao/UsuarioDAO.inc.php';

    $usuarioDAO = new UsuarioDAO();

    if ($usuarioDAO->estaBanido($_SESSION['usuarioLogado']->id_usuario)) {
        session_destroy();
        header("Location: ../views/formLogin.php?erro=3");
        exit;
    }
}

function protegerAdmin()
{
    protegerPagina();

    $usuario = getUsuarioLogado();

    if (($usuario->role ?? '') !== 'admin') {
        header("Location: ../views/areaRestrita.php");
        exit;
    }
}

function getUsuarioLogado()
{
    iniciarSessao();
    return $_SESSION['usuarioLogado'] ?? null;
}