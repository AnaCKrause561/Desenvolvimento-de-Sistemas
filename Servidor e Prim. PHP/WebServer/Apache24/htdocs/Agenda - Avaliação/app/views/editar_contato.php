<?php
session_start();
include_once("../models/Contatos.php");

$obj = new Contatos();
$contato = $obj->ListarUmContato($_GET["id"]);
?>

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
                <img src="<?= $_SESSION["foto"]; ?>" alt="Usuário">
            </div>

        </div>

        <!-- CABEÇALHO -->
        <div class="cabecalho">
            <h1>Editar Contato</h1>
            <br>
            <a href="contatos.php">&lt; Voltar</a>
        </div>

        <!-- PAINEL -->
        <form class="painel" action="../controllers/editar_contato_controller.php" method="POST">

            <input type="hidden" name="id" value="<?= $contato["id"] ?>">

            <!-- BOX 1 -->
            <div class="box">

                <div class="contato-info">

                    <img src="../../public/img/login.png" alt="Perfil">

                    <div class="card">
                        <label>Nome</label>
                        <input type="text" name="nome" value="<?= $contato["nome"] ?>">
                    </div>

                    <div class="acoes">
                        <button type="submit" class="btn-salvar">Salvar</button>
                    </div>

                </div>

            </div>

            <!-- BOX 2 -->
            <div class="box">

                <h2>Informações do Contato</h2>

                <div class="card">
                    <label>📞 Telefone</label>
                    <input type="text" name="telefone" value="<?= $contato["telefone"] ?>">
                </div>


                <div class="card">
                    <label>📧E-mail</label>
                    <input type="email" name="email" value="<?= $contato["email"] ?>">
                </div>

                <div class="card">
                        <label>Descrição</label>
                        <textarea name="descricao"><?= $contato["descricao"] ?></textarea>
                    </div>

            </div>

            <!-- BOX 3 -->
            <div class="box">

                <h2>Ações Rápidas</h2>

                <div class="acoes-rapidas">
                    <a href="#">💬 Enviar Mensagem</a>
                    <a href="#">📞 Ligar</a>
                    <a href="#">📧 Enviar E-mail</a>
                </div>

            </div>

        </form>

    </main>

</body>

</html>