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
        <h2>Agenda</h2>
        <br>

        <ul>
            <li>🏠 Dashboard</li>
            <li>👥 Contatos</li>
            <li>📅 Compromissos</li>
            <li>👤 Perfil</li>
            <li>⚙️ Configurações</li>
            <li>🚪 Sair</li>
        </ul>
    </div>

    <!-- CONTEÚDO -->
    <main class="conteudo">
        <div class="busca">
            <span>🔍</span>
            <input type="text" placeholder="Buscar contatos, compromissos..." />

            <div class="notificacao"><input type="text" placeholder="🔔" /></div>

            <div class="usuario">
                <img src="../../public/img/perfil.jpeg" alt="Usuário">
            </div>
        </div>
        <br>

        <div class="cabecalho">
            <h1>Olá, Ana! 👋</h1>
            <p>Bem-vindo à sua agenda eletrônica.</p>
        </div>

        <div class="cards">

            <div class="card">
                <h3>👥 Contatos</h3>
                <span>128</span>
                <p>Total de contatos</p>
            </div>

            <div class="card">
                <h3>📅 Compromissos</h3>
                <span>15</span>
                <p>Próximos 7 dias</p>
            </div>

            <div class="card">
                <h3>📒 Tarefas</h3>
                <span>8</span>
                <p>Pendentes</p>
            </div>

            <div class="card">
                <h3>✅ Concluídos</h3>
                <span>23</span>
                <p>Este mês</p>
            </div>

        </div>

        <div class="painel">

            <div class="box">
                <h3>Próximos compromissos</h3>
            </div>

            <div class="box">
                <h3>Contatos recentes</h3>
            </div>

        </div>
    </main>
</body>

</html>