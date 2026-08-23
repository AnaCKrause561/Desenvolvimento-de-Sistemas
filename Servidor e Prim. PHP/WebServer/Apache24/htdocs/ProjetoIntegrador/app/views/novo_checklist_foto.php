<?php
session_name("ProjetoIntegrado");
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../../index.html");
    exit;
}

require_once("../models/CadastroUsuario.php"); 
require_once("../models/CadastroProdutor.php"); 
require_once("../models/CadastroEmpresa.php"); 
require_once("../models/CadastroGranja.php"); 

$modeloUsuario = new CadastroUsuario();
$usuarios = $modeloUsuario->ListarTodosUsuarios();
$foto = $modeloUsuario->ListarUmUsuario($_SESSION["usuario_id"]);

$modeloProdutor = new CadastroProdutor();
$produtores = $modeloProdutor->ListarTodosProdutores();

$modeloEmpresas = new CadastroEmpresa();
$empresas = $modeloEmpresas->ListarTodasEmpresas();

$modeloGranjas = new CadastroGranja();
$granjas = $modeloGranjas->ListarTodasGranjas();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/novo_checklist_foto.css" />
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
            <li class="ativo"><a href="novo_checklist.php"><img class="icones" src="../../public/img/nova.png"><span>Novo Checklist</span></a></li>
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
                <li class="passo">
                    <span class="passo-numero">6</span>
                    <span class="passo-nome">Assinatura</span>
                </li>
                <li class="passo">
                    <span class="passo-numero">7</span>
                    <span class="passo-nome">Revisão</span>
                </li>
            </ol>

            <div class="area-selecao">
                <h2>Fotos anexadas</h2>
                <p class="area-instrucao">Confira as fotos adicionadas durante a auditoria.</p>

                <ul class="galeria-fotos">
                    <li class="foto-card">
                        <img src="../../public/img/FarmsCheck.png" alt="Foto do item 1">
                        <span class="foto-legenda">Limpeza das instalações</span>
                    </li>
                    <li class="foto-card">
                        <img src="../../public/img/FarmsCheck.png" alt="Foto do item 2">
                        <span class="foto-legenda">Ventilação</span>
                    </li>
                    <li class="foto-card">
                        <img src="../../public/img/FarmsCheck.png" alt="Foto do item 3">
                        <span class="foto-legenda">Reservatório de água</span>
                    </li>
                    <li class="foto-card">
                        <img src="../../public/img/FarmsCheck.png" alt="Foto do item 4">
                        <span class="foto-legenda">Estrutura externa</span>
                    </li>
                    <li class="foto-card">
                        <img src="../../public/img/FarmsCheck.png" alt="Foto do item 5">
                        <span class="foto-legenda">Estrutura externa</span>
                    </li>
                    <li class="foto-card">
                        <img src="../../public/img/FarmsCheck.png" alt="Foto do item 6">
                        <span class="foto-legenda">Comedouros</span>
                    </li>
                </ul>
            </div>

            <!-- AÇÕES -->
            <div class="rodape-acoes rodape-acoes--duplo">
                <a href="novo_checklist_auditoria.php" class="btn-voltar">
                    <span aria-hidden="true">←</span> Voltar
                </a>
                <button type="button" class="btn-proximo" disabled>
                    Próximo <span aria-hidden="true">→</span>
                </button>
            </div>
        </section>
    </main>

    <script src="../../public/js/novo_checklist.js"></script>
</body>