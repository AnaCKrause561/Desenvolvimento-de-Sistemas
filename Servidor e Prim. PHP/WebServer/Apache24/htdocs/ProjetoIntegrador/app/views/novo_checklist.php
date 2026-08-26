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
    <link rel="stylesheet" type="text/css" href="../../public/css/novo_checklist.css" />
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
                <li class="passo">
                    <span class="passo-numero">2</span>
                    <span class="passo-nome">Empresa</span>
                </li>
                <li class="passo">
                    <span class="passo-numero">3</span>
                    <span class="passo-nome">Checklist</span>
                </li>
                <li class="passo">
                    <span class="passo-numero">4</span>
                    <span class="passo-nome">Auditoria</span>
                </li>
                <li class="passo">
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

            <!-- SELEÇÃO DE ÁREA -->
            <div class="area-selecao">
                <h2>Selecione a área da auditoria</h2>
                <p class="area-instrucao">Escolha a área que deseja auditar.</p>

                <form id="formArea" method="post" action="../controllers/nova_auditoria_controller.php?etapa=area">
                
                    <div class="areas-lista">

                        <label class="area-card">
                            <input type="radio" name="area" value="avicultura">
                            <span class="area-selo">✓</span>
                            <span class="area-icone">
                                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                    <image href="../../public/img/avicultura.png" x="0" y="0" width="64" height="64" />
                                </svg>
                            </span>
                            <span class="area-nome">Avicultura</span>
                        </label>

                        <label class="area-card">
                            <input type="radio" name="area" value="agronomia">
                            <span class="area-selo">✓</span>
                            <span class="area-icone">
                                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                    <image href="../../public/img/agricultura.png" x="0" y="0" width="64" height="64" />
                                </svg>
                            </span>
                            <span class="area-nome">Agronomia</span>
                        </label>

                        <label class="area-card">
                            <input type="radio" name="area" value="incubatorio">
                            <span class="area-selo">✓</span>
                            <span class="area-icone">
                                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                    <image href="../../public/img/incubatorio.png" x="0" y="0" width="64" height="64" />
                                </svg>
                            </span>
                            <span class="area-nome">Incubatório</span>
                        </label>

                        <label class="area-card">
                            <input type="radio" name="area" value="abatedouro">
                            <span class="area-selo">✓</span>
                            <span class="area-icone">
                                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                    <image href="../../public/img/abatedouro.png" x="0" y="0" width="64" height="64" />
                                </svg>
                            </span>
                            <span class="area-nome">Abatedouro</span>
                        </label>

                    </div>
            </div>

            <!-- AÇÕES -->
            <div class="rodape-acoes">
                <button type="submit" class="btn-proximo" disabled>
                    Próximo <span aria-hidden="true">→</span>
                </button>
            </div>
            </form>

        </section>
    </main>

    <script src="../../public/js/passo1_auditoria.js"></script>
</body>