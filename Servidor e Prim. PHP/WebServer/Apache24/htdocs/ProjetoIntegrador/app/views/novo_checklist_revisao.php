<?php
session_name("ProjetoIntegrado");
session_start();

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
    <link rel="stylesheet" type="text/css" href="../../public/css/novo_checklist_revisao.css" />
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
            <li><a href="logoff.php"><img class="icones" src="../../public/img/sair.png"><span>Sair</span></a></li>
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
                <li class="passo ativo">
                    <span class="passo-numero">7</span>
                    <span class="passo-nome">Revisão</span>
                </li>
            </ol>

            <div class="area-selecao">
                <h2>Revisão da auditoria</h2>
                <p class="area-instrucao">Confira os dados antes de salvar o PDF.</p>

                <div class="revisao-grid">

                    <!-- ÁREA VINDA DO BANCO -->
                    <div class="revisao-item">
                        <span class="revisao-icone">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"></circle><path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path></svg>
                        </span>
                        <span class="revisao-texto">
                            <span class="revisao-label">Área</span>
                            <span class="revisao-valor">Avicultura</span>
                        </span>
                    </div>

                    <!-- DATA VINDA DO BANCO -->
                    <div class="revisao-item">
                        <span class="revisao-icone">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="10" width="6" height="10"></rect><rect x="14" y="4" width="6" height="16"></rect></svg>
                        </span>
                        <span class="revisao-texto">
                            <span class="revisao-label">Data</span>
                            <span class="revisao-valor">12/06/2025</span>
                        </span>
                    </div>

                    <!-- GRANJA/EMPRESA VINDA DO BANCO -->
                    <div class="revisao-item">
                        <span class="revisao-icone">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21V7l9-4 9 4v14"></path><path d="M9 21v-6h6v6"></path></svg>
                        </span>
                        <span class="revisao-texto">
                            <span class="revisao-label">Granja / Empresa</span>
                            <span class="revisao-valor">Granja São João</span>
                        </span>
                    </div>

                    <!-- AUDITOR VINDO DO BANCO -->
                    <div class="revisao-item">
                        <span class="revisao-icone">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"></circle><path d="M4 21c0-4 3.5-7 8-7s8 3 8 7"></path></svg>
                        </span>
                        <span class="revisao-texto">
                            <span class="revisao-label">Auditor</span>
                            <span class="revisao-valor">Ana Silva</span>
                        </span>
                    </div>

                    <!-- CHECKLIST VINDO DO BANCO -->
                    <div class="revisao-item">
                        <span class="revisao-icone">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 3h6l1 3H8l1-3Z"></path><rect x="5" y="6" width="14" height="15" rx="2"></rect></svg>
                        </span>
                        <span class="revisao-texto">
                            <span class="revisao-label">Checklist</span>
                            <span class="revisao-valor">Auditoria - Avicultura</span>
                        </span>
                    </div>

                    <!-- TOTAL DE ITENS VINDO DO BANCO -->
                    <div class="revisao-item">
                        <span class="revisao-icone">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="20" y2="6"></line><line x1="8" y1="12" x2="20" y2="12"></line><line x1="8" y1="18" x2="20" y2="18"></line><line x1="4" y1="6" x2="4.01" y2="6"></line><line x1="4" y1="12" x2="4.01" y2="12"></line><line x1="4" y1="18" x2="4.01" y2="18"></line></svg>
                        </span>
                        <span class="revisao-texto">
                            <span class="revisao-label">Total de itens</span>
                            <span class="revisao-valor">15 itens</span>
                        </span>
                    </div>

                </div>
            </div>

            <!-- AÇÕES -->
            <div class="rodape-acoes rodape-acoes--duplo">
                <a href="novo_checklist_ass.php" class="btn-voltar">
                    <span aria-hidden="true">←</span> Voltar
                </a>
                <button type="button" class="btn-salvar">
                    Salvar e gerar PDF <span aria-hidden="true"></span>
                </button>
            </div>
        </section>
    </main>

    <script src="../../public/js/novo_checklist.js"></script>
</body>
</html>