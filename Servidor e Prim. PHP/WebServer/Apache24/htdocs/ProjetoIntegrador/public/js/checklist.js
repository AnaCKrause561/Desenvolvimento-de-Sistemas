// =======================================================
// 1) ELEMENTOS DO FORMULÁRIO (modal criar/editar)
// =======================================================
const nomeChecklist = document.getElementById("nomeChecklist");
const areaChecklist = document.getElementById("areaChecklist");
const listaPerguntas = document.getElementById("listaPerguntas");
const btnAddPergunta = document.getElementById("btnAddPergunta");
const templatePergunta = document.getElementById("templatePergunta");
const btnSalvarChecklist = document.getElementById("btnSalvarChecklist");
const textoBtnSalvar = document.getElementById("textoBtnSalvar");

// =======================================================
// 2) ELEMENTOS DOS MODAIS E DA TABELA
// =======================================================
const modalOverlay = document.getElementById("modalOverlay");

const modalChecklist = document.getElementById("modalChecklist");
const modalChecklistTitulo = document.getElementById("modalChecklistTitulo");
const modalChecklistInstrucao = document.getElementById("modalChecklistInstrucao");
const btnCriarChecklist = document.getElementById("btnCriarChecklist");
const fecharModalChecklist = document.getElementById("fecharModalChecklist");

const modalVisualizar = document.getElementById("modalVisualizar");
const conteudoVisualizar = document.getElementById("conteudoVisualizar");
const fecharModalVisualizar = document.getElementById("fecharModalVisualizar");
const btnImprimirPdf = document.getElementById("btnImprimirPdf");

const tabelaCorpo = document.getElementById("tabela-auditorias-corpo");

// Guarda o ID da linha que está sendo editada no momento (null = criando um novo)
let idEmEdicao = null;

// Conta quantas perguntas já foram adicionadas no modal, só pra numerar os itens
let totalPerguntas = 0;

// =======================================================
// 3) MONTAR / LIMPAR A LISTA DE PERGUNTAS DO MODAL
// =======================================================

// Cria uma nova pergunta a partir do <template> e insere na lista.
// "texto" é opcional: quando vem preenchido (modo editar), já entra com o valor.
function adicionarPergunta(texto = "") {
    totalPerguntas++;

    const novoItem = templatePergunta.content.cloneNode(true);
    novoItem.querySelector(".item-numero").textContent = totalPerguntas;

    const campoPergunta = novoItem.querySelector(".item-pergunta");
    campoPergunta.value = texto;

    listaPerguntas.appendChild(novoItem);
    atualizarBotaoSalvar();
}

// Remove uma pergunta e renumera as que sobraram
function removerPergunta(botaoRemover) {
    const item = botaoRemover.closest(".item-auditoria");
    item.remove();

    renumerarPerguntas();
    atualizarBotaoSalvar();
}

// Depois de remover um item, atualiza os números 1, 2, 3... na tela
function renumerarPerguntas() {
    const itens = listaPerguntas.querySelectorAll(".item-auditoria");
    totalPerguntas = itens.length;

    itens.forEach((item, indice) => {
        item.querySelector(".item-numero").textContent = indice + 1;
    });
}

// Esvazia o formulário do modal (nome, área e perguntas)
function limparFormularioChecklist() {
    nomeChecklist.value = "";
    areaChecklist.value = "";
    listaPerguntas.innerHTML = "";
    totalPerguntas = 0;
}

// =======================================================
// 4) VALIDAÇÃO DO BOTÃO "SALVAR"
// =======================================================
function checklistValido() {
    const temNome = nomeChecklist.value.trim() !== "";
    const temArea = areaChecklist.value !== "";

    const perguntas = listaPerguntas.querySelectorAll(".item-pergunta");
    const temAoMenosUmaPergunta = perguntas.length > 0;

    const todasPreenchidas = Array.from(perguntas).every(
        (campo) => campo.value.trim() !== ""
    );

    return temNome && temArea && temAoMenosUmaPergunta && todasPreenchidas;
}

function atualizarBotaoSalvar() {
    btnSalvarChecklist.disabled = !checklistValido();
}

// =======================================================
// 5) ABRIR / FECHAR MODAL "CRIAR / EDITAR CHECKLIST"
// =======================================================

// modo: "criar" ou "editar" | linha: a <tr> clicada (só existe no modo editar)
function abrirModalChecklist(modo, linha = null) {
    limparFormularioChecklist();

    if (modo === "editar" && linha) {
        idEmEdicao = linha.dataset.id;

        modalChecklistTitulo.textContent = "Editar checklist";
        modalChecklistInstrucao.textContent = "Altere o nome, a área ou as perguntas deste checklist.";
        textoBtnSalvar.textContent = "Salvar alterações";

        nomeChecklist.value = linha.dataset.nome;
        areaChecklist.value = linha.dataset.area;

        const perguntas = JSON.parse(linha.dataset.perguntas || "[]");
        perguntas.forEach((pergunta) => adicionarPergunta(pergunta));
    } else {
        idEmEdicao = null;

        modalChecklistTitulo.textContent = "Criar novo checklist";
        modalChecklistInstrucao.textContent = "Dê um nome ao checklist, escolha a área e adicione as perguntas.";
        textoBtnSalvar.textContent = "Salvar checklist";

        // já começa com uma pergunta em branco, pra facilitar
        adicionarPergunta();
    }

    atualizarBotaoSalvar();
    abrirModal(modalChecklist);
}

