<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/Dashboard.css" />
    <title>Dashboard</title>
</head>

<body>
    <div class="overlay"></div>

    <!-- MENU -->
    <div class="sidebar">
        <br>
        <h2>Agenda</h2>
        <br><br>

        <ul>
            <li class="ativo"><a href="dashboard.php"> 🏠 Dashboard </a></li>
            <li><a href="contatos.php">👥 Contatos </a></li>
            <li><a href="compromissos.php">📅 Compromissos </a></li>
            <li><a href="perfil.php">👤 Perfil </a></li>
            <li><a href="configuracao.php">⚙️ Configurações </a></li>
            <li><a href="sair.php">🚪 Sair </a></li>
        </ul>
    </div>

    <!-- CONTEÚDO -->
    <main class="conteudo">

        <div class="busca">
            <label for="pesquisa">🔍</label>
            <input type="button" id="pesquisa" hidden />
            <input type="text" placeholder="Buscar contatos, compromissos..." />

            <div class="notificacao">
                <span class="sino">🔔</span>

                <div class="menu-notificacao">
                    <br>
                    <div class="item">👥 Novo contato cadastrado</div>
                    <div class="item">📅 Compromisso amanhã às 14h</div>
                    <div class="item">✅ Tarefa concluída</div>
                </div>
            </div>

            <div class="usuario">
                <img src="<?= $_SESSION["foto"]; ?>" alt="Usuário">
            </div>
        </div>

        <div class="cabecalho">
            <h1>Olá, <?= $_SESSION["nome"]; ?>👋</h1>
            <p>Bem-vindo à sua agenda eletrônica.</p>
        </div>

        <div class="cards">

            <div class="card">
                <h3>👥 Contatos</h3>
                <span>100</span>
                <p>Total de contatos</p>
            </div>

            <div class="card">
                <h3>📅 Compromissos</h3>
                <span>10</span>
                <p>Próximos 7 dias</p>
            </div>

            <div class="card">
                <h3>📒 Tarefas</h3>
                <span>5</span>
                <p>Pendentes</p>
            </div>

            <div class="card">
                <h3>✅ Concluídos</h3>
                <span>20</span>
                <p>Este mês</p>
            </div>

        </div>

        <!-- PAINEL -->
        <div class="painel">

            <div class="box">
                <h3>Próximos compromissos</h3>

                <div class="compromisso">
                    <strong>Reunião com cliente</strong>
                    <p>20/07/2026 - 08:00</p>
                    <span class="tag">Reunião</span>
                </div>

                <div class="compromisso">
                    <strong>Entrega de projeto</strong>
                    <p>20/07/2026 - 13:30</p>
                    <span class="tag">Trabalho</span>
                </div>

                <div class="compromisso">
                    <strong>Reunião de alinhamento</strong>
                    <p>20/07/2026 - 16:00</p>
                    <span class="tag">Reunião</span>
                </div>

            </div>

            <div class="box">
                <h3>Contatos recentes</h3>

                <div class="recentes">

                    <div class="usuario">
                        <img src="../../public/img/perfil.jpeg" alt="Usuário">
                        <strong>Ana Maria <p>(99) 99999-9999</p></strong>
                    </div>

                    <div class="usuario">
                        <img src="../../public/img/perfil.jpeg" alt="Usuário">
                        <strong>Lúcio Andrade <p>(22) 92222-2222</p></strong>
                    </div>

                    <div class="usuario">
                        <img src="../../public/img/perfil.jpeg" alt="Usuário">
                        <strong>Carmélia Souza <p>(33) 93333-3333</p></strong>
                    </div>

                </div>

            </div>

        </div>
    </main>
</body>

</html>