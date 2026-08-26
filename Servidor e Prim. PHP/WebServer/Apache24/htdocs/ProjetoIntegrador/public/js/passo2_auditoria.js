// =======================================================
// PASSO 2 — SELEÇÃO DE GRANJA / EMPRESA
// =======================================================

const inputBusca = document.getElementById("buscaGranja");
const cards = document.querySelectorAll(".granja-card");
const radiosGranja = document.querySelectorAll('input[name="granja"]');
const btnProximo = document.querySelector(".btn-proximo");

// --- Busca por texto (filtra a lista enquanto digita) ---
inputBusca.addEventListener("input", () => {
    const termo = inputBusca.value.toLowerCase();

    cards.forEach((card) => {
        // pega o texto do nome (dentro de <strong>) pra comparar
        const nome = card.querySelector(".granja-info strong").textContent.toLowerCase();

        // mostra o card se o nome contém o termo digitado, esconde se não
        card.style.display = nome.includes(termo) ? "" : "none";
    });
});

// --- Clique no card inteiro marca o radio escondido ---
// (o <li> não é um <label>, então clicar nele não marca o input
// sozinho; precisamos fazer isso manualmente aqui)
cards.forEach((card) => {
    card.addEventListener("click", () => {
        const radio = card.querySelector('input[type="radio"]');
        radio.checked = true;

        // dispara o evento "change" manualmente, pra rodar o código abaixo
        radio.dispatchEvent(new Event("change"));
    });
});

// --- Seleção do card (igual ao passo 1) ---
radiosGranja.forEach((radio) => {
    radio.addEventListener("change", () => {

        // tira "selecionado" de todos os cards
        cards.forEach((card) => card.classList.remove("selecionado"));

        // marca só o card escolhido
        radio.closest(".granja-card").classList.add("selecionado");

        // habilita o botão Próximo
        btnProximo.disabled = false;
    });
});