function fecharModalChecklistFn() {
    fecharModal(modalChecklist);
    limparFormularioChecklist();
    idEmEdicao = null;
}

// =======================================================
// 6) SALVAR (criar ou editar) — hoje só visual
// =======================================================
// OBS: a página ainda está na fase estática. Quando a parte de PHP entrar,
// aqui é o lugar de enviar os dados (fetch/AJAX) para salvar no banco.
function salvarChecklist() {
    if (!checklistValido()) return;

    const dados = {
        id: idEmEdicao,
        nome: nomeChecklist.value.trim(),
        area: areaChecklist.value,
        perguntas: Array.from(listaPerguntas.querySelectorAll(".item-pergunta")).map(
            (campo) => campo.value.trim()
        ),
    };

    console.log("Checklist salvo (exemplo, ainda sem PHP):", dados);

    fecharModalChecklistFn();
}

// =======================================================
// 7) ABRIR / FECHAR MODAL "VISUALIZAR" (estilo PDF)
// =======================================================
function abrirModalVisualizar(linha) {
    const nome = linha.dataset.nome;
    const empresa = linha.dataset.empresa;
    const areaLabel = linha.dataset.areaLabel;
    const data = linha.dataset.data;
    const perguntas = JSON.parse(linha.dataset.perguntas || "[]");

    const listaHtml = perguntas
        .map((pergunta) => `<li>${pergunta}</li>`)
        .join("");

    conteudoVisualizar.innerHTML = `
        <div class="folha-pdf__cabecalho">
            <div>
                <h3>${nome}</h3>
                <p>${empresa}</p>
                <p>Área: ${areaLabel}</p>
            </div>
            <span class="folha-pdf__selo">Data: ${data}</span>
        </div>
        <ul class="folha-pdf__perguntas">
            ${listaHtml}
        </ul>
    `;

    abrirModal(modalVisualizar);
}

function fecharModalVisualizarFn() {
    fecharModal(modalVisualizar);
    conteudoVisualizar.innerHTML = "";
}

// =======================================================
// 8) FUNÇÕES GENÉRICAS DE MODAL (overlay + travar scroll)
// =======================================================
function abrirModal(modal) {
    modal.classList.add("aberto");
    modalOverlay.classList.add("ativo");
    document.body.classList.add("sem-scroll");
}

function fecharModal(modal) {
    modal.classList.remove("aberto");
    modalOverlay.classList.remove("ativo");
    document.body.classList.remove("sem-scroll");
}

function fecharTodosOsModais() {
    fecharModalChecklistFn();
    fecharModalVisualizarFn();
}

// =======================================================
// 9) EVENTOS
// =======================================================

// Botão "Criar novo checklist" (no filtro)
btnCriarChecklist.addEventListener("click", () => abrirModalChecklist("criar"));

// Fechar modal de criar/editar (botão "✕" e clique no overlay)
fecharModalChecklist.addEventListener("click", fecharModalChecklistFn);
fecharModalVisualizar.addEventListener("click", fecharModalVisualizarFn);
modalOverlay.addEventListener("click", fecharTodosOsModais);

// Nome e área do checklist: revalida sempre que o usuário digita/escolhe
nomeChecklist.addEventListener("input", atualizarBotaoSalvar);
areaChecklist.addEventListener("change", atualizarBotaoSalvar);

// Botão "+ Adicionar pergunta"
btnAddPergunta.addEventListener("click", () => adicionarPergunta());

// Cliques dentro da lista de perguntas (delegação de evento)
listaPerguntas.addEventListener("click", (evento) => {
    if (evento.target.classList.contains("item-remover")) {
        removerPergunta(evento.target);
    }
});

// Digitar em qualquer pergunta também revalida o botão
listaPerguntas.addEventListener("input", (evento) => {
    if (evento.target.classList.contains("item-pergunta")) {
        atualizarBotaoSalvar();
    }
});

// Botão "Salvar checklist" / "Salvar alterações"
btnSalvarChecklist.addEventListener("click", salvarChecklist);

// Ícones da tabela (Visualizar / Editar) — delegação de evento na tbody,
// assim funciona também para linhas que forem adicionadas depois via PHP/JS
tabelaCorpo.addEventListener("click", (evento) => {
    const botao = evento.target.closest(".btn-icone");
    if (!botao) return;

    evento.preventDefault(); // os ícones são <a href="#">, então evita rolar a página pro topo

    const linha = botao.closest("tr");

    if (botao.classList.contains("btn-visualizar")) {
        abrirModalVisualizar(linha);
    } else if (botao.classList.contains("btn-editar")) {
        abrirModalChecklist("editar", linha);
    }
    // "btn-excluir" fica de fora por enquanto — pode ganhar um modal de confirmação depois
});

// Fechar modais com a tecla ESC
document.addEventListener("keydown", (evento) => {
    if (evento.key === "Escape") {
        fecharTodosOsModais();
    }
});

// Botão "Baixar / Imprimir PDF" dentro do modal de visualização
btnImprimirPdf.addEventListener("click", () => {
    window.print();
});