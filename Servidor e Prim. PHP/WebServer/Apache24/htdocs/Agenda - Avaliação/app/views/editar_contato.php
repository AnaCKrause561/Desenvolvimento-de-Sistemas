<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/Editar_contato.css" />
    <title>Editar Contato</title>
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
            <h1>Editar Contato</h1>
            <br>
            <a href="contatos.php">&lt; Voltar</a>
        </div>

        <!-- PAINEL -->
        <div class="painel">

            <!-- BOX 1 - CONTATO -->
            <div class="box">

                <div class="contato-info">

                    <img src="../../public/img/login.png" alt="Perfil">

                    <h3>Ana Maria</h3>
                    <p>Amiga</p>

                    <div class="acoes">
                        <button class="btn-editar">✏️ Editar</button>
                        <button class="btn-excluir">🗑️ Excluir</button>
                    </div>

                </div>

            </div>

            <!-- BOX 2 - INFORMAÇÕES -->
            <div class="box">

                <h2>Informações do Contato</h2>

                <div class="card">
                    <strong>📞 Telefone</strong>
                    <p>(99) 99999-9999</p>
                </div>

                <div class="card">
                    <strong>📧 E-mail</strong>
                    <p>anama@gmail.com</p>
                </div>

                <div class="card">
                    <label>Observações</label>
                    <textarea readonly="Minha amiga do trabalho. Gosta de café e viagens."></textarea>
                </div>

            </div>

            <!-- BOX 3 - AÇÕES -->
            <div class="box">

                <h2>Ações Rápidas</h2>

                <div class="acoes-rapidas">
                    <a href="#">💬 Enviar Mensagem</a>
                    <a href="#">📞 Ligar</a>
                    <a href="#">📧 Enviar E-mail</a>
                </div>

            </div>

        </div>

    </main>

</body>

</html>