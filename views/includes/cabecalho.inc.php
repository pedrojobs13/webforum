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
    <script src="js/cabecalho.js" defer></script>
    <?php if ($paginaCSS != null) { ?>
        <link rel="stylesheet" href="css/<?php echo htmlspecialchars($paginaCSS); ?>">
    <?php } ?>
</head>

<body>

<header class="topo">
    <div class="topo-container">

        <a href="<?php echo $usuarioLogado == null ? 'index.php' : '../controlers/controlerDashboard.php'; ?>" class="logo">
            WebForum
        </a>

        <nav class="menu">

            <?php if ($usuarioLogado == null) { ?>

                <a href="index.php">Início</a>
                <a href="formLogin.php">Login</a>
                <a href="formCadastroUsuario.php" class="btn-menu">Criar conta</a>

            <?php } else { ?>

                <a href="../controlers/controlerDashboard.php">Área restrita</a>
                <a href="../controlers/controlerMensagem.php?opcao=3">Recebidas</a>
                <a href="../controlers/controlerMensagem.php?opcao=6">Enviadas</a>
                <a href="../controlers/controlerUsuario.php?pOpcao=3" class="btn-sair">Sair</a>

            <?php } ?>

            <button type="button" onclick="alternarTema()" class="btn-tema" id="btnTema">
                🌙
            </button>

        </nav>
    </div>
</header>