// =======================================================
// CADASTRO DE USUÁRIO
// =======================================================
const formUsuario = document.getElementById("formUsuario");
const usuarioAtivo = document.getElementById("usuarioAtivo");
const usuarioAtivoLegenda = document.getElementById("usuarioAtivoLegenda");

// Troca o texto de legenda quando o switch "Usuário ativo" é ligado/desligado
usuarioAtivo.addEventListener("change", () => {
    usuarioAtivoLegenda.textContent = usuarioAtivo.checked
        ? "Poderá acessar o sistema normalmente."
        : "Ficará bloqueado e não conseguirá acessar o sistema.";
});

// Só valida a confirmação de senha no navegador. Se estiver tudo certo,
// o form segue o envio normal (action="app/controllers/cadastro_usuario_controller.php"),
// que já cuida do cadastro e mostra o SweetAlert de sucesso/erro na resposta.
formUsuario.addEventListener("submit", (evento) => {
    const senha = document.getElementById("usuarioSenha").value;
    const confirmaSenha = document.getElementById("usuarioSenhaConfirma").value;

    if (senha !== confirmaSenha) {
        evento.preventDefault();
        alert("As senhas não coincidem. Confira e tente novamente.");
    }
});

// =======================================================
// CADASTRO DE PRODUTOR e CADASTRO DE GRANJA/EMPRESA
// =======================================================
// Nenhuma validação extra por enquanto — os forms enviam direto para
// seus controllers (cadastro_produtor_controller.php e
// cadastro_empresa_controller.php), que respondem com o SweetAlert.