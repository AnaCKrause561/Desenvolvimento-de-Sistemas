// =======================================================
// ELEMENTOS
// Obs: os dados do usuário já vêm preenchidos pelo PHP direto no HTML
// (perfil.php), então este arquivo só cuida de comportamento (preview de
// foto, legenda do switch e validação da senha antes de enviar).
// =======================================================
const formPerfil = document.getElementById("formPerfil");
const previewFoto = document.getElementById("previewFoto");
const perfilFoto = document.getElementById("perfilFoto");
const perfilAtivo = document.getElementById("perfilAtivo");
const perfilAtivoLegenda = document.getElementById("perfilAtivoLegenda");
const mensagemPerfil = document.getElementById("mensagemPerfil");
const perfilSenha = document.getElementById("perfilSenha");
const perfilSenhaConfirma = document.getElementById("perfilSenhaConfirma");

// =======================================================
// TROCAR FOTO (com validação + pré-visualização)
// Obs: essa validação é só pra dar feedback rápido ao usuário.
// A validação que realmente protege o sistema é a do PHP (User.php),
// porque validação só no JS pode ser burlada.
// =======================================================
const TAMANHO_MAXIMO_FOTO = 5 * 1024 * 1024; // 5MB
const TIPOS_PERMITIDOS_FOTO = ["image/jpeg", "image/png"];

perfilFoto.addEventListener("change", () => {
    const arquivo = perfilFoto.files[0];
    if (!arquivo) return;

    if (!TIPOS_PERMITIDOS_FOTO.includes(arquivo.type)) {
        alert("Envie apenas imagens JPG ou PNG.");
        perfilFoto.value = "";
        return;
    }

    if (arquivo.size > TAMANHO_MAXIMO_FOTO) {
        alert("A imagem deve ter no máximo 5MB.");
        perfilFoto.value = "";
        return;
    }

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
// Só bloqueia o envio se a nova senha e a confirmação não baterem.
// Caso contrário, deixa o form seguir o envio normal (POST real para o
// perfil_controller.php, já com enctype multipart por causa da foto).
// =======================================================
formPerfil.addEventListener("submit", (evento) => {
    const senha = perfilSenha.value;
    const confirmaSenha = perfilSenhaConfirma.value;

    if (senha !== "" && senha !== confirmaSenha) {
        evento.preventDefault();
        alert("As senhas não coincidem. Confira e tente novamente.");
        return;
    }
});

// =======================================================
// FUNÇÃO AUXILIAR — mostra a mensagem de sucesso e some sozinha
// (mantida para uso futuro, ex. em envios via fetch/AJAX)
// =======================================================
function mostrarMensagem(elemento, texto) {
    elemento.textContent = texto;
    elemento.classList.add("visivel");

    setTimeout(() => {
        elemento.classList.remove("visivel");
    }, 3000);
}