<?php

session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../../info.html");
    exit();
}

include_once("../models/Contatos.php");

$obj = new Contatos();

$lista = $obj->ListarTodosContatos();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/Contatos.css" />
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
            <li><a href="dashboard.php"> 🏠 Dashboard </a></li>
            <li class="ativo"><a href="contatos.php">👥 Contatos </a></li>
            <li><a href="compromissos.php">📅 Compromissos </a></li>
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
                <img src="<?= $_SESSION["foto"] ?>">
            </div>

        </div>

        <!-- OLÁ -->
        <div class="cabecalho">
            <h1>Contatos</h1>
            <p>Gerencie todos os seus contatos cadastrados.</p>
            <br>
        </div>

        <!-- PESQUISA -->
        <div class="busca">
            <label for="pesquisa">🔍</label>
            <input type="button" id="pesquisa" hidden />
            <input type="text" placeholder="Buscar contatos..." />

            <a href="novo_contato.php"><button class="btn-novo">➕ Novo Contato</button></a>
        </div>

        <!-- PAINEL -->
        <div class="painel">

            <div class="box">
                <!-- TABELA DE CONTATOS -->
                <div class="box tabela-box">

                    <table class="tabela-contatos">

                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>E-mail</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($lista as $contato): ?>
                                <tr>
                                    <td><?= $contato["nome"] ?></td>
                                    <td><?= $contato["telefone"] ?></td>
                                    <td><?= $contato["email"] ?></td>

                                    <td class="acoes">
                                        <a href="editar_contato.php?id=<?= $contato["id"] ?>">✏️</a>
                                        <a href="../controllers/excluir_contato_controller.php?id=<?= $contato["id"] ?>">🗑️</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>

                    <div class="paginacao">
                        <button>◀</button>
                        <button class="pagina-ativa">1</button>
                        <button>2</button>
                        <button>3</button>
                        <button>▶</button>
                    </div>

                </div>
            </div>
        </div>
    </main>
</body>

</html>