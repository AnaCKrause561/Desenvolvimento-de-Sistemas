<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/Novo_compromisso.css" />
    <title>Novo Compromisso</title>
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
            <li><a href="contatos.php">👥 Contatos</a></li>
            <li class="ativo"><a href="compromissos.php">📅 Compromissos</a></li>
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

            <a href="compromissos.php" class="voltar">
                ← Voltar
            </a>

            <h1>Novo Compromisso</h1>

        </div>

        <!-- PAINEL -->
        <div class="painel">

            <!-- FORMULÁRIO -->
            <div class="box">

                <form>

                    <label>Título</label>
                    <input type="text" placeholder="Digite o título do compromisso">

                    <label>Descrição</label>
                    <textarea placeholder="Detalhes sobre o compromisso..."></textarea>

                    <div class="linha">

                        <div class="campo">
                            <label>Data</label>
                            <input type="date">
                        </div>

                        <div class="campo">
                            <label>Hora</label>
                            <input type="time">
                        </div>

                    </div>

                    <label>Status</label>

                    <select>
                        <option>Pendente</option>
                        <option>Concluído</option>
                        <option>Cancelado</option>
                    </select>

                    <div class="botoes">

                        <a href="compromissos.php" class="btn-cancelar">
                            Cancelar
                        </a>

                        <input
                            type="submit"
                            value="Salvar Compromisso">

                    </div>

                </form>

            </div>

            <!-- RESUMO -->
            <div class="box resumo">

                <h3>Resumo</h3>

                <div class="resumo">

                    <h4>Título do compromisso</h4>

                    <p>
                        📅 20/05/2026 às 09:00
                    </p>

                    <span class="status-resumo">
                        Pendente
                    </span>

                    <p class="descricao-resumo">
                        Descrição do compromisso aparecerá aqui...
                    </p>

                </div>

            </div>

        </div>

    </main>
</body>

</html>