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
 
// Se não tem área escolhida, o usuário pulou o passo 1 — manda de volta
if (!isset($_SESSION["nova_auditoria"]["area"])) {
    header("Location: novo_checklist.php");
    exit;
}
 
$area = $_SESSION["nova_auditoria"]["area"];
 
$modeloEmpresas = new CadastroEmpresa();
$listaEmpresas = $modeloEmpresas->ListarEmpresasPorArea($area);
 
$modeloGranjas = new CadastroGranja();
$listaGranjas = $modeloGranjas->ListarGranjasPorArea($area);
 
// Junta os dois numa lista só, marcando de onde cada um veio
$locais = [];
foreach ($listaEmpresas as $e) {
    $locais[] = ["tipo" => "empresa", "id" => $e["id"], "nome" => $e["nome"], "endereco" => $e["endereco"]];
}
foreach ($listaGranjas as $g) {
    $locais[] = ["tipo" => "granja", "id" => $g["id"], "nome" => $g["nome"], "endereco" => $g["endereco"]];
}
usort($locais, fn($a, $b) => strcmp($a["nome"], $b["nome"]));
 
$modeloUsuario = new CadastroUsuario();
$usuarios = $modeloUsuario->ListarTodosUsuarios();
$foto = $modeloUsuario->ListarUmUsuario($_SESSION["usuario_id"]);
 
$modeloProdutor = new CadastroProdutor();
$produtores = $modeloProdutor->ListarTodosProdutores();
 
$empresas = $listaEmpresas;
$granjas = $listaGranjas;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/novo_checklist_empresas.css" />
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
            <li><a href="dashboard.php"><img class="icones" src="../../public/img/dash.png"><span>Dashboard</span></a>
            </li>
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

            <!-- SELEÇÃO DE GRANJA/EMPRESA -->
            <div class="area-selecao">
                <h2>Selecione a granja / empresa</h2>
                <p class="area-instrucao">Escolha o local que será auditado.</p>

                <form id="formGranja" method="post" action="../controllers/nova_auditoria_controller.php?etapa=empresa">
                    <div class="busca-granja">
                        <input type="text" id="buscaGranja" placeholder="Buscar granja / empresa">
                    </div>

                    <ul class="lista-granjas">
                        <?php foreach ($locais as $local): ?>
                        <li class="granja-card">
                            <input type="radio" name="granja" value="<?= $local['tipo'] ?>_<?= $local['id'] ?>" hidden>
                            <span class="granja-icone">
                                <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                    <image href="../../public/img/<?= $area ?>.png" x="0" y="0" width="64" height="64" />
                                </svg>
                            </span>
                            <span class="granja-info">
                                <strong><?= htmlspecialchars($local['nome']) ?></strong>
                                <small><?= htmlspecialchars($local['endereco']) ?></small>
                            </span>
                            <span class="granja-seta">›</span>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- AÇÕES -->
                    <div class="rodape-acoes rodape-acoes--duplo">
                        <a href="novo_checklist.php" class="btn-voltar">
                            <span aria-hidden="true">←</span> Voltar
                        </a>
                        <button type="submit" class="btn-proximo" disabled>
                            Próximo <span aria-hidden="true">→</span>
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script src="../../public/js/passo2_auditoria.js"></script>
</body>