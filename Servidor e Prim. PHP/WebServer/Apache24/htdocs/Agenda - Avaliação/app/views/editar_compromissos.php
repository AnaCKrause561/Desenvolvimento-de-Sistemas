<?php
session_start();
include_once("../models/Compromissos.php");

$obj = new Compromissos();

$id = $_GET["id"];
$compromisso = $obj->ListarUmCompromisso($id);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/Editar_compromissos.css" />
    <title>Editar Compromisso</title>
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

<main class="conteudo">

    <!-- TOPO -->
    <div class="topo">
        <div class="usuario">
            <img src="<?= $_SESSION["foto"]; ?>" alt="Usuário">
        </div>
    </div>

    <!-- CABEÇALHO -->
    <div class="cabecalho">
        <a href="compromissos.php" class="voltar">← Voltar</a>
        <h1>Editar Compromisso</h1>
    </div>

    <!-- FORM -->
    <div class="painel">

        <div class="box">

            <form method="post" action="../controllers/editar_compromissos_controllers.php">

                <!-- ID oculto -->
                <input type="hidden" name="id" value="<?= $compromisso["id"] ?>">

                <label>Título</label>
                <input type="text"
                       name="titulo"
                       value="<?= htmlspecialchars($compromisso["titulo"]) ?>"
                       required>

                <label>Descrição</label>
                <textarea name="descricao"><?= htmlspecialchars($compromisso["descricao"]) ?></textarea>

                <div class="linha">

                    <div class="campo">
                        <label>Data</label>
                        <input type="date"
                               name="data"
                               value="<?= $compromisso["data"] ?>"
                               required>
                    </div>

                    <div class="campo">
                        <label>Hora</label>
                        <input type="time"
                               name="hora"
                               value="<?= $compromisso["hora"] ?>"
                               required>
                    </div>

                </div>

                <label>Status</label>
                <select name="status" required>

                    <option value="Pendente" <?= $compromisso["status"] == "Pendente" ? "selected" : "" ?>>
                        Pendente
                    </option>

                    <option value="Concluído" <?= $compromisso["status"] == "Concluído" ? "selected" : "" ?>>
                        Concluído
                    </option>

                    <option value="Cancelado" <?= $compromisso["status"] == "Cancelado" ? "selected" : "" ?>>
                        Cancelado
                    </option>

                </select>

                <div class="botoes">

                    <a href="compromissos.php" class="btn-cancelar">
                        Cancelar
                    </a>

                    <input type="submit" value="Atualizar Compromisso">

                </div>

            </form>

        </div>

    </div>

</main>

</body>
</html>