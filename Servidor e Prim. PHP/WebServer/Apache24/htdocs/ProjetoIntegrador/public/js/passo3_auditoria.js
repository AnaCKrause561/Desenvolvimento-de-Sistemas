// =======================================================
// PASSO 3 — SELEÇÃO DE CHECKLIST
// =======================================================

const filtroModelos = document.getElementById("filtroModelos");
const cardsChecklist = document.querySelectorAll(".checklist-card");
const radiosChecklist = document.querySelectorAll('input[name="checklist"]');
const btnProximo = document.querySelector(".btn-proximo");

// --- Filtro por área (select) ---
filtroModelos.addEventListener("change", () => {
    const areaEscolhida = filtroModelos.value;

    cardsChecklist.forEach((card) => {
        const areaDoCard = card.dataset.area; // vem do data-area="..." no HTML

        // o card "Criar novo checklist" (data-area vazio) sempre aparece
        const mostrar = areaEscolhida === "" || areaDoCard === "" || areaDoCard === areaEscolhida;
        card.style.display = mostrar ? "" : "none";
    });
});

// --- Clique no card inteiro marca o radio escondido ---
// (mesmo motivo do passo 2: o <li> não é um <label>)
cardsChecklist.forEach((card) => {
    card.addEventListener("click", () => {
        const radio = card.querySelector('input[type="radio"]');
        radio.checked = true;
        radio.dispatchEvent(new Event("change"));
    });
});

// --- Seleção do card + habilita o botão ---
radiosChecklist.forEach((radio) => {
    radio.addEventListener("change", () => {

        cardsChecklist.forEach((card) => card.classList.remove("selecionado"));
        radio.closest(".checklist-card").classList.add("selecionado");

        btnProximo.disabled = false;
    });
});