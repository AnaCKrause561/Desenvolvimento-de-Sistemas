// 1) Elementos principais da página
const nomeChecklist = document.getElementById("nomeChecklist");
const areaChecklist = document.getElementById("areaChecklist");
const listaPerguntas = document.getElementById("listaPerguntas");
const btnAddPergunta = document.getElementById("btnAddPergunta");
const templatePergunta = document.getElementById("templatePergunta");
const btnSalvarChecklist = document.getElementById("btnSalvarChecklist");

// Conta quantas perguntas já foram adicionadas, só pra numerar os itens
let totalPerguntas = 0;

// 2) Cria uma nova pergunta a partir do <template> e insere na lista
function adicionarPergunta() {
    totalPerguntas++;

    // .content.cloneNode(true) copia todo o HTML de dentro do <template>
    const novoItem = templatePergunta.content.cloneNode(true);

    // Preenche o número do item (bolinha verde com o número)
    novoItem.querySelector(".item-numero").textContent = totalPerguntas;

    listaPerguntas.appendChild(novoItem);
    atualizarBotaoSalvar();
}

// 3) Remove uma pergunta e renumera as que sobraram
function removerPergunta(botaoRemover) {
    // .closest(".item-auditoria") acha o <li> pai do botão que foi clicado
    const item = botaoRemover.closest(".item-auditoria");
    item.remove();

    renumerarPerguntas();
    atualizarBotaoSalvar();
}

// 4) Depois de remover um item, atualiza os números 1, 2, 3... na tela
function renumerarPerguntas() {
    const itens = listaPerguntas.querySelectorAll(".item-auditoria");
    totalPerguntas = itens.length;

    itens.forEach((item, indice) => {
        item.querySelector(".item-numero").textContent = indice + 1;
    });
}

// 5) Confere se dá pra liberar o botão "Salvar checklist"
function checklistValido() {
    const temNome = nomeChecklist.value.trim() !== "";
    const temArea = areaChecklist.value !== "";

    // Pega o texto de CADA pergunta digitada na tela
    const perguntas = listaPerguntas.querySelectorAll(".item-pergunta");
    const temAoMenosUmaPergunta = perguntas.length > 0;

    // Todas as perguntas precisam estar preenchidas (nenhuma vazia)
    const todasPreenchidas = Array.from(perguntas).every(
        (campo) => campo.value.trim() !== ""
    );

    return temNome && temArea && temAoMenosUmaPergunta && todasPreenchidas;
}

// 6) Habilita ou desabilita o botão de salvar de acordo com a validação
function atualizarBotaoSalvar() {
    btnSalvarChecklist.disabled = !checklistValido();
}

// 7) Eventos

// Clique no "+ Adicionar pergunta"
btnAddPergunta.addEventListener("click", adicionarPergunta);

// Nome e área do checklist: revalida sempre que o usuário digita/escolhe
nomeChecklist.addEventListener("input", atualizarBotaoSalvar);
areaChecklist.addEventListener("change", atualizarBotaoSalvar);

// Cliques dentro da lista de perguntas (delegação de evento):
// como as perguntas são criadas dinamicamente, escutamos o "pai" (listaPerguntas)
// em vez de cada pergunta individualmente.
listaPerguntas.addEventListener("click", (evento) => {
    if (evento.target.classList.contains("item-remover")) {
        removerPergunta(evento.target);
    }
});

// Digitar em qualquer pergunta também revalida o botão (mesma ideia de delegação)
listaPerguntas.addEventListener("input", (evento) => {
    if (evento.target.classList.contains("item-pergunta")) {
        atualizarBotaoSalvar();
    }
});

// 8) Começa a página já com uma pergunta pronta pra preencher
adicionarPergunta();