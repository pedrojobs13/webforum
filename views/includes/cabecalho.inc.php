<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$usuarioLogado = $_SESSION['usuarioLogado'] ?? null;
$tituloPagina = $tituloPagina ?? 'WebForum';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tituloPagina); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="<?php echo $usuarioLogado == null ? 'index.php' : '../controlers/controlerDashboard.php'; ?>">
            WebForum
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav ms-auto">

                <?php if ($usuarioLogado == null) { ?>

                    <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="formLogin.php">Login</a></li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-md-2" href="formCadastroUsuario.php">Criar conta</a>
                    </li>

                <?php } else { ?>

                    <li class="nav-item"><a class="nav-link" href="../controlers/controlerDashboard.php">Área restrita</a></li>
                    <li class="nav-item"><a class="nav-link" href="../controlers/controlerMensagem.php?opcao=3">Recebidas</a></li>
                    <li class="nav-item"><a class="nav-link" href="../controlers/controlerMensagem.php?opcao=6">Enviadas</a></li>

                    <?php if (($usuarioLogado->role ?? '') === 'admin') { ?>
                        <li class="nav-item"><a class="nav-link" href="../controlers/controlerAdmin.php?opcao=1">Administração</a></li>
                    <?php } ?>

                    <li class="nav-item">
                        <a class="btn btn-outline-light ms-md-2" href="../controlers/controlerUsuario.php?pOpcao=3">Sair</a>
                    </li>

                <?php } ?>

            </ul>
        </div>
    </div>
</nav>
