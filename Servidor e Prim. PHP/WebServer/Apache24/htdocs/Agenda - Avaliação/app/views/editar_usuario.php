<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/Editar_usuario.css" />
    <title>Editar Usuário</title>
</head>

<body>

    <div class="overlay"></div>

    <!-- MENU -->
    <div class="sidebar">
        <br>
        <h2>Agenda</h2>
        <br><br>

        <ul>
            <li><a href="dashboard.php">🏠 Dashboard</a></li>
            <li class="ativo"><a href="contatos.php">👥 Contatos</a></li>
            <li><a href="compromissos.php">📅 Compromissos</a></li>
            <li><a href="perfil.php">👤 Perfil</a></li>
            <li><a href="configuracao.php">⚙️ Configurações</a></li>
            <li><a href="sair.php">🚪 Sair</a></li>
        </ul>
    </div>

    <!-- CONTEÚDO -->
    <main class="conteudo">

        <!-- TOPO -->
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

        <!-- CABEÇALHO -->
        <div class="cabecalho">
            <h1>Editar Usuário</h1>
            <br>
            <a href="contatos.php">&lt; Voltar</a><br>
        </div>

        <!-- PAINEL -->
        <div class="painel">

            <!-- PERFIL -->
            <div class="box pre">

                <img src="../../public/img/login.png" alt="Perfil">

                <h2>Nome Completo</h2>

                <p>email@gmail.com</p>

                <button class="btn-foto">Alterar Foto</button>

            </div>


            <!-- FORMULÁRIO -->

            <div class="box_formulario">

                <form>

                    <label>Nome Completo</label>

                    <input type="text" name="nome" placeholder="Digite seu nome">

                    <label>E-mail</label>

                    <input type="email" name="email" placeholder="Digite seu e-mail">

                    <label>Telefone</label>

                    <input type="tel" name="telefone" placeholder="(46) 99999-9999">

                    <label>Descrição Pessoal</label>

                    <textarea placeholder="Fale um pouco sobre você"></textarea>

                    <button type="submit" class="btn-salvar">Salvar Alterações</button>

                </form>

            </div>

        </div>

    </main>

</body>

</html>