<?php
session_name("ProjetoIntegrado");
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../../index.html");
    exit;
}

require_once("../models/CadastroUsuario.php"); 
require_once("../models/CadastroProdutor.php"); 
require_once("../models/CadastroEmpresa.php"); 
require_once("../models/CadastroGranja.php"); 

$modeloUsuario = new CadastroUsuario();
$usuarios = $modeloUsuario->ListarTodosUsuarios();
$foto = $modeloUsuario->ListarUmUsuario($_SESSION["usuario_id"]);

$modeloProdutor = new CadastroProdutor();
$produtores = $modeloProdutor->ListarTodosProdutores();

$modeloEmpresas = new CadastroEmpresa();
$empresas = $modeloEmpresas->ListarTodasEmpresas();

$modeloGranjas = new CadastroGranja();
$granjas = $modeloGranjas->ListarTodasGranjas();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/cadastros.css" />
    <title>Novo Cadastro</title>
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
            <li class="ativo"><a href="cadastros.php"><img class="icones" src="../../public/img/cadastro.png"><span>Novo Cadastro</span></a></li>
            <li><a href="calendario.php"><img class="icones" src="../../public/img/calendario.png"><span>Calendário</span></a></li>
            <li><a href="perfil.php"><img class="icones" src="../../public/img/perfil.png"><span>Perfil</span></a></li>
            <li><a href="../controllers/logoff.php"><img class="icones" src="../../public/img/sair.png"><span>Sair</span></a></li>
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
                <img src="<?= "../../".$foto["url"]; ?>" alt="Usuário">
            </div>
        </div>

        <!-- CABEÇALHO -->
        <div class="cabecalho">
            <h1>Novo Cadastro</h1>
            <p>Cadastre usuários, produtores, granjas ou empresas do sistema.</p>
        </div>

        <!-- ===== CADASTRO DE USUÁRIO ===== -->
        <section class="card-cadastro">
            <div class="card-cadastro__cabecalho">
                <h2>Usuário</h2>
                <p class="area-instrucao">Quem terá acesso ao sistema. Você decide se o acesso já entra ativo.</p>
            </div>

            <form  class="form-cadastro" novalidate action="../controllers/cadastro_usuario_controller.php" method="POST" enctype="multipart/form-data">
                <div class="grade-campos">
                    <div class="item-campo">
                        <label for="usuarioNome">Nome completo</label>
                        <input type="text" id="usuarioNome" name="nome" placeholder="Ex: João Pedro Alves" required>
                    </div>

                    <div class="item-campo">
                        <label for="usuarioLogin">Usuário (login)</label>
                        <input type="text" id="usuarioLogin" name="login" placeholder="Ex: joao.alves" required>
                    </div>

                    <div class="item-campo">
                        <label for="usuarioEmail">E-mail</label>
                        <input type="email" id="usuarioEmail" name="email" placeholder="Ex: joao@fazenda.com" required>
                    </div>

                    <div class="item-campo">
                        <label for="usuarioSenha">Senha</label>
                        <input type="password" id="usuarioSenha" name="senha" placeholder="Digite uma senha" required>
                    </div>

                    <div class="item-campo">
                        <label for="usuarioCargo">Cargo</label>
                        <input type="text" id="usuarioCargo" name="cargo" placeholder="Ex: Auditor de campo">
                    </div>

                    <div class="item-campo">
                        <label for="usuarioSenhaConfirma">Confirmar senha</label>
                        <input type="password" id="usuarioSenhaConfirma" placeholder="Repita a senha" required>
                    </div>

                    <div class="item-campo">
                        <label for="usuarioNivelAcesso">Nível de acesso</label>
                        <select id="usuarioNivelAcesso" name="nivel_acesso" required>
                            <option value="">Selecione o nível</option>
                            <option value="1">Administrador</option>
                            <option value="2">Auditor</option>
                            <option value="3">Supervisor</option>
                            <option value="4">Gerente</option>
                        </select>
                    </div>

                    <div class="item-campo">
                        <label for="usuarioFoto">Foto</label>
                        <input type="file" id="usuarioFoto" name="arquivo" accept="image/*">
                    </div>
                </div>

                <div class="item-campo item-areas">
                    <label>Áreas de atuação</label>
                    <div class="grupo-checkbox">
                        <label class="opcao-checkbox">
                            <input type="radio" name="usuarioAreas[]" value="1">
                            <span>Avicultura</span>
                        </label>
                        <label class="opcao-checkbox">
                            <input type="radio" name="usuarioAreas[]" value="2">
                            <span>Agronomia</span>
                        </label>
                        <label class="opcao-checkbox">
                            <input type="radio" name="usuarioAreas[]" value="3">
                            <span>Incubatório</span>
                        </label>
                        <label class="opcao-checkbox">
                            <input type="radio" name="usuarioAreas[]" value="4">
                            <span>Abatedouro</span>
                        </label>
                    </div>
                </div>

                <div class="item-status">
                    <label class="switch">
                        <input type="checkbox" name="ativo" id="usuarioAtivo" checked>
                        <span class="switch__trilho"></span>
                    </label>
                    <div>
                        <span class="item-status__titulo">Usuário ativo</span>
                        <span class="item-status__legenda" id="usuarioAtivoLegenda">Poderá acessar o sistema normalmente.</span>
                    </div>
                </div>

                <div class="rodape-form">
                    <span class="mensagem-sucesso" id="mensagemUsuario"></span>
                    <button type="submit" class="btn-salvar">Cadastrar usuário</button>
                </div>
            </form>
        </section>

        <!-- ===== CADASTRO DE PRODUTOR ===== -->
        <section class="card-cadastro">
            <div class="card-cadastro__cabecalho">
                <h2>Produtor</h2>
                <p class="area-instrucao">O produtor rural  do sistema.</p>
            </div>

            <form id="formProdutor" class="form-cadastro" novalidate action="../controllers/cadastro_produtor_controller.php" method="POST">
                <div class="grade-campos">
                    <div class="item-campo">
                        <label for="produtorNome">Nome do produtor</label>
                        <input type="text" id="produtorNome" name="nome" placeholder="Ex: Antônio da Silva" required>
                    </div>

                    <div class="item-campo">
                        <label for="produtorCpf">CPF</label>
                        <input type="text" id="produtorCpf" name="cpf" placeholder="000.000.000-00">
                    </div>

                    <div class="item-campo">
                        <label for="produtorTelefone">Telefone</label>
                        <input type="text" id="produtorTelefone" name="telefone" placeholder="(00) 00000-0000">
                    </div>
                </div>

                <div class="rodape-form">
                    <span class="mensagem-sucesso" id="mensagemProdutor"></span>
                    <button type="submit" class="btn-salvar">Cadastrar produtor</button>
                </div>
            </form>
        </section>

        <!-- ===== CADASTRO DE EMPRESA ===== -->
        <section class="card-cadastro">
            <div class="card-cadastro__cabecalho">
                <h2>Empresa</h2>
                <p class="area-instrucao">Onde as auditorias serão realizadas. Vincule a empresa ao usuário responsável.</p>
            </div>

            <form id="formGranja" class="form-cadastro" novalidate action="../controllers/cadastro_empresa_controller.php" method="POST">
                <div class="grade-campos">
                    <div class="item-campo">
                        <label for="granjaNome">Nome</label>
                        <input type="text" id="granjaNome" name="nome" placeholder="Ex: Granja São João" required>
                    </div>

                    <div class="item-campo">
                        <label for="granjaArea">Área</label>
                        <select id="granjaArea" name="area" required>
                            <option value="">Selecione a área</option>
                            <option value="avicultura">Avicultura</option>
                            <option value="agronomia">Agronomia</option>
                            <option value="incubatorio">Incubatório</option>
                            <option value="abatedouro">Abatedouro</option>
                        </select>
                    </div>

                    <div class="item-campo">
                        <label for="granjaEndereco">Endereço</label>
                        <input type="text" id="granjaEndereco" name="endereco" placeholder="Ex: Linha São José, km 4 - Dois Vizinhos/PR">
                    </div>

                    <div class="item-campo">
                        <label for="granjaUsuario">Vincular ao usuário</label>
                        <select id="granjaUsuario" name="usuario_id" required>
                            <option value="">Selecione o usuário</option>
                            <?php foreach ($usuarios as $u): ?>
                            <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nome']) ?> (<?= htmlspecialchars($u['email']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="rodape-form">
                    <span class="mensagem-sucesso" id="mensagemGranja"></span>
                    <button type="submit" class="btn-salvar">Cadastrar empresa</button>
                </div>
            </form>
        </section>

        <!-- ===== CADASTRO DE GRANJA  ===== -->
        <section class="card-cadastro">
            <div class="card-cadastro__cabecalho">
                <h2>Granja</h2>
                <p class="area-instrucao">Onde as auditorias serão realizadas. Vincule a granja a empresa responsável.</p>
            </div>

            <form id="formGranja" class="form-cadastro" novalidate action="../controllers/cadastro_granja_controller.php" method="POST">
                <div class="grade-campos">
                    <div class="item-campo">
                        <label for="granjaNome">Nome</label>
                        <input type="text" id="granjaNome" name="nome" placeholder="Ex: Granja São João" required>
                    </div>

                    <div class="item-campo">
                        <label for="granjaArea">Área</label>
                        <select id="granjaArea" name="area" required>
                            <option value="">Selecione a área</option>
                            <option value="avicultura">Avicultura</option>
                            <option value="agronomia">Agronomia</option>
                            <option value="incubatorio">Incubatório</option>
                            <option value="abatedouro">Abatedouro</option>
                        </select>
                    </div>

                    <div class="item-campo">
                        <label for="granjaEndereco">Endereço</label>
                        <input type="text" id="granjaEndereco" name="endereco" placeholder="Ex: Linha São José, km 4 - Dois Vizinhos/PR">
                    </div>

                    <div class="item-campo">
                        <label for="granjaProdutor">Produtor vinculado</label>
                        <select id="granjaProdutor" name="produtor_id">
                            <option value="">Nenhum</option>
                            <?php foreach ($produtores as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?> (<?= htmlspecialchars($p['cpf']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="item-campo">
                        <label for="granjaEmpresa">Vincular a empresa</label>
                        <select id="granjaEmpresa" name="empresa_id" required>
                            <option value="">Selecione a empresa</option>
                            <?php foreach ($empresas as $e): ?>
                            <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="rodape-form">
                    <span class="mensagem-sucesso" id="mensagemGranja"></span>
                    <button type="submit" class="btn-salvar">Cadastrar granja</button>
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

    <script src="../../public/js/cadastros.js"></script>
</body>

</html>