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
                <img src="../../public/img/perfil.jpeg" alt="Usuário">
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

                <div class="busca-granja">
                    <input type="text" id="buscaGranja" placeholder="Buscar granja / empresa">
                </div>

                <ul class="lista-granjas">

                    <li class="granja-card">
                        <input type="radio" name="granja" value="granja-sao-joao" hidden>
                        <span class="granja-icone">
                            <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                <image href="../../public/img/avicultura.png" x="0" y="0" width="64" height="64" />
                            </svg>
                        </span>
                        <span class="granja-info">
                            <strong>Granja São João</strong>
                            <small>Dois Vizinhos / PR</small>
                        </span>
                        <span class="granja-seta">›</span>
                    </li>

                    <li class="granja-card">
                        <input type="radio" name="granja" value="fazenda-boa-vista" hidden>
                        <span class="granja-icone">
                            <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                <image href="../../public/img/agricultura.png" x="0" y="0" width="64" height="64" />
                            </svg>
                        </span>
                        <span class="granja-info">
                            <strong>Fazenda Boa Vista</strong>
                            <small>São Jorge d'Oeste / PR</small>
                        </span>
                        <span class="granja-seta">›</span>
                    </li>

                    <li class="granja-card">
                        <input type="radio" name="granja" value="incubatorio-vida" hidden>
                        <span class="granja-icone">
                            <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                <image href="../../public/img/incubatorio.png" x="0" y="0" width="64" height="64" />
                            </svg>
                        </span>
                        <span class="granja-info">
                            <strong>Incubatório Vida</strong>
                            <small>Dois Vizinhos / PR</small>
                        </span>
                        <span class="granja-seta">›</span>
                    </li>

                    <li class="granja-card">
                        <input type="radio" name="granja" value="frigorifico-sul" hidden>
                        <span class="granja-icone">
                            <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                <image href="../../public/img/abatedouro.png" x="0" y="0" width="64" height="64" />
                            </svg>
                        </span>
                        <span class="granja-info">
                            <strong>Frigorífico Sul</strong>
                            <small>Francisco Beltrão / PR</small>
                        </span>
                        <span class="granja-seta">›</span>
                    </li>

                    <li class="granja-card">
                        <input type="radio" name="granja" value="fazenda-uniao" hidden>
                        <span class="granja-icone">
                            <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
                                <image href="../../public/img/agricultura.png" x="0" y="0" width="64" height="64" />
                            </svg>
                        </span>
                        <span class="granja-info">
                            <strong>Fazenda União</strong>
                            <small>Pato Branco / PR</small>
                        </span>
                        <span class="granja-seta">›</span>
                    </li>

                </ul>
            </div>

            <!-- AÇÕES -->
            <div class="rodape-acoes rodape-acoes--duplo">
                <a href="novo_checklist.php" class="btn-voltar">
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