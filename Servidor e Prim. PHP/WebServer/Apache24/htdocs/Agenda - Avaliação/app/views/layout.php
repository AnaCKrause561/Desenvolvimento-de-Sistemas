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
                <img src="../../public/img/perfil.jpeg" alt="Usuário">
            </div>
        </div>
    </main>
</body>

</html>