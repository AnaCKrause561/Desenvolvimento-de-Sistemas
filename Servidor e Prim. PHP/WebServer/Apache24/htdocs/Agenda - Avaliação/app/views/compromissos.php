<?php
session_start();
include_once("../models/Compromissos.php");

$obj = new Compromissos();
$lista = $obj->ListarTodosCompromissos();
?>

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
                <img src="<?= $_SESSION["foto"]; ?>" alt="Usuário">
            </div>

        </div>

        <!-- CABEÇALHO -->
        <div class="cabecalho">
            <h1>Compromissos</h1>
            <p>Gerencie todos os seus compromissos.</p>
            <br>
        </div>

        <!-- PESQUISA -->
        <div class="busca">

            <label for="pesquisa">🔍</label>
            <input type="button" id="pesquisa" hidden />
            <input type="text" placeholder="Buscar compromissos..." />

            <a href="novo_compromisso.php">
                <button type="button" class="btn-novo">
                    ➕ Novo Compromisso
                </button>
            </a>

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

                <div class="compromissos">

                    <?php if (!empty($lista)) { ?>

                        <?php foreach ($lista as $compromisso) { ?>

                            <div class="compromisso">

                                <div class="data">
                                    <h2><?= date("d", strtotime($compromisso["data"])) ?></h2>
                                    <span><?= strtoupper(date("M", strtotime($compromisso["data"]))) ?></span>
                                </div>

                                <div class="info">

                                    <h3><?= htmlspecialchars($compromisso["titulo"]) ?></h3>

                                    <p>
                                        <?= date("H:i", strtotime($compromisso["hora"])) ?>
                                    </p>

                                </div>

                                <span class="tag">
                                    <?= htmlspecialchars($compromisso["status"]) ?>
                                </span>

                                <div class="acoes">

                                    <a href="editar_compromissos.php?id=<?= $compromisso["id"] ?>">
                                        <button type="button" class="btn-editar">
                                            ✏️
                                        </button>
                                    </a>

                                    <a href="../controllers/excluir_compromisso_controller.php?id=<?= $compromisso["id"] ?>"
                                       onclick="return confirm('Deseja realmente excluir este compromisso?')">

                                        <button type="button" class="btn-excluir">
                                            🗑️
                                        </button>

                                    </a>

                                </div>

                            </div>

                        <?php } ?>

                    <?php } else { ?>

                        <div class="compromisso">

                            <div class="info">
                                <h3>Nenhum compromisso cadastrado.</h3>
                                <p>Clique em "Novo Compromisso" para adicionar um.</p>
                            </div>

                        </div>

                    <?php } ?>

                </div>

            </div>

        </div>

    </main>

</body>

</html>