<?php

require_once '../classes/Usuario.inc.php';
require_once '../dao/UsuarioDAO.inc.php';

$opcao = isset($_REQUEST['pOpcao']) ? (int) $_REQUEST['pOpcao'] : 0;

if ($opcao == 1) {
    $usuario = new Usuario();

    $usuario->setUsuario(
        $_POST['pNome'],
        $_POST['pEmail'],
        $_POST['pSenha']
    );

    $usuarioDAO = new UsuarioDAO();

    try {
        $usuarioDAO->cadastrarUsuario($usuario);
        header("Location: ../views/formLogin.php?cadastro=1");
        exit;
    } catch (Exception $e) {
        header("Location: ../views/formCadastroUsuario.php?erro=1");
        exit;
    }
}

if ($opcao == 2) {
    $email = $_POST['pEmail'];
    $senha = $_POST['pSenha'];

    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->autenticar($email, $senha);

    if ($usuario != null) {
        session_start();
        $_SESSION['usuarioLogado'] = $usuario;

        header("Location: ../views/areaRestrita.php");
        exit;
    } else {
        header("Location: ../views/formLogin.php?erro=1");
        exit;
    }
}

if ($opcao == 3) {
    session_start();
    unset($_SESSION['usuarioLogado']);

    header("Location: ../views/index.php");
    exit;
}