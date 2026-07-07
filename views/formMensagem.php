<?php

require_once '../utils/seguranca.inc.php';
protegerPagina();

$destinatarios = $_SESSION['destinatarios'] ?? [];
$destinatarioPreSelecionado = (int) ($_GET['destinatario'] ?? 0);
$assuntoPreSelecionado = $_GET['assunto'] ?? '';

$tituloPagina = "WebForum - Enviar Mensagem";
$paginaCSS = "mensagens.css";
require_once 'includes/cabecalho.inc.php';

?>

    <main class="container">

        <a href="../controlers/controlerDashboard.php" class="btn btn-outline">
            Voltar para área restrita
        </a>

        <section class="titulo-pagina">
            <span>Nova mensagem</span>

            <h1>Enviar Mensagem</h1>

            <p>
                Escolha um usuário cadastrado como destinatário e escreva sua mensagem.
            </p>
        </section>

        <section class="form-box">

            <?php if (count($destinatarios) == 0) { ?>

                <div class="alerta alerta-aviso">
                    Nenhum destinatário cadastrado disponível.
                </div>

            <?php } ?>

            <?php if (isset($_GET['erro']) && $_GET['erro'] == 1) { ?>
                <div class="alerta alerta-erro">
                    Preencha todos os campos e escolha um destinatário válido.
                </div>
            <?php } ?>

            <?php if (isset($_GET['erro']) && $_GET['erro'] == 2) { ?>
                <div class="alerta alerta-erro">
                    Não foi possível enviar a mensagem. Tente novamente.
                </div>
            <?php } ?>

            <form action="../controlers/controlerMensagem.php" method="post">
                <input type="hidden" name="opcao" value="2">

                <div class="form-group">
                    <label>Destinatário</label>

                    <select name="pDestinatario" class="form-control" required>
                        <option value="">Selecione um destinatário</option>

                        <?php foreach ($destinatarios as $destinatario) { ?>
                            <option
                                    value="<?php echo $destinatario->id_usuario; ?>"
                                    <?php echo $destinatario->id_usuario == $destinatarioPreSelecionado ? 'selected' : ''; ?>
                            >
                                <?php echo htmlspecialchars($destinatario->nome . ' - ' . $destinatario->email); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Assunto</label>

                    <input
                            type="text"
                            name="pAssunto"
                            class="form-control"
                            placeholder="Digite o assunto da mensagem"
                            value="<?php echo htmlspecialchars($assuntoPreSelecionado); ?>"
                            required
                    >
                </div>

                <div class="form-group">
                    <label>Mensagem</label>

                    <textarea
                            name="pCorpo"
                            class="form-control"
                            placeholder="Escreva sua mensagem aqui..."
                            required
                    ></textarea>
                </div>

                <div class="form-actions">
                    <a href="areaRestrita.php" class="btn btn-outline">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-azul">
                        Enviar mensagem
                    </button>
                </div>
            </form>

        </section>

    </main>

<?php require_once 'includes/rodape.inc.php'; ?>