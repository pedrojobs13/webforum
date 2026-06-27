<?php

require_once '../utils/seguranca.inc.php';
protegerPagina();

$mensagem = $_SESSION['mensagem'] ?? null;

$tituloPagina = "WebForum - Visualizar Mensagem";
$paginaCSS = "mensagens.css";
require_once 'includes/cabecalho.inc.php';

?>

    <main class="container">

        <a href="../controlers/controlerMensagem.php?opcao=3" class="voltar">
            ← Voltar para mensagens
        </a>

        <section class="mensagem-completa">

            <?php if ($mensagem == null) { ?>

                <div class="mensagem-vazia">
                    <div class="icone">⚠️</div>

                    <h2>Mensagem não encontrada</h2>

                    <p>
                        A mensagem pode ter sido removida ou não pertence ao seu usuário.
                    </p>
                </div>

            <?php } else { ?>

                <div class="mensagem-topo">
                    <span>Mensagem recebida</span>

                    <h1>
                        <?php echo htmlspecialchars($mensagem->assunto); ?>
                    </h1>

                    <div class="remetente-box">
                        <p>
                            <strong>Remetente:</strong>
                            <?php echo htmlspecialchars($mensagem->remetente_nome); ?>
                            -
                            <?php echo htmlspecialchars($mensagem->remetente_email); ?>
                        </p>

                        <p>
                            <strong>Data:</strong>
                            <?php echo date('d/m/Y H:i', strtotime($mensagem->data_envio)); ?>
                        </p>
                    </div>
                </div>

                <div class="corpo-mensagem">
                    <?php echo nl2br(htmlspecialchars($mensagem->corpo)); ?>
                </div>

                <div class="mensagem-acoes">
                    <a href="../controlers/controlerMensagem.php?opcao=3" class="btn btn-azul">
                        Voltar
                    </a>

                    <a href="../controlers/controlerMensagem.php?opcao=5&id=<?php echo $mensagem->id_mensagem; ?>"
                       onclick="return confirm('Deseja remover essa mensagem?')"
                       class="btn btn-vermelho">
                        Remover mensagem
                    </a>
                </div>

            <?php } ?>

        </section>

    </main>

<?php require_once 'includes/rodape.inc.php'; ?>