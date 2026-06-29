<?php
session_start();

include_once("../models/Contatos.php");
include_once("../models/Compromissos.php");
include_once("../models/Usuario.php");

$contatosModel = new Contatos();
$compromissosModel = new Compromissos();
$usuarioModel = new Usuario();

$contatos = $contatosModel->ListarTodosContatos();
$compromissos = $compromissosModel->ListarTodosCompromissos();

$usuario = $usuarioModel->BuscarUsuario($_SESSION["usuario_id"]);

$totalContatos = count($contatos);
$totalCompromissos = count($compromissos);

$pendentes = array_filter($compromissos, fn($c) => $c["status"] == "Pendente");
$concluidos = array_filter($compromissos, fn($c) => $c["status"] == "Concluído");

$hoje = date('Y-m-d');
$seteDias = date('Y-m-d', strtotime('+7 days'));

$proximos = array_filter($compromissos, function ($c) use ($hoje, $seteDias) {
    return $c["data"] >= $hoje && $c["data"] <= $seteDias;
});
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/Dashboard.css">
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
            <li class="ativo"><a href="dashboard.php">🏠 Dashboard</a></li>
            <li><a href="contatos.php">👥 Contatos</a></li>
            <li><a href="compromissos.php">📅 Compromissos</a></li>
            <li><a href="perfil.php">👤 Perfil</a></li>
            <li><a href="configuracao.php">⚙️ Configurações</a></li>
            <li><a href="logoff.php">🚪 Sair</a></li>
        </ul>
    </div>

    <!-- CONTEÚDO -->
    <main class="conteudo">

        <!-- TOPO -->
        <div class="busca">

            <label>🔍</label>
            <input type="text" placeholder="Buscar contatos, compromissos..." />

            <div class="notificacao">
                <span class="sino">🔔</span>
            </div>

            <!-- FOTO VINDO DO BANCO -->
            <div class="usuario">
                <img src="<?= $usuario["url"] ?? '../../public/img/perfil.jpeg' ?>" alt="Usuário">
            </div>

        </div>

        <!-- CABEÇALHO -->
        <div class="cabecalho">
            <h1>
                Olá, <?= htmlspecialchars($usuario["nome"] ?? '') ?> 👋
            </h1>
            <p>Bem-vindo à sua agenda eletrônica.</p>
        </div>

        <!-- CARDS -->
        <div class="cards">

            <div class="card">
                <h3>👥 Contatos</h3>
                <span><?= $totalContatos ?></span>
                <p>Total de contatos</p>
            </div>

            <div class="card">
                <h3>📅 Compromissos</h3>
                <span><?= count($proximos) ?></span>
                <p>Próximos 7 dias</p>
            </div>

            <div class="card">
                <h3>📒 Pendentes</h3>
                <span><?= count($pendentes) ?></span>
                <p>Em aberto</p>
            </div>

            <div class="card">
                <h3>✅ Concluídos</h3>
                <span><?= count($concluidos) ?></span>
                <p>Finalizados</p>
            </div>

        </div>

        <!-- PAINEL -->
        <div class="painel">

            <!-- COMPROMISSOS -->
            <div class="box">
                <h3>Próximos compromissos</h3>

                <?php if (!empty($proximos)) { ?>
                    <?php foreach (array_slice($proximos, 0, 3) as $c) { ?>
                        <div class="compromisso">
                            <strong><?= htmlspecialchars($c["titulo"] ?? '') ?></strong>
                            <p>
                                <?= date("d/m/Y H:i", strtotime($c["data"] . " " . $c["hora"])) ?>
                            </p>
                            <span class="tag"><?= htmlspecialchars($c["status"] ?? '') ?></span>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p>Nenhum compromisso nos próximos dias.</p>
                <?php } ?>
            </div>

            <!-- CONTATOS -->
            <div class="box">
                <h3>Contatos recentes</h3>

                <div class="recentes">

                    <?php if (!empty($contatos)) { ?>
                        <?php foreach (array_slice($contatos, 0, 3) as $ct) { ?>
                            <div class="usuario">
                                <img src="<?= $ct["url"] ?? '../../public/img/perfil.jpeg' ?>" alt="Contato">

                                <strong>
                                    <?= htmlspecialchars($ct["nome"] ?? 'Sem nome') ?>
                                    <p><?= htmlspecialchars($ct["telefone"] ?? 'Sem telefone') ?></p>
                                </strong>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <p>Nenhum contato cadastrado.</p>
                    <?php } ?>

                </div>

            </div>

        </div>

    </main>

</body>

</html>