// =======================================================
// PASSO 1 — SELEÇÃO DE ÁREA
// =======================================================

// Pega todos os radios de área e o botão "Próximo"
const radiosArea = document.querySelectorAll('input[name="area"]');
const btnProximo = document.querySelector('.btn-proximo');

// Toda vez que o usuário escolher uma área, habilita o botão
radiosArea.forEach((radio) => {
    radio.addEventListener("change", () => {
        btnProximo.disabled = false;
    });
});

