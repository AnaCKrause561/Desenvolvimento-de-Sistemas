<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/checklist.css" />
    <title>Checklists</title>
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
            <li class="ativo"><a href="checklist.php"><img class="icones" src="../../public/img/checklist.png"><span>Checklists</span></a></li>
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
            <div class="usuario">
                <img src="../../public/img/perfil.jpeg" alt="Usuário">
            </div>
        </div>

        <!-- CABEÇALHO -->
        <div class="cabecalho">
            <h1>Checklists</h1>
            <p>Cadastre as perguntas que serão usadas nas suas auditorias.</p>
        </div>

        <!-- CRIAÇÃO DO CHECKLIST -->
        <section class="area-selecao">
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

                    <!-- LIMPAR -->
                    <button type="button" class="btn-filtrar" id="btn-limpar-filtro">Limpar filtros</button>
                </form>
            </div>

            <!-- TABELA DE CHECKLIST / PDFs -->
            <div class="tabela-painel">
                <h3>Checklist cadastrados</h3>

                <div class="tabela-scroll">
                    <table class="auditorias" id="tabela-auditorias">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Granja / Empresa</th>
                                <th>Área</th>
                                <th>Auditoria</th>
                                <th>Data</th>
                            </tr>
                        </thead>

                        <tbody id="tabela-auditorias-corpo">
                            <tr>
                                <td data-label="ID">#1</td>
                                <td data-label="Granja / Empresa">Granja São João</td>
                                <td data-label="Área">Avicultura</td>
                                <td data-label="Checklist">Biosegurança</td>
                                <td data-label="Data">12/06/2025</td>


                                <!-- AÇÕES -->
                                <td class="acoes" data-label="Ações">
                                    <a class="btn-icone" title="Visualizar" href="#"><img src="../../public/img/olho.png" alt="Ver"></a>
                                    <a class="btn-icone" title="Baixar" href="#"><img src="../../public/img/editar.png" alt="Editar"></a>
                                    <a class="btn-icone" title="Plano de ação" href="#"><img src="../../public/img/lixeira.png" alt="Excluir"></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="area-novo">
            <h2>Criar novo checklist</h2>
            <p class="area-instrucao">Dê um nome ao checklist, escolha a área e adicione as perguntas.</p>
            
            <!-- DADOS DO CHECKLIST -->
            <div class="dados-checklist">
                <div class="item-campo">
                    <label for="nomeChecklist">Nome do checklist</label>
                    <input type="text" id="nomeChecklist" placeholder="Ex: Auditoria de Biossegurança">
                </div>

                <div class="item-campo">
                    <label for="areaChecklist">Área</label>
                    <select id="areaChecklist">
                        <option value="">Selecione a área</option>
                        <option value="avicultura">Avicultura</option>
                        <option value="agronomia">Agronomia</option>
                        <option value="incubatorio">Incubatório</option>
                        <option value="abatedouro">Abatedouro</option>
                        <option value="pecuaria">Pecuária</option>
                    </select>
                </div>
            </div>

            <!-- PERGUNTAS -->
            <ul class="lista-itens-auditoria" id="listaPerguntas">
                <!-- perguntas são inseridas aqui via JS -->
            </ul>

            <button type="button" class="btn-add-item" id="btnAddPergunta">
                <span aria-hidden="true">+</span> Adicionar pergunta
            </button>

            <!-- Template escondido, usado pelo JS pra clonar novas perguntas -->
            <template id="templatePergunta">
                <li class="item-auditoria">
                    <div class="item-auditoria__cabecalho">
                        <span class="item-numero"></span>
                        <button type="button" class="item-remover" aria-label="Remover pergunta">✕</button>
                    </div>

                    <div class="item-campo">
                        <label>Pergunta</label>
                        <input type="text" class="item-pergunta" placeholder="Ex: As instalações estão limpas?">
                    </div>
                </li>
            </template>

            <!-- AÇÕES -->
            <div class="rodape-acoes">
                <button type="button" class="btn-proximo" id="btnSalvarChecklist" disabled>
                    Salvar checklist
                </button>
            </div>
        </section>

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

    <script src="../../public/js/checklist.js"></script>
</body>
</html>