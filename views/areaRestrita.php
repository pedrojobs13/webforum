<?php
require_once '../utils/seguranca.inc.php';
require_once __DIR__ . '/../dao/MensagemDAO.inc.php';
protegerPagina();

$usuario = getUsuarioLogado();

$totalNaoLidas = $_SESSION['totalNaoLidas'] ?? 0;

$tituloPagina = "WebForum - Área Restrita";
$paginaCSS = "dashboard.css";
require_once 'includes/cabecalho.inc.php';
?>

    <main class="container">

        <section class="dashboard-header">
            <span>Área restrita</span>

            <h1>
                Bem-vindo, <?php echo htmlspecialchars($usuario->nome); ?>!
            </h1>

            <div class="dashboard-contador">
                <h2>Mensagens não lidas</h2>
                <p class="numero-dashboard"><?php echo $totalNaoLidas; ?></p>
            </div>

            <p>
                Nesta área você pode enviar mensagens para usuários cadastrados,
                visualizar suas mensagens recebidas e remover mensagens antigas.
            </p>
        </section>

        <section class="dashboard-cards">

            <a href="../controlers/controlerMensagem.php?opcao=1" class="dashboard-card">
                <h2>✉ Enviar mensagem</h2>

                <p>
                    Escreva uma nova mensagem e escolha um destinatário previamente
                    cadastrado no WebForum.
                </p>
            </a>

            <a href="../controlers/controlerMensagem.php?opcao=3" class="dashboard-card">
                <h2>📥 Mensagens recebidas</h2>

                <p>
                    Acesse sua caixa de entrada, visualize mensagens completas
                    e remova mensagens quando necessário.
                </p>
            </a>
            <a href="../controlers/controlerMensagem.php?opcao=6" class="dashboard-card">
                <h2>📤 Mensagens enviadas</h2>

                <p>
                    Veja as mensagens que você enviou e acompanhe se o destinatário já leu.
                </p>
            </a>
        </section>

        <section class="dashboard-info">
            <h2>Resumo do sistema</h2>

            <div class="dashboard-info-grid">
                <div>
                    <strong>Autenticação</strong>
                    <p>Somente usuários logados podem acessar esta área.</p>
                </div>

                <div>
                    <strong>Destinatários</strong>
                    <p>As mensagens são enviadas apenas para usuários cadastrados.</p>
                </div>

                <div>
                    <strong>Mensagens</strong>
                    <p>Você pode visualizar e remover suas mensagens recebidas.</p>
                </div>
            </div>
        </section>

    </main>

<?php require_once 'includes/rodape.inc.php'; ?>