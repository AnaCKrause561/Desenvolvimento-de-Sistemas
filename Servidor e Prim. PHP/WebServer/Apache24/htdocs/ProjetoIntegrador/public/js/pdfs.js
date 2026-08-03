// 1) Pega os elementos do filtro (input de busca e os 2 selects)
const campoBusca = document.getElementById("filtro-busca");
const selectArea = document.getElementById("filtro-area");
const selectStatus = document.getElementById("filtro-status");
const botaoLimpar = document.getElementById("btn-limpar-filtro");

// 2) Pega o corpo da tabela e a linha de "nenhum resultado"
const corpoTabela = document.getElementById("tabela-auditorias-corpo");
const linhaSemResultado = document.getElementById("linha-sem-resultado");

// Função que remove acentos, pra "sao joao" encontrar "São João"
function normalizar(texto) {
    return texto
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, ""); // remove os acentos
}

// 3) Função principal: roda toda vez que o usuário digita ou muda um select
function filtrarTabela() {
    const textoBusca = normalizar(campoBusca.value.trim());
    const areaEscolhida = normalizar(selectArea.value);
    const statusEscolhido = normalizar(selectStatus.value);

    // Pega todas as linhas da tabela, EXCETO a linha "sem resultado"
    const linhas = corpoTabela.querySelectorAll("tr:not(#linha-sem-resultado)");

    let algumaLinhaVisivel = false;

    linhas.forEach((linha) => {
        // As colunas da linha, na ordem: ID, Granja, Área, Checklist, Data, Status, Ações
        const colunas = linha.querySelectorAll("td");

        const granja = normalizar(colunas[1].textContent);
        const area = normalizar(colunas[2].textContent);
        const status = normalizar(colunas[5].textContent);

        // Confere as 3 condições: texto digitado, área selecionada, status selecionado
        const bateBusca = textoBusca === "" || granja.includes(textoBusca);
        const bateArea = areaEscolhida === "" || area === areaEscolhida;
        const bateStatus = statusEscolhido === "" || status === statusEscolhido;

        // Só mostra a linha se ela bater nos 3 filtros ao mesmo tempo
        const deveMostrar = bateBusca && bateArea && bateStatus;

        linha.style.display = deveMostrar ? "" : "none";

        if (deveMostrar) {
            algumaLinhaVisivel = true;
        }
    });

    // Mostra o aviso "Nenhuma auditoria encontrada" se nada bateu com o filtro
    linhaSemResultado.style.display = algumaLinhaVisivel ? "none" : "";
}

// 4) "Escuta" os eventos: toda vez que o usuário digita ou troca o select, filtra de novo
campoBusca.addEventListener("input", filtrarTabela);
selectArea.addEventListener("change", filtrarTabela);
selectStatus.addEventListener("change", filtrarTabela);

// 5) Botão de limpar filtros: volta tudo ao normal
botaoLimpar.addEventListener("click", () => {
    campoBusca.value = "";
    selectArea.value = "";
    selectStatus.value = "";
    filtrarTabela();
});