<?php
session_name("ProjetoIntegrado");
session_start();

require_once("../models/User.php");

$modeloUsuario = new User();
$usuarioLogado = $modeloUsuario->ListarUmUsuario($_SESSION["usuario_id"]);
$foto = $modeloUsuario->ListarUmUsuario($_SESSION["usuario_id"]);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/perfil.css" />
    <title>Meu Perfil</title>
</head>

<body>
    <!-- MENU -->
    <button class="menu-mobile">☰</button>
    <!-- Overlay -->
    <div class="overlay"></div>

    <div class="sidebar">
        <br>
        <h2><img class="logo" src="../../public/img/Logo.png"> Farms Check</h2>

        <ul>
            <li><a href="dashboard.php"><img class="icones" src="../../public/img/dash.png"><span>Dashboard</span></a></li>
            <li><a href="novo_checklist.php"><img class="icones" src="../../public/img/nova.png"><span>Nova Auditoria</span></a></li>
            <li><a href="pdfs.php"><img class="icones" src="../../public/img/PDF.png"><span>PDFs</span></a></li>
            <li><a href="checklist.php"><img class="icones" src="../../public/img/checklist.png"><span>Checklists</span></a></li>
            <li><a href="cadastros.php"><img class="icones" src="../../public/img/cadastro.png"><span>Novo Cadastro</span></a></li>
            <li><a href="calendario.php"><img class="icones" src="../../public/img/calendario.png"><span>Calendário</span></a></li>
            <li class="ativo"><a href="perfil.php"><img class="icones" src="../../public/img/perfil.png"><span>Perfil</span></a></li>
            <li><a href="logoff.php"><img class="icones" src="../../public/img/sair.png"><span>Sair</span></a></li>
        </ul>
    </div>

    <!-- CONTEÚDO -->
    <main class="conteudo">

        <!-- TOPO -->
        <div class="busca">
            <div class="notificacao">
                <span><img class="sino" src="../../public/img/sino.png"></span>
            </div>
            <div class="usuario">
                <img src="<?= $usuarioLogado["url"] ? "../../" . $usuarioLogado["url"] : "../../public/img/perfil.jpeg"; ?>" alt="Usuário">
            </div>
        </div>

        <!-- CABEÇALHO -->
        <div class="cabecalho">
            <h1>Meu perfil</h1>
            <p>Atualize suas informações pessoais e de acesso.</p>
        </div>

        <!-- ===== EDIÇÃO DE PERFIL ===== -->
        <section class="card-cadastro">

            <form id="formPerfil" class="form-cadastro" novalidate action="../controllers/perfil_controller.php" method="POST" enctype="multipart/form-data">

                <!-- FOTO -->
                <div class="perfil-foto">
                    <div class="perfil-foto__preview">
                        <img id="previewFoto" src="<?= $usuarioLogado["url"] ? "../../" . $usuarioLogado["url"] : "../../public/img/perfil.jpeg"; ?>" alt="Foto do usuário">
                    </div>
                    <div class="perfil-foto__acoes">
                        <label for="perfilFoto" class="btn-trocar-foto">Trocar foto</label>
                        <input type="file" id="perfilFoto" accept="image/*" hidden>
                        <span class="perfil-foto__dica">JPG ou PNG, até 5MB</span>
                    </div>
                </div>

                <div class="grade-campos">
                    <div class="item-campo">
                        <label for="perfilNome">Nome completo</label>
                        <input type="text" id="perfilNome" name="nome" value="<?= htmlspecialchars($usuarioLogado["nome"]) ?>" required>
                    </div>

                    <div class="item-campo">
                        <label for="perfilLogin">Usuário (login)</label>
                        <input type="text" id="perfilLogin" name="login" value="<?= htmlspecialchars($usuarioLogado["login"]) ?>" required>
                    </div>

                    <div class="item-campo">
                        <label for="perfilEmail">E-mail</label>
                        <input type="email" id="perfilEmail" name="email" value="<?= htmlspecialchars($usuarioLogado["email"]) ?>" required>
                    </div>

                    <div class="item-campo">
                        <label for="perfilSenha">Nova senha</label>
                        <input type="password" id="perfilSenha" name="senha" placeholder="Deixe em branco para manter a atual">
                    </div>

                    <div class="item-campo">
                        <label for="perfilCargo">Cargo</label>
                        <input type="text" id="perfilCargo" name="cargo" value="<?= htmlspecialchars($usuarioLogado["cargo"]) ?>">
                    </div>

                    <div class="item-campo">
                        <label for="perfilSenhaConfirma">Confirmar nova senha</label>
                        <input type="password" id="perfilSenhaConfirma" name="senha_confirma" placeholder="Repita a nova senha">
                    </div>

                    <div class="item-campo">
                        <label for="perfilNivelAcesso">Nível de acesso</label>
                        <select id="perfilNivelAcesso" name="nivel_acesso" required>
                            <option value="">Selecione o nível</option>
                            <option value="1" <?= $usuarioLogado["nivel_idfk"] == 1 ? "selected" : "" ?>>Administrador</option>
                            <option value="2" <?= $usuarioLogado["nivel_idfk"] == 2 ? "selected" : "" ?>>Auditor</option>
                            <option value="3" <?= $usuarioLogado["nivel_idfk"] == 3 ? "selected" : "" ?>>Supervisor</option>
                            <option value="4" <?= $usuarioLogado["nivel_idfk"] == 4 ? "selected" : "" ?>>Gerente</option>
                        </select>
                    </div>
                </div>

                <div div class="item-campo item-areas">
                    <label>Áreas de atuação</label>
                    <div class="grupo-checkbox">
                        <label class="opcao-checkbox">
                            <input type="radio" name="usuarioAreas[]" value="1" <?= $usuarioLogado["area_acesso"] == 1 ? "checked" : "" ?>>
                            <span>Avicultura</span>
                        </label>
                        <label class="opcao-checkbox">
                            <input type="radio" name="usuarioAreas[]" value="2" <?= $usuarioLogado["area_acesso"] == 2 ? "checked" : "" ?>>
                            <span>Agronomia</span>
                        </label>
                        <label class="opcao-checkbox">
                            <input type="radio" name="usuarioAreas[]" value="3" <?= $usuarioLogado["area_acesso"] == 3 ? "checked" : "" ?>>
                            <span>Incubatório</span>
                        </label>
                        <label class="opcao-checkbox">
                            <input type="radio" name="usuarioAreas[]" value="4" <?= $usuarioLogado["area_acesso"] == 4 ? "checked" : "" ?>>
                            <span>Abatedouro</span>
                        </label>
                    </div>
                </div>

                <div class="item-status">
                    <label class="switch">
                        <input type="checkbox" id="perfilAtivo" name="ativo" <?= $usuarioLogado["ativo"] ? "checked" : "" ?>>
                        <span class="switch__trilho"></span>
                    </label>
                    <div>
                        <span class="item-status__titulo">Usuário ativo</span>
                        <span class="item-status__legenda" id="perfilAtivoLegenda"><?= $usuarioLogado["ativo"] ? "Poderá acessar o sistema normalmente." : "Ficará bloqueado e não conseguirá acessar o sistema." ?></span>
                    </div>
                </div>

                <div class="rodape-form">
                    <span class="mensagem-sucesso" id="mensagemPerfil"></span>
                    <button type="submit" class="btn-salvar">Salvar alterações</button>
                </div>
            </form>
        </section>

    </main>

    <script>
        const botao = document.querySelector(".menu-mobile");
        const sidebar = document.querySelector(".sidebar");
        const overlay = document.querySelector(".overlay");

        botao.addEventListener("click", () => {
            sidebar.classList.toggle("abrir");
            overlay.classList.toggle("ativo");
            document.body.classList.toggle("sem-scroll");
        });

        overlay.addEventListener("click", () => {
            sidebar.classList.remove("abrir");
            overlay.classList.remove("ativo");
            document.body.classList.remove("sem-scroll");
        });
    </script>

    <script src="../../public/js/perfil.js"></script>
</body>

</html>