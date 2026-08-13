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
    <link rel="stylesheet" type="text/css" href="../../public/css/dashboard.css" />
    <title>Dashboard</title>
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
            <li class="ativo"><a href="dashboard.php"><img class="icones" src="../../public/img/dash.png"><span>Dashboard</span></a></li>
            <li><a href="novo_checklist.php"><img class="icones" src="../../public/img/nova.png"><span>Novo Checklist</span></a></li>
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

        <!-- CABEÇALHO -->
        <div class="cabecalho">
            <h1>
                Olá!
                <?= htmlspecialchars($usuario["nome"] ?? '') ?>
            </h1>
            <p>Gerencie suas auditorias de forma simples e eficientes.</p>
        </div>

        <div class="conteudo-card">
            <!-- CARDS -->
            <div class="cards">

                <div class="card">
                    <h3>Auditorias</h3>
                    <span>

                    </span>
                    <p>Total de Auditorias</p>
                </div>

                <div class="card">
                    <h3>Checklists</h3>
                    <span>

                    </span>
                    <p>Checklist cadastrados</p>
                </div>

                <div class="card">
                    <h3>PDFs</h3>
                    <span>

                    </span>
                    <p>Auditorias realizadas</p>
                </div>

                <div class="card">
                    <h3>Compromissos</h3>
                    <span>

                    </span>
                    <p>Próximos 7 dias</p>
                </div>
            </div>

            <!-- GRÁFICOS -->
            <div class="graficos">
                <div class="painel">
                    <h3>Auditorias por mês</h3>
                    <div class="grafico-wrap">
                        <canvas id="graficoMes"></canvas>
                    </div>
                </div>

                <div class="painel">
                    <h3>Status</h3>
                    <div class="grafico-wrap" style="height:170px">
                        <canvas id="graficoStatus"></canvas>
                    </div>

                    <ul class="legenda-status">
                        <li><span class="ponto" style="background:#2f7334"></span>Concluída</li>
                        <li><span class="ponto" style="background:#8f9f39"></span>Pendente</li>
                        <li><span class="ponto" style="background:#bccc5f"></span>Em andamento</li>
                    </ul>
                </div>
            </div>

            <!-- ÚLTIMAS AUDITORIAS -->
            <div class="tabela-painel">
                <h3>Últimas auditorias</h3>

                <table class="auditorias">
                    <thead>
                        <tr>
                            <th>Fazenda</th>
                            <th>Status</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </main>


    <script>
        const botao = document.querySelector(".menu-mobile");
        const sidebar = document.querySelector(".sidebar");
        const overlay = document.querySelector(".overlay");

        botao.addEventListener("click", () => {
            sidebar.classList.toggle("abrir");
            overlay.classList.toggle("ativo");
            document.body.classList.toggle("sem-scroll");
        });

        overlay.addEventListener("click", () => {
            sidebar.classList.remove("abrir");
            overlay.classList.remove("ativo");
            document.body.classList.remove("sem-scroll");
        });
    </script>



</body>