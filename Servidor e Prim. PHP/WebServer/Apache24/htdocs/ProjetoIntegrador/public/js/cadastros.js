// =======================================================
// CADASTRO DE USUÁRIO
// =======================================================
const formUsuario = document.getElementById("formUsuario");
const usuarioAtivo = document.getElementById("usuarioAtivo");
const usuarioAtivoLegenda = document.getElementById("usuarioAtivoLegenda");
const mensagemUsuario = document.getElementById("mensagemUsuario");

// Troca o texto de legenda quando o switch "Usuário ativo" é ligado/desligado
usuarioAtivo.addEventListener("change", () => {
    usuarioAtivoLegenda.textContent = usuarioAtivo.checked
        ? "Poderá acessar o sistema normalmente."
        : "Ficará bloqueado e não conseguirá acessar o sistema.";
});

formUsuario.addEventListener("submit", (evento) => {
    evento.preventDefault();

    const senha = document.getElementById("usuarioSenha").value;
    const confirmaSenha = document.getElementById("usuarioSenhaConfirma").value;

    if (senha !== confirmaSenha) {
        alert("As senhas não coincidem. Confira e tente novamente.");
        return;
    }

    // Pega todas as áreas marcadas nos checkboxes
    const areasMarcadas = Array.from(
        document.querySelectorAll('input[name="usuarioAreas"]:checked')
    ).map((campo) => campo.value);

    // A foto vem como arquivo (File), não como texto — aqui pegamos só a referência.
    // Quando o PHP entrar, o envio real precisa ser feito via FormData (multipart/form-data).
    const arquivoFoto = document.getElementById("usuarioFoto").files[0] || null;

    const dados = {
        nome: document.getElementById("usuarioNome").value.trim(),
        login: document.getElementById("usuarioLogin").value.trim(),
        email: document.getElementById("usuarioEmail").value.trim(),
        cargo: document.getElementById("usuarioCargo").value.trim(),
        nivelAcesso: document.getElementById("usuarioNivelAcesso").value,
        foto: arquivoFoto ? arquivoFoto.name : null,
        areas: areasMarcadas,
        ativo: usuarioAtivo.checked,
    };

    // OBS: aqui é onde entrará o envio (fetch/AJAX) pro PHP salvar no banco.
    console.log("Usuário cadastrado (exemplo, ainda sem PHP):", dados);

    mostrarMensagem(mensagemUsuario, "✓ Usuário cadastrado com sucesso!");
    formUsuario.reset();
    usuarioAtivo.checked = true;
    usuarioAtivoLegenda.textContent = "Poderá acessar o sistema normalmente.";
});

// =======================================================
// CADASTRO DE PRODUTOR
// =======================================================
const formProdutor = document.getElementById("formProdutor");
const mensagemProdutor = document.getElementById("mensagemProdutor");

formProdutor.addEventListener("submit", (evento) => {
    evento.preventDefault();

    const dados = {
        nome: document.getElementById("produtorNome").value.trim(),
        cpf: document.getElementById("produtorCpf").value.trim(),
        telefone: document.getElementById("produtorTelefone").value.trim(),
        usuarioId: document.getElementById("produtorUsuario").value,
    };

    console.log("Produtor cadastrado (exemplo, ainda sem PHP):", dados);

    mostrarMensagem(mensagemProdutor, "✓ Produtor cadastrado com sucesso!");
    formProdutor.reset();
});

// =======================================================
// CADASTRO DE GRANJA / EMPRESA
// =======================================================
const formGranja = document.getElementById("formGranja");
const mensagemGranja = document.getElementById("mensagemGranja");

formGranja.addEventListener("submit", (evento) => {
    evento.preventDefault();

    const dados = {
        nome: document.getElementById("granjaNome").value.trim(),
        tipo: document.getElementById("granjaTipo").value,
        area: document.getElementById("granjaArea").value,
        endereco: document.getElementById("granjaEndereco").value.trim(),
        produtorId: document.getElementById("granjaProdutor").value,
        usuarioId: document.getElementById("granjaUsuario").value,
    };

    console.log("Granja/Empresa cadastrada (exemplo, ainda sem PHP):", dados);

    mostrarMensagem(mensagemGranja, "✓ Granja/Empresa cadastrada com sucesso!");
    formGranja.reset();
});

// =======================================================
// FUNÇÃO AUXILIAR — mostra a mensagem de sucesso e some sozinha
// =======================================================
function mostrarMensagem(elemento, texto) {
    elemento.textContent = texto;
    elemento.classList.add("visivel");

    setTimeout(() => {
        elemento.classList.remove("visivel");
    }, 3000);
}