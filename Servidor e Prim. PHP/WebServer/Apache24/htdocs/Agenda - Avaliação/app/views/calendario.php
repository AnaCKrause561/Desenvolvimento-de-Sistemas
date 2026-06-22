<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/Calendario.css" />
    <title>Calendario</title>
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
            <li><a href="compromissos.php">📅 Compromissos </a></li>
            <li><a href="perfil.php">👤 Perfil </a></li>
            <li class="ativo"><a href="configuracao.php">⚙️ Configurações </a></li>
            <li><a href="sair.php">🚪 Sair </a></li>
        </ul>
    </div>

    <!-- CONTEÚDO -->
    <main class="conteudo">

        <div class="topo">
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

        <h1>Meu calendário</h1>

        <div class="box">

            <!-- TOPO DO CALENDÁRIO -->
            <div class="topo-calendario">

                <!-- Mês -->
                <div class="data">
                    <h2>Julho 2026</h2>
                </div>

                <!-- Botão Hoje -->
                <div class="campo">
                    <button class="btn-hoje">Hoje</button>
                    <input type="date" class="input-data"/> 
                </div>

                <!-- Abas -->
                <div class="abas">
                    <button class="aba">Dia</button>
                    <button class="aba ativa">Semana</button>
                    <button class="aba">Mês</button>
                </div>

            </div>

            <!-- CALENDÁRIO -->
            <div class="calendario">

                <div class="cabecalho">Hora</div>
                <div class="cabecalho">Seg 06</div>
                <div class="cabecalho">Ter 07</div>
                <div class="cabecalho">Qua 08</div>
                <div class="cabecalho">Qui 09</div>
                <div class="cabecalho">Sex 10</div>
                <div class="cabecalho">Sáb 11</div>
                <div class="cabecalho">Dom 12</div>

                <div class="hora">08:00</div>
                <div class="celula"></div>
                <div class="celula">
                    <div class="evento-rosa"> Projeto XI </div>
                </div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula">
                    <div class="evento-azul"> Pilates </div>
                </div>
                <div class="celula"></div>

                <div class="hora">09:00</div>
                <div class="celula">
                    <div class="evento verde"> Reunião </div>
                </div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                
                <div class="hora">10:00</div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula">
                    <div class="evento-azul"> Dentista </div>
                </div>
                <div class="celula"></div>
                <div class="celula"></div>

                <div class="hora">11:00</div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>

                <div class="hora">12:00</div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>

                <div class="hora">13:00</div>
                <div class="celula"></div>
                <div class="celula">
                    <div class="evento-rosa"> Projeto XII </div>
                </div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>

                <div class="hora">14:00</div>
                <div class="celula">
                    <div class="evento verde"> Reunião </div>
                </div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>

                <div class="hora">15:00</div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>

                <div class="hora">16:00</div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>

                <div class="hora">17:00</div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>

                <div class="hora">18:00</div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>
                <div class="celula"></div>

            </div>
        </div>
    </main>
</body>

</html>