<?php

require_once '../classes/Usuario.inc.php';
require_once '../dao/UsuarioDAO.inc.php';

$opcao = isset($_REQUEST['pOpcao']) ? (int) $_REQUEST['pOpcao'] : 0;

if ($opcao == 1) {
    if ($_POST['pSenha'] !== $_POST['pConfirmaSenha']) {
        header("Location: ../views/formCadastroUsuario.php?erro=2");
        exit;
    }

    $usuario = new Usuario();

    $usuario->setUsuario(
        $_POST['pNome'],
        $_POST['pEmail'],
        $_POST['pSenha']
    );

    $usuarioDAO = new UsuarioDAO();

    try {
        $usuarioDAO->cadastrarUsuario($usuario);
        header("Location: ../views/formLogin.php?cadastro=1&email=" . urlencode($_POST['pEmail']));
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

        unset($usuario->senha);
        $_SESSION['usuarioLogado'] = $usuario;

        header("Location: ../controlers/controlerDashboard.php");
        exit;
    } else {
        header("Location: ../views/formLogin.php?erro=1");
        exit;
    }
}

if ($opcao == 3) {
    session_start();
    session_destroy();

    header("Location: ../views/index.php");
    exit;
}