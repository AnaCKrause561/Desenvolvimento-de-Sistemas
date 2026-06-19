<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/Novo_contato.css" />
    <title>Contatos</title>
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
            <h1>Novo Contato</h1>
            <br>
            <a href="contatos.php">&lt; Voltar</a>
        </div>

        <!-- PAINEL -->
        <div class="painel">

            <!-- FORMULÁRIO -->
            <div class="box">

                <div class="formulario">

                    <form>

                    <!-- ANEXAR IMG -->
                        <div class="foto_perfil">

                            <img src="../../public/img/login.png" alt="Perfil">

                            <div class="campo_foto">
                                <label>Foto de Perfil</label>
                                <input type="file" accept="image/*">
                            </div>

                        </div>

                        <label>Nome Completo</label>
                        <input type="text" placeholder="Digite seu nome">

                        <label>E-mail</label>
                        <input type="email" placeholder="Digite seu e-mail">

                        <label>Telefone</label>
                        <input type="tel" placeholder="(46) 99999-9999">

                        <label>Observações</label>
                        <textarea placeholder="Informações adicionais..."></textarea>

                        <!-- BOTÕES -->
                        <div class="botoes">
                            <a href="contatos.php" class="btn-cancelar">Cancelar</a>
                            <input type="submit" value="Salvar Contato">
                        </div>

                    </form>

                </div>

            </div>

            <!-- PRE VISU -->
            <div class="box pre">

                <h1>Pré-visualização</h1><br>

                <img src="../../public/img/login.png" alt="Perfil">
                <h2>Nome Completo</h2>
                <p>(11) 90000-0000</p>
                <p>email@gmail.com</p>

            </div>

        </div>

    </main>

</body>

</html>