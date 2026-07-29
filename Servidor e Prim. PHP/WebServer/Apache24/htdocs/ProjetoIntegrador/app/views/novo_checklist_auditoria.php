<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/novo_checklist_auditoria.css" />
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
                <li class="passo ativo">
                    <span class="passo-numero">3</span>
                    <span class="passo-nome">Checklist</span>
                </li>
                <li class="passo ativo">
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

            <!-- CRIAÇÃO DA AUDITORIA -->
            <div class="area-selecao">
                <h2>Monte sua auditoria</h2>
                <p class="area-instrucao">Adicione quantos itens forem necessários.</p>

                <ul class="lista-itens-auditoria" id="listaItens">
                    <!-- itens são inseridos aqui via JS -->
                </ul>

                <button type="button" class="btn-add-item" id="btnAddItem">
                    <span aria-hidden="true">+</span> Adicionar item
                </button>
            </div>

            <!-- Template escondido, usado pelo JS pra clonar novos itens -->
            <template id="templateItem">
                <li class="item-auditoria">
                    <div class="item-auditoria__cabecalho">
                        <span class="item-numero"></span>
                        <button type="button" class="item-remover" aria-label="Remover item">✕</button>
                    </div>

                    <div class="item-campo">
                        <label>Pergunta</label>
                        <input type="text" class="item-pergunta" placeholder="Ex: Limpeza das instalações">
                    </div>

                    <div class="item-campo item-campo--linha">
                        <div>
                            <label>Pontuação</label>
                            <select class="item-pontuacao">
                                <option value="">Selecione</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>
                                <option value="na">N/A</option>
                            </select>
                        </div>

                        <div>
                            <label>Foto</label>
                            <label class="item-foto-botao">
                                <input type="file" class="item-foto" accept="image/*" hidden>
                                <span>📷 Anexar</span>
                            </label>
                        </div>
                    </div>

                    <div class="item-foto-preview"></div>

                    <div class="item-campo">
                        <label>Observação</label>
                        <textarea class="item-observacao" rows="2" placeholder="O que estava incorreto? (opcional)"></textarea>
                    </div>
                </li>
            </template>

            <!-- AÇÕES -->
            <div class="rodape-acoes rodape-acoes--duplo">
                <a href="novo_checklist_checklist.php" class="btn-voltar">
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