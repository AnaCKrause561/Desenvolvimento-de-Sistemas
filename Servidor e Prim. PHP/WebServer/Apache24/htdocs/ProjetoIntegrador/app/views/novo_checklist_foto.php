<?php
session_name("ProjetoIntegrado");
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../../index.html");
    exit;
}

require_once("../models/CadastroUsuario.php");

// Não deixa pular etapas anteriores
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

$itens = $_SESSION["nova_auditoria"]["itens"];

$modeloUsuario = new CadastroUsuario();
$foto = $modeloUsuario->ListarUmUsuario($_SESSION["usuario_id"]);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/novo_checklist_auditoria.css" />
    <title>Fotos da Auditoria</title>
</head>

<body>
    <button class="menu-mobile">☰</button>
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

    <main class="conteudo">

        <div class="busca">
            <div class="notificacao">
                <span><img class="sino" src="../../public/img/sino.png"></span>
            </div>
            <div class="usuario">
                <img src="<?= "../../".$foto["url"]; ?>" alt="Usuário">
            </div>
        </div>

        <section class="etapas">

            <p class="etapa-titulo"> PASSO A PASSO </p>

            <ol class="passos">
                <li class="passo ativo"><span class="passo-numero">1</span><span class="passo-nome">Área</span></li>
                <li class="passo ativo"><span class="passo-numero">2</span><span class="passo-nome">Empresa</span></li>
                <li class="passo ativo"><span class="passo-numero">3</span><span class="passo-nome">Checklist</span></li>
                <li class="passo ativo"><span class="passo-numero">4</span><span class="passo-nome">Auditoria</span></li>
                <li class="passo ativo"><span class="passo-numero">5</span><span class="passo-nome">Fotos</span></li>
                <li class="passo"><span class="passo-numero">6</span><span class="passo-nome">Assinatura</span></li>
                <li class="passo"><span class="passo-numero">7</span><span class="passo-nome">Revisão</span></li>
            </ol>

            <div class="area-selecao">
                <h2>Confira as fotos</h2>
                <p class="area-instrucao">Essas são as fotos anexadas durante o preenchimento da auditoria. Se algo estiver errado, volte e ajuste no passo anterior.</p>

                <div class="item-foto-preview">
                    <?php foreach ($itens as $item): ?>
                        <?php if ($item["foto"]): ?>
                            <img src="../../<?= htmlspecialchars($item["foto"]) ?>" alt="Foto da auditoria">
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <?php if (!array_filter($itens, fn($item) => $item["foto"])): ?>
                    <p style="font-size:14px; color:#6b7263;">Nenhuma foto foi anexada nesta auditoria.</p>
                <?php endif; ?>
            </div>

            <div class="rodape-acoes rodape-acoes--duplo">
                <a href="novo_checklist_auditoria.php" class="btn-voltar">
                    <span aria-hidden="true">←</span> Voltar
                </a>
                <a href="novo_checklist_ass.php" class="btn-proximo" style="text-decoration:none;">
                    Próximo <span aria-hidden="true">→</span>
                </a>
            </div>
        </section>
    </main>

    <script src="../../public/js/menu.js"></script>
</body>
</html>