// Pega os elementos principais da página
const lista = document.getElementById("listaItens");
const template = document.getElementById("templateItem");
const btnAdicionar = document.getElementById("btnAddItem");
const btnProximo = document.querySelector(".btn-proximo");

// Cria um item novo (vazio, ou já com uma pergunta pronta vinda do checklist)
function criarItem(perguntaTexto = "") {
    const clone = template.content.cloneNode(true);
    const li = clone.querySelector(".item-auditoria");

    const campoPergunta = li.querySelector(".item-pergunta");
    campoPergunta.value = perguntaTexto;

    li.querySelector(".item-remover").addEventListener("click", () => {
        li.remove();
        atualizarNumeracao();
    });

    const inputFoto = li.querySelector(".item-foto");
    const preview = li.querySelector(".item-foto-preview");

    inputFoto.addEventListener("change", () => {
        const arquivo = inputFoto.files[0];

        if (!arquivo) {
            preview.innerHTML = "";
            return;
        }

        const leitor = new FileReader();
        leitor.onload = (e) => {
            preview.innerHTML = `
                <div class="foto-anexada">
                    <img src="${e.target.result}" alt="Prévia da foto anexada">
                    <span>${arquivo.name}</span>
                    <button type="button" class="foto-remover" aria-label="Remover foto">✕</button>
                </div>
            `;

            // NOVO: clique no ✕ limpa o input e some com a prévia
            preview.querySelector(".foto-remover").addEventListener("click", () => {
                inputFoto.value = "";
                preview.innerHTML = "";
            });
        };
        leitor.readAsDataURL(arquivo);
    });

    lista.appendChild(li);
    atualizarNumeracao();
}

// Renumera os itens e libera/trava o botão "Próximo"
function atualizarNumeracao() {
    const itens = lista.querySelectorAll(".item-auditoria");

    itens.forEach((item, index) => {
        item.querySelector(".item-numero").textContent = index + 1;
    });

    btnProximo.disabled = itens.length === 0;
}

btnAdicionar.addEventListener("click", () => criarItem());

// Ao carregar a página
if (itensPreCarregados.length > 0) {
    // Rota B: já veio um checklist pronto — popula com as perguntas dele
    itensPreCarregados.forEach(item => criarItem(item.pergunta));
} else {
    // Rota A: começa com um item em branco pra facilitar
    criarItem();
}

function atualizarNumeracao() {
    const itens = lista.querySelectorAll(".item-auditoria");

    itens.forEach((item, index) => {
        item.querySelector(".item-numero").textContent = index + 1;

        // dá o "crachá" (name) certo pra cada campo, com o índice atual
        item.querySelector(".item-pergunta").name = `itens[${index}][pergunta]`;
        item.querySelector(".item-pontuacao").name = `itens[${index}][pontuacao]`;
        item.querySelector(".item-observacao").name = `itens[${index}][observacao]`;
        item.querySelector(".item-foto").name = `itens[${index}][foto]`;
    });

    btnProximo.disabled = itens.length === 0;
}