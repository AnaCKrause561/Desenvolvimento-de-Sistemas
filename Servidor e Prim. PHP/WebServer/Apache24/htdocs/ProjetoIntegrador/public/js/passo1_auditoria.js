// =======================================================
// PASSO 1 — SELEÇÃO DE ÁREA
// =======================================================

// Pega todos os radios de área e o botão "Próximo"
const radiosArea = document.querySelectorAll('input[name="area"]');
const btnProximo = document.querySelector('.btn-proximo');

// Toda vez que o usuário escolher uma área...
radiosArea.forEach((radio) => {
    radio.addEventListener("change", () => {

        // Tira a classe "selecionado" de todos os cards
        document.querySelectorAll('.area-card').forEach((card) => {
            card.classList.remove("selecionado");
        });

        // Coloca a classe "selecionado" só no card do radio marcado
        // (o card é o elemento pai <label> que envolve o input)
        radio.closest('.area-card').classList.add("selecionado");

        // Habilita o botão "Próximo"
        btnProximo.disabled = false;
    });
});