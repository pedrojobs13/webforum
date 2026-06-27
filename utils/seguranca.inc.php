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
}

function getUsuarioLogado()
{
    iniciarSessao();
    return $_SESSION['usuarioLogado'] ?? null;
}