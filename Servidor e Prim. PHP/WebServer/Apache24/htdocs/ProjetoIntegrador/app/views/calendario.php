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
    <link rel="stylesheet" type="text/css" href="../../public/css/calendario.css" />
    <title>Calendário</title>
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
            <li><a href="novo_checklist.php"><img class="icones" src="../../public/img/nova.png"><span>Nova Auditoria</span></a></li>
            <li><a href="pdfs.php"><img class="icones" src="../../public/img/PDF.png"><span>PDFs</span></a></li>
            <li><a href="checklist.php"><img class="icones" src="../../public/img/checklist.png"><span>Checklists</span></a></li>
            <li><a href="cadastros.php"><img class="icones" src="../../public/img/cadastro.png"><span>Novo Cadastro</span></a></li>
            <li class="ativo"><a href="calendario.php"><img class="icones" src="../../public/img/calendario.png"><span>Calendário</span></a></li>
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
            <div class="usuario">
                <img src="<?= "../../".$foto["url"]; ?>" alt="Usuário">
            </div>
        </div>

        <!-- CABEÇALHO -->
        <div class="cabecalho">
            <h1>Calendário</h1>
            <p>Organize visitas técnicas, cobranças de plano de ação e outros compromissos.</p>
        </div>

        <!-- ===== CALENDÁRIO ===== -->
        <section class="card-calendario">

            <!-- NAVEGAÇÃO -->
            <div class="calendario-topo">
                <div class="calendario-navegacao">
                    <button type="button" class="btn-nav" id="mesAnterior" aria-label="Mês anterior">‹</button>
                    <h2 id="mesAtualTitulo"></h2>
                    <button type="button" class="btn-nav" id="mesProximo" aria-label="Próximo mês">›</button>
                </div>

                <button type="button" class="btn-novo-compromisso" id="btnNovoCompromisso">
                    <span aria-hidden="true">+</span> Novo compromisso
                </button>
            </div>

            <!-- LEGENDA -->
            <div class="calendario-legenda">
                <span class="legenda-item"><span class="legenda-bolinha tag-visita"></span> Visita técnica</span>
                <span class="legenda-item"><span class="legenda-bolinha tag-plano"></span> Plano de ação</span>
                <span class="legenda-item"><span class="legenda-bolinha tag-reuniao"></span> Reunião</span>
                <span class="legenda-item"><span class="legenda-bolinha tag-outro"></span> Outro</span>
            </div>

            <!-- CABEÇALHO DOS DIAS DA SEMANA -->
            <div class="calendario-semana">
                <span>Dom</span>
                <span>Seg</span>
                <span>Ter</span>
                <span>Qua</span>
                <span>Qui</span>
                <span>Sex</span>
                <span>Sáb</span>
            </div>

            <!-- GRADE DE DIAS (gerada via JS) -->
            <div class="calendario-grade" id="calendarioGrade"></div>
        </section>

        <!-- ===== COMPROMISSOS DO DIA SELECIONADO ===== -->
        <section class="card-calendario">
            <h3 id="tituloDiaSelecionado">Compromissos do dia</h3>
            <ul class="lista-compromissos" id="listaCompromissosDia">
                <li class="compromissos-vazio" id="compromissosVazio">Nenhum compromisso para este dia.</li>
            </ul>
        </section>

    </main>

    <!-- ===== OVERLAY DO MODAL ===== -->
    <div class="modal-overlay" id="modalOverlay"></div>

    <!-- ===== MODAL: NOVO / EDITAR COMPROMISSO ===== -->
    <section class="modal-compromisso" id="modalCompromisso" aria-hidden="true">
        <div class="modal-compromisso__caixa">
            <button type="button" class="modal-fechar" id="fecharModalCompromisso" aria-label="Fechar">✕</button>

            <h2 id="modalCompromissoTitulo">Novo compromisso</h2>

            <form id="formCompromisso" class="form-cadastro" novalidate>
                <div class="item-campo">
                    <label for="compromissoTitulo">Título</label>
                    <input type="text" id="compromissoTitulo" placeholder="Ex: Visita técnica - Granja São João" required>
                </div>

                <div class="grade-campos">
                    <div class="item-campo">
                        <label for="compromissoTipo">Tipo</label>
                        <select id="compromissoTipo" required>
                            <option value="visita">Visita técnica</option>
                            <option value="plano">Cobrança de plano de ação</option>
                            <option value="reuniao">Reunião</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>

                    <div class="item-campo">
                        <label for="compromissoData">Data</label>
                        <input type="date" id="compromissoData" required>
                    </div>

                    <div class="item-campo">
                        <label for="compromissoHora">Hora</label>
                        <input type="time" id="compromissoHora">
                    </div>
                </div>

                <div class="item-campo">
                    <label for="compromissoDescricao">Descrição</label>
                    <textarea id="compromissoDescricao" rows="3" placeholder="Detalhes do compromisso (opcional)"></textarea>
                </div>

                <div class="rodape-form">
                    <button type="button" class="btn-excluir-compromisso" id="btnExcluirCompromisso" hidden>Excluir</button>
                    <button type="submit" class="btn-salvar">Salvar compromisso</button>
                </div>
            </form>
        </div>
    </section>

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

    <script src="../../public/js/calendario.js"></script>
</body>
</html>