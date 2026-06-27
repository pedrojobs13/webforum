<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$usuarioLogado = $_SESSION['usuarioLogado'] ?? null;
$tituloPagina = $tituloPagina ?? 'WebForum';
$paginaCSS = $paginaCSS ?? null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tituloPagina); ?></title>

    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/layout.css">

    <?php if ($paginaCSS != null) { ?>
        <link rel="stylesheet" href="css/<?php echo htmlspecialchars($paginaCSS); ?>">
    <?php } ?>
</head>

<body>

<header class="topo">
    <div class="topo-container">
        <a href="index.php" class="logo">WebForum</a>

        <nav class="menu">
            <a href="index.php">Início</a>

            <?php if ($usuarioLogado == null) {
                ?>
                <a href="formLogin.php">Login</a>
                <a href="formCadastroUsuario.php" class="btn-menu">Criar conta</a>
                <?php
            } else { ?>
                <a href="areaRestrita.php">Área restrita</a>
                <a href="../controlers/controlerMensagem.php?opcao=3">Mensagens</a>
                <a href="../controlers/controlerUsuario.php?pOpcao=3" class="btn-sair">Sair</a>
            <?php } ?>
        </nav>
    </div>
</header>