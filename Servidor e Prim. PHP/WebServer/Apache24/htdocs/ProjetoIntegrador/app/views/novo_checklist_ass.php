<?php
session_name("ProjetoIntegrado");
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../../index.html");
    exit;
}

require_once("../models/CadastroUsuario.php");

if (!isset($_SESSION["nova_auditoria"]["area"])) {
    header("Location: novo_checklist.php");
    exit;
}
if (!isset($_SESSION["nova_auditoria"]["local_id"])) {
    header("Location: novo_checklist_empresas.php");
    exit;
}
if (!array_key_exists("checklist_id", $_SESSION["nova_auditoria"])) {
    header("Location: novo_checklist_check.php");
    exit;
}
if (!isset($_SESSION["nova_auditoria"]["itens"])) {
    header("Location: novo_checklist_auditoria.php");
    exit;
}

$modeloUsuario = new CadastroUsuario();
$foto = $modeloUsuario->ListarUmUsuario($_SESSION["usuario_id"]);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/novo_checklist_ass.css" />
    <title>Novo Checklist</title>
</head>

<body>
    <!-- MENU -->
    <button class="menu-mobile">☰</button>
    <!-- Overlay -->
    <div class="overlay"></div>

    <div class="sidebar">
        <br>
        <h2><img class="logo" src="../../public/img/Logo.png"> Farms Check</h2>

        <ul>
            <li><a href="dashboard.php"><img class="icones" src="../../public/img/dash.png"><span>Dashboard</span></a></li>
            <li class="ativo"><a href="novo_checklist.php"><img class="icones" src="../../public/img/nova.png"><span>Novo Auditoria</span></a></li>
            <li><a href="pdfs.php"><img class="icones" src="../../public/img/PDF.png"><span>PDFs</span></a></li>
            <li><a href="checklist.php"><img class="icones" src="../../public/img/checklist.png"><span>Checklists</span></a></li>
            <li><a href="cadastros.php"><img class="icones" src="../../public/img/cadastro.png"><span>Novo Cadastro</span></a></li>
            <li><a href="calendario.php"><img class="icones" src="../../public/img/calendario.png"><span>Calendário</span></a></li>
            <li><a href="perfil.php"><img class="icones" src="../../public/img/perfil.png"><span>Perfil</span></a></li>
            <li><a href="../controllers/logoff.php"><img class="icones" src="../../public/img/sair.png"><span>Sair</span></a></li>
        </ul>
    </div>

    <!-- CONTEÚDO -->
    <main class="conteudo">

        <!-- TOPO -->
        <div class="busca">

            <div class="notificacao">
                <span><img class="sino" src="../../public/img/sino.png"></span>
            </div>

            <!-- FOTO VINDO DO BANCO -->
            <div class="usuario">
                <img src="<?= "../../".$foto["url"]; ?>" alt="Usuário">
            </div>

        </div>

        <!-- ETAPA -->
        <section class="etapas">

            <p class="etapa-titulo"> PASSO A PASSO </p>

            <!-- INDICADOR DE PASSOS -->
            <ol class="passos">
                <li class="passo ativo">
                    <span class="passo-numero">1</span>
                    <span class="passo-nome">Área</span>
                </li>
                <li class="passo ativo">
                    <span class="passo-numero">2</span>
                    <span class="passo-nome">Empresa</span>
                </li>
                <li class="passo ativo">
                    <span class="passo-numero">3</span>
                    <span class="passo-nome">Checklist</span>
                </li>
                <li class="passo ativo">
                    <span class="passo-numero">4</span>
                    <span class="passo-nome">Auditoria</span>
                </li>
                <li class="passo ativo">
                    <span class="passo-numero">5</span>
                    <span class="passo-nome">Fotos</span>
                </li>
                <li class="passo ativo">
                    <span class="passo-numero">6</span>
                    <span class="passo-nome">Assinatura</span>
                </li>
                <li class="passo">
                    <span class="passo-numero">7</span>
                    <span class="passo-nome">Revisão</span>
                </li>
            </ol>

            <form action="../controllers/nova_auditoria_controller.php?etapa=assinatura" method="POST" id="formAssinatura">

                <div class="area-selecao">
                    <h2>Assinatura digital</h2>
                    <p class="area-instrucao">Assine abaixo para finalizar a auditoria.</p>

                    <div class="assinaturas-grid">

                        <!-- ASSINATURA DO AUDITOR -->
                        <div class="assinatura-card">
                            <p class="assinatura-rotulo">Assinatura do auditor</p>

                            <div class="assinatura-canvas-wrap">
                                <canvas id="canvasAuditor" class="assinatura-canvas"></canvas>
                                <span class="assinatura-linha-base"></span>
                            </div>

                            <button type="button" class="btn-limpar-assinatura" data-target="canvasAuditor">
                                Limpar assinatura
                            </button>

                            <div class="assinatura-campo">
                                <label for="nomeAuditor">Nome</label>
                                <input type="text" id="nomeAuditor" name="nome_auditor" placeholder="Nome do auditor">
                            </div>

                            <!-- NOVO: guarda o desenho do canvas como imagem antes de enviar -->
                            <input type="hidden" name="assinatura_auditor" id="inputAssinaturaAuditor">
                        </div>

                        <!-- ASSINATURA DO RESPONSÁVEL -->
                        <div class="assinatura-card">
                            <p class="assinatura-rotulo">Assinatura do responsável</p>

                            <div class="assinatura-canvas-wrap">
                                <canvas id="canvasResponsavel" class="assinatura-canvas"></canvas>
                                <span class="assinatura-linha-base"></span>
                            </div>

                            <button type="button" class="btn-limpar-assinatura" data-target="canvasResponsavel">
                                Limpar assinatura
                            </button>

                            <div class="assinatura-campo">
                                <label for="nomeResponsavel">Nome</label>
                                <input type="text" id="nomeResponsavel" name="nome_responsavel" placeholder="Nome do responsável">
                            </div>

                            <!-- NOVO: guarda o desenho do canvas como imagem antes de enviar -->
                            <input type="hidden" name="assinatura_responsavel" id="inputAssinaturaResponsavel">
                        </div>

                    </div>
                </div>

                <!-- AÇÕES -->
                <div class="rodape-acoes rodape-acoes--duplo">
                    <a href="novo_checklist_foto.php" class="btn-voltar">
                        <span aria-hidden="true">←</span> Voltar
                    </a>
                    <button type="submit" class="btn-proximo" disabled>
                        Próximo <span aria-hidden="true">→</span>
                    </button>
                </div>

            </form>
        </section>
    </main>

    <script src="../../public/js/passo6_auditoria.js"></script>
</body>
</html>