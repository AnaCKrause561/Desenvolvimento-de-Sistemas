// DADOS DO USUÁRIO LOGADO

//   const resposta = await fetch("../../public/php/perfil_dados.php");
//   const dadosUsuarioLogado = await resposta.json();
//
const dadosUsuarioLogado = {
    nome: "João Pedro Alves",
    login: "joao.alves",
    email: "joao@fazenda.com",
    cargo: "Auditor de campo",
    nivelAcesso: "auditor",
    foto: "../../public/img/perfil.jpeg",
    areas: ["avicultura", "incubatorio"],
    ativo: true,
};

// =======================================================
// ELEMENTOS
// =======================================================
const formPerfil = document.getElementById("formPerfil");
const previewFoto = document.getElementById("previewFoto");
const perfilFoto = document.getElementById("perfilFoto");
const perfilAtivo = document.getElementById("perfilAtivo");
const perfilAtivoLegenda = document.getElementById("perfilAtivoLegenda");
const mensagemPerfil = document.getElementById("mensagemPerfil");

// =======================================================
// PREENCHE O FORMULÁRIO COM OS DADOS DO USUÁRIO (ao carregar a página)
// =======================================================
function carregarPerfil(dados) {
    document.getElementById("perfilNome").value = dados.nome;
    document.getElementById("perfilLogin").value = dados.login;
    document.getElementById("perfilEmail").value = dados.email;
    document.getElementById("perfilCargo").value = dados.cargo;
    document.getElementById("perfilNivelAcesso").value = dados.nivelAcesso;

    previewFoto.src = dados.foto;

    // Marca os checkboxes de área que já pertencem ao usuário
    document.querySelectorAll('input[name="perfilAreas"]').forEach((campo) => {
        campo.checked = dados.areas.includes(campo.value);
    });

    perfilAtivo.checked = dados.ativo;
    atualizarLegendaAtivo();
}

carregarPerfil(dadosUsuarioLogado);

// =======================================================
// TROCAR FOTO (com pré-visualização)
// =======================================================
perfilFoto.addEventListener("change", () => {
    const arquivo = perfilFoto.files[0];
    if (!arquivo) return;

    // Gera uma prévia local da imagem escolhida, sem precisar subir pro servidor ainda
    const url = URL.createObjectURL(arquivo);
    previewFoto.src = url;
});

// =======================================================
// SWITCH "USUÁRIO ATIVO"
// =======================================================
function atualizarLegendaAtivo() {
    perfilAtivoLegenda.textContent = perfilAtivo.checked
        ? "Poderá acessar o sistema normalmente."
        : "Ficará bloqueado e não conseguirá acessar o sistema.";
}

perfilAtivo.addEventListener("change", atualizarLegendaAtivo);

// =======================================================
// SALVAR ALTERAÇÕES
// =======================================================
formPerfil.addEventListener("submit", (evento) => {
    evento.preventDefault();

    const senha = document.getElementById("perfilSenha").value;
    const confirmaSenha = document.getElementById("perfilSenhaConfirma").value;

    if (senha !== "" && senha !== confirmaSenha) {
        alert("As senhas não coincidem. Confira e tente novamente.");
        return;
    }

    const areasMarcadas = Array.from(
        document.querySelectorAll('input[name="perfilAreas"]:checked')
    ).map((campo) => campo.value);

    const arquivoFoto = perfilFoto.files[0] || null;

    const dadosAtualizados = {
        nome: document.getElementById("perfilNome").value.trim(),
        login: document.getElementById("perfilLogin").value.trim(),
        email: document.getElementById("perfilEmail").value.trim(),
        cargo: document.getElementById("perfilCargo").value.trim(),
        nivelAcesso: document.getElementById("perfilNivelAcesso").value,
        // senha só entra no envio se o campo foi preenchido
        senha: senha !== "" ? senha : undefined,
        foto: arquivoFoto ? arquivoFoto.name : dadosUsuarioLogado.foto,
        areas: areasMarcadas,
        ativo: perfilAtivo.checked,
    };

    // OBS: aqui é onde entrará o envio (fetch/AJAX, com FormData por causa da
    // foto) pro PHP salvar as alterações no banco.
    console.log("Perfil atualizado (exemplo, ainda sem PHP):", dadosAtualizados);

    mostrarMensagem(mensagemPerfil, "✓ Alterações salvas com sucesso!");
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