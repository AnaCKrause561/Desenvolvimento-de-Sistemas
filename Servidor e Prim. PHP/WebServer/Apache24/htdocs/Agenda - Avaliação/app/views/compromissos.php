<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/Compromissos.css" />
    <title>Compromissos</title>
</head>

<body>
    <div class="overlay"></div>

    <!-- MENU -->
    <div class="sidebar">
        <br>
        <h2>Agenda</h2>
        <br><br>

        <ul>
            <li><a href="dashboard.php"> 🏠 Dashboard </a></li>
            <li><a href="contatos.php">👥 Contatos </a></li>
            <li class="ativo"><a href="compromissos.php">📅 Compromissos </a></li>
            <li><a href="perfil.php">👤 Perfil </a></li>
            <li><a href="configuracao.php">⚙️ Configurações </a></li>
            <li><a href="sair.php">🚪 Sair </a></li>
        </ul>
    </div>

    <!-- CONTEÚDO -->
    <main class="conteudo">

        <!-- NOTIFICAÇÃO -->
        <div class="topo">

            <div class="notificacao">
                <span class="sino">🔔</span>

                <div class="menu-notificacao">
                    <div class="item">👥 Novo contato cadastrado</div>
                    <div class="item">📅 Compromisso amanhã às 14h</div>
                    <div class="item">✅ Tarefa concluída</div>
                </div>
            </div>

            <div class="usuario">
                <img src="../../public/img/perfil.jpeg" alt="Usuário">
            </div>

        </div>

        <!-- OLÁ -->
        <div class="cabecalho">
            <h1>Compromissos</h1>
            <p>Gerencie todos os seus compromissos.</p>
            <br>
        </div>

        <!-- PESQUISA -->
        <div class="busca">
            <label for="pesquisa">🔍</label>
            <input type="button" id="pesquisa" hidden />
            <input type="text" placeholder="Buscar contatos..." />

            <button class="btn-novo">➕ Novo Compromisso</button>
        </div>

        <!-- ABAS -->
        <div class="abas">
            <button class="aba ativa">Todos</button>
            <button class="aba">Pendentes</button>
            <button class="aba">Concluídos</button>
        </div>

        <!-- PAINEL -->
        <div class="painel">

            <div class="box">
                <!-- TABELA DE CONTATOS -->
                <div class="compromissos">

                    <!-- COMPROMISSO 1 -->
                    <div class="compromisso">
                        <div class="data">
                            <h2>20</h2>
                            <span>JUL</span>
                        </div>

                        <div class="info">
                            <h3>Reunião com cliente</h3>
                            <p>09:00 - 10:00</p>
                        </div>

                        <span class="reuniao">Reunião</span>

                        <div class="acoes">
                            <button class="btn-editar">✏️</button>
                            <button class="btn-excluir">🗑️</button>
                        </div>
                    </div>

                    <!-- COMPROMISSO 2 -->
                    <div class="compromisso">
                        <div class="data">
                            <h2>21</h2>
                            <span>JUL</span>
                        </div>

                        <div class="info">
                            <h3>Dentista</h3>
                            <p>14:30 - 15:30</p>
                        </div>

                        <span class="tag pessoal">Pessoal</span>

                        <div class="acoes">
                            <button class="btn-editar">✏️</button>
                            <button class="btn-excluir">🗑️</button>
                        </div>
                    </div>

                    <!-- COMPROMISSO 3 -->
                    <div class="compromisso">

                        <div class="data">
                            <h2>22</h2>
                            <span>JUL</span>
                        </div>

                        <div class="info">
                            <h3>Entrega do projeto</h3>
                            <p>17:00 - 18:00</p>
                        </div>

                        <span class="tag trabalho">Trabalho</span>

                        <div class="acoes">
                            <button class="btn-editar">✏️</button>
                            <button class="btn-excluir">🗑️</button>
                        </div>

                    </div>

                    <!-- COMPROMISSO 4 -->
                    <div class="compromisso">

                        <div class="data">
                            <h2>23</h2>
                            <span>JUL</span>
                        </div>

                        <div class="info">
                            <h3>Academia</h3>
                            <p>07:00 - 08:00</p>
                        </div>

                        <span class="tag saude">Saúde</span>

                        <div class="acoes">
                            <button class="btn-editar">✏️</button>
                            <button class="btn-excluir">🗑️</button>
                        </div>

                    </div>

                </div>
            </div>
    </main>
</body>

</html>