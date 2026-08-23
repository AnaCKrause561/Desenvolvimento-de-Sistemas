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
    <link rel="stylesheet" type="text/css" href="../../public/css/pdfs.css" />
    <title>PDFs | Farms Check</title>
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
            <li class="ativo"><a href="pdfs.php"><img class="icones" src="../../public/img/PDF.png"><span>PDFs</span></a></li>
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
            <div class="usuario">
                <img src="<?= "../../".$foto["url"]; ?>" alt="Usuário">
            </div>
        </div>

        <!-- CABEÇALHO -->
        <div class="cabecalho">
            <h1>PDFs das auditorias</h1>
            <p>Visualize, baixe ou crie um plano de ação a partir das auditorias.</p>
        </div>

        <!-- FILTROS -->
        <div class="painel filtro-painel">
            <form class="filtro-form">
                <!-- BUSCA -->
                <div class="campo-busca">
                    <img class="icone-input" src="../../public/img/pesquisa.png" alt="Pesquisa">
                    <input type="text" id="filtro-busca" placeholder="Buscar por granja ou empresa">
                </div>

                <!-- ÁREA -->
                <select id="filtro-area">
                    <option value="">Área</option>
                    <option>Avicultura</option>
                    <option>Agronomia</option>
                    <option>Incubatório</option>
                    <option>Abatedouro</option>
                </select>

                <!-- STATUS -->
                <select id="filtro-status">
                    <option value="">Status</option>
                    <option>Concluída</option>
                    <option>Pendente</option>
                    <option>Em andamento</option>
                    <option>Atrasada</option>
                </select>

                <!-- LIMPAR -->
                <button type="button" class="btn-filtrar" id="btn-limpar-filtro">Limpar filtros</button>
            </form>
        </div>

        <!-- TABELA DE AUDITORIAS / PDFs -->
        <div class="tabela-painel">
            <h3>Auditorias realizadas</h3>

            <div class="tabela-scroll">
                <table class="auditorias" id="tabela-auditorias">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Granja / Empresa</th>
                            <th>Área</th>
                            <th>Auditoria</th>
                            <th>Data</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody id="tabela-auditorias-corpo">
                        <tr>
                            <td data-label="ID">#1</td>
                            <td data-label="Granja / Empresa">Granja São João</td>
                            <td data-label="Área">Avicultura</td>
                            <td data-label="Checklist">Biosegurança</td>
                            <td data-label="Data">12/06/2025</td>
                            <td data-label="Status"><span class="status-pill status-concluida">Concluída</span></td>

                            <!-- AÇÕES -->
                            <td class="acoes" data-label="Ações">
                                <a class="btn-icone" title="Visualizar" href="#"><img src="../../public/img/olho.png" alt="Ver"></a>
                                <a class="btn-icone" title="Baixar" href="#"><img src="../../public/img/download.png" alt="Baixar"></a>
                                <a class="btn-icone" title="Plano de ação" href="#"><img src="../../public/img/plano.png" alt="Plano de ação"></a>
                            </td>
                        </tr>

                        <tr>
                            <td data-label="ID">#2</td>
                            <td data-label="Granja / Empresa">Fazenda Boa Vista</td>
                            <td data-label="Área">Agronomia</td>
                            <td data-label="Checklist">Manejo</td>
                            <td data-label="Data">11/06/2025</td>
                            <td data-label="Status"><span class="status-pill status-concluida">Concluída</span></td>

                            <!-- AÇÕES -->
                            <td class="acoes" data-label="Ações">
                                <a class="btn-icone" title="Visualizar" href="#"><img src="../../public/img/olho.png" alt="Ver"></a>
                                <a class="btn-icone" title="Baixar" href="#"><img src="../../public/img/download.png" alt="Baixar"></a>
                                <a class="btn-icone" title="Plano de ação" href="#"><img src="../../public/img/plano.png" alt="Plano de ação"></a>
                            </td>
                        </tr>

                        <tr>
                            <td data-label="ID">#3</td>
                            <td data-label="Granja / Empresa">Incubatório Vida</td>
                            <td data-label="Área">Incubatório</td>
                            <td data-label="Checklist">Qualidade da Água</td>
                            <td data-label="Data">10/06/2025</td>
                            <td data-label="Status"><span class="status-pill status-andamento">Em andamento</span></td>

                            <!-- AÇÕES -->
                            <td class="acoes" data-label="Ações">
                                <a class="btn-icone" title="Visualizar" href="#"><img src="../../public/img/olho.png" alt="Ver"></a>
                                <a class="btn-icone" title="Baixar" href="#"><img src="../../public/img/download.png" alt="Baixar"></a>
                                <a class="btn-icone" title="Plano de ação" href="#"><img src="../../public/img/plano.png" alt="Plano de ação"></a>
                            </td>
                        </tr>

                        <tr>
                            <td data-label="ID">#4</td>
                            <td data-label="Granja / Empresa">Frigorífico Sul</td>
                            <td data-label="Área">Abatedouro</td>
                            <td data-label="Checklist">Biosegurança</td>
                            <td data-label="Data">08/06/2025</td>
                            <td data-label="Status"><span class="status-pill status-concluida">Concluída</span></td>

                            <!-- AÇÕES -->
                            <td class="acoes" data-label="Ações">
                                <a class="btn-icone" title="Visualizar" href="#"><img src="../../public/img/olho.png" alt="Ver"></a>
                                <a class="btn-icone" title="Baixar" href="#"><img src="../../public/img/download.png" alt="Baixar"></a>
                                <a class="btn-icone" title="Plano de ação" href="#"><img src="../../public/img/plano.png" alt="Plano de ação"></a>
                            </td>
                        </tr>

                        <tr>
                            <td data-label="ID">#5</td>
                            <td data-label="Granja / Empresa">Fazenda União</td>
                            <td data-label="Área">Pecuária</td>
                            <td data-label="Checklist">Manejo</td>
                            <td data-label="Data">07/06/2025</td>
                            <td data-label="Status"><span class="status-pill status-pendente">Pendente</span></td>

                            <!-- AÇÕES -->
                            <td class="acoes" data-label="Ações">
                                <a class="btn-icone" title="Visualizar" href="#"><img src="../../public/img/olho.png" alt="Ver"></a>
                                <a class="btn-icone" title="Baixar" href="#"><img src="../../public/img/download.png" alt="Baixar"></a>
                                <a class="btn-icone" title="Plano de ação" href="#"><img src="../../public/img/plano.png" alt="Plano de ação"></a>
                            </td>
                        </tr>

                        <!-- SEM RESULTADO -->
                        <tr id="linha-sem-resultado" style="display:none;">
                            <td colspan="7" class="tabela-vazia">Nenhuma auditoria encontrada.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- CERTIFICADOS -->
        <div class="tabela-painel certificados-painel">
            <h3>Certificados sanitários</h3>
            <p class="subtitulo">Envie certificados de vacina ou outros documentos exigidos por granja, empresa ou produtor.</p>

            <!-- ADICIONAR -->
            <form class="form-certificado">
                <select>
                    <option value="">Selecione a granja/empresa</option>
                    <option>Granja São João</option>
                    <option>Fazenda Boa Vista</option>
                    <option>Incubatório Vida</option>
                    <option>Frigorífico Sul</option>
                    <option>Fazenda União</option>
                </select>

                <select>
                    <option value="">Produtor (opcional)</option>
                    <option>José da Silva</option>
                    <option>Maria Oliveira</option>
                </select>

                <select>
                    <option value="">Tipo de certificado</option>
                    <option>Certificado de vacina</option>
                    <option>Certificado sanitário</option>
                    <option>Outro</option>
                </select>

                <!-- SELEC ARQUIVO -->
                <label class="input-arquivo">
                    <img src="../../public/img/upload.png" alt="">
                    <span>Selecionar arquivo (PDF ou imagem)</span>
                    <input type="file" accept=".pdf,.jpg,.jpeg,.png">
                </label>

                <!-- ENVIAR ARQUIVO -->
                <button type="button" class="btn-enviar">Enviar certificado</button>
            </form>

            <div class="tabela-scroll">
                <table class="auditorias">
                    <thead>
                        <tr>
                            <th>Granja / Empresa</th>
                            <th>Produtor</th>
                            <th>Tipo</th>
                            <th>Enviado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td data-label="Granja / Empresa">Granja São João</td>
                            <td data-label="Produtor">José da Silva</td>
                            <td data-label="Tipo">Certificado de vacina</td>
                            <td data-label="Enviado em">15/06/2025</td>

                            <!-- AÇÕES -->
                            <td class="acoes" data-label="Ações">
                                <a class="btn-icone" title="Baixar" href="#"><img src="../../public/img/download.png" alt="Baixar"></a>
                                <a class="btn-icone" title="Excluir" href="#"><img src="../../public/img/lixeira.png" alt="Excluir"></a>
                            </td>
                        </tr>

                        <tr>
                            <td data-label="Granja / Empresa">Fazenda Boa Vista</td>
                            <td data-label="Produtor">—</td>
                            <td data-label="Tipo">Certificado sanitário</td>
                            <td data-label="Enviado em">10/06/2025</td>

                            <!-- AÇÕES -->
                            <td class="acoes" data-label="Ações">
                                <a class="btn-icone" title="Baixar" href="#"><img src="../../public/img/download.png" alt="Baixar"></a>
                                <a class="btn-icone" title="Excluir" href="#"><img src="../../public/img/lixeira.png" alt="Excluir"></a>
                            </td>
                        </tr>
                    </tbody>
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

    <script src="../../public/js/pdfs.js"></script>

</body>

</html>