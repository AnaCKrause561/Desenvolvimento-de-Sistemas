// ---- Elementos do menu mobile ----
const botao = document.querySelector(".menu-mobile");
const sidebar = document.querySelector(".sidebar");
const overlay = document.querySelector(".overlay");

botao.addEventListener("click", () => {
    sidebar.classList.toggle("abrir");
    overlay.classList.toggle("ativo");
    document.body.classList.toggle("sem-scroll");
});

overlay.addEventListener("click", () => {
    sidebar.classList.remove("abrir");
    overlay.classList.remove("ativo");
    document.body.classList.remove("sem-scroll");
});

// ---- Seleção da área da auditoria (Passo 1) ----
const cartoesArea = document.querySelectorAll(".area-card");
const botaoProximo = document.querySelector(".btn-proximo");

if (cartoesArea.length > 0) {
    cartoesArea.forEach((cartao) => {
        const input = cartao.querySelector("input[type='radio']");

        cartao.addEventListener("click", () => {
            cartoesArea.forEach((c) => c.classList.remove("selecionado"));
            cartao.classList.add("selecionado");
            input.checked = true;
            botaoProximo.disabled = false;
        });
    });
}

botaoProximo.addEventListener("click", () => {
    if (botaoProximo.disabled) return;
    const areaSelecionada = document.querySelector("input[name='area']:checked")?.value;
    console.log("Área selecionada:", areaSelecionada);
});

// ---- Seleção de granja/empresa (Passo 2) ----
const cartoesGranja = document.querySelectorAll(".granja-card");

if (cartoesGranja.length > 0) {
    cartoesGranja.forEach((cartao) => {
        const input = cartao.querySelector("input[type='radio']");

        cartao.addEventListener("click", () => {
            cartoesGranja.forEach((c) => c.classList.remove("selecionado"));
            cartao.classList.add("selecionado");
            input.checked = true;
            botaoProximo.disabled = false;
        });
    });

    const inputBusca = document.querySelector("#buscaGranja");

    inputBusca.addEventListener("input", () => {
        const termo = inputBusca.value.toLowerCase();

        cartoesGranja.forEach((cartao) => {
            const nome = cartao.querySelector(".granja-info strong").textContent.toLowerCase();
            cartao.style.display = nome.includes(termo) ? "flex" : "none";
        });
    });
}

// ---- Seleção de checklist (Passo 3) ----
const cartoesChecklist = document.querySelectorAll(".checklist-card");

if (cartoesChecklist.length > 0) {
    cartoesChecklist.forEach((cartao) => {
        const input = cartao.querySelector("input[type='radio']");

        cartao.addEventListener("click", () => {
            cartoesChecklist.forEach((c) => c.classList.remove("selecionado"));
            cartao.classList.add("selecionado");
            input.checked = true;
            botaoProximo.disabled = false;
        });
    });

    // Filtro pelo dropdown de modelos (opcional, mesma lógica de busca por texto)
    const filtroModelos = document.querySelector("#filtroModelos");

    if (filtroModelos) {
        filtroModelos.addEventListener("change", () => {
            const categoria = filtroModelos.value.toLowerCase();

            cartoesChecklist.forEach((cartao) => {
                if (cartao.classList.contains("checklist-card--novo")) return; // sempre mostra o "criar novo"
                const nome = cartao.querySelector(".checklist-nome").textContent.toLowerCase();
                cartao.style.display = (!categoria || nome.includes(categoria)) ? "flex" : "none";
            });
        });
    }
}

// ---- Criação dinâmica de itens da auditoria (Passo 4) ----
const listaItens = document.querySelector("#listaItens");
const btnAddItem = document.querySelector("#btnAddItem");
const templateItem = document.querySelector("#templateItem");

if (listaItens && btnAddItem && templateItem) {

    function atualizarNumeracao() {
        const itens = listaItens.querySelectorAll(".item-auditoria");
        itens.forEach((item, index) => {
            item.querySelector(".item-numero").textContent = index + 1;
        });
        // Libera "Próximo" só se tiver pelo menos 1 item na lista
        botaoProximo.disabled = itens.length === 0;
    }

    function criarItem() {
        const clone = templateItem.content.cloneNode(true);
        const li = clone.querySelector(".item-auditoria");

        // Botão de remover
        li.querySelector(".item-remover").addEventListener("click", () => {
            li.remove();
            atualizarNumeracao();
        });

        // Preview da foto anexada
        const inputFoto = li.querySelector(".item-foto");
        const previewContainer = li.querySelector(".item-foto-preview");

        inputFoto.addEventListener("change", () => {
            previewContainer.innerHTML = ""; // limpa preview anterior
            const arquivo = inputFoto.files[0];
            if (arquivo) {
                const img = document.createElement("img");
                img.src = URL.createObjectURL(arquivo);
                previewContainer.appendChild(img);
            }
        });

        listaItens.appendChild(li);
        atualizarNumeracao();
    }

    btnAddItem.addEventListener("click", criarItem);

    // Começa a página já com 1 item pronto pra preencher
    criarItem();
}

// ---- Assinatura digital (Passo 6) ----
const canvasAssinaturas = document.querySelectorAll(".assinatura-canvas");

if (canvasAssinaturas.length > 0) {

    const estadoAssinaturas = {}; // guarda se cada canvas tem traço ou não

    function verificarAssinaturasCompletas() {
        const todasAssinadas = Array.from(canvasAssinaturas)
            .every((canvas) => estadoAssinaturas[canvas.id]);
        botaoProximo.disabled = !todasAssinadas;
    }

    canvasAssinaturas.forEach((canvas) => {
        const ctx = canvas.getContext("2d");
        let desenhando = false;
        let ultimoX = 0;
        let ultimoY = 0;

        estadoAssinaturas[canvas.id] = false;

        // Ajusta o canvas pra resolução da tela (fica nítido em qualquer dispositivo)
        function ajustarCanvas() {
            const proporcao = window.devicePixelRatio || 1;
            const retangulo = canvas.getBoundingClientRect();

            canvas.width = retangulo.width * proporcao;
            canvas.height = retangulo.height * proporcao;

            ctx.scale(proporcao, proporcao);
            ctx.lineWidth = 2.2;
            ctx.lineCap = "round";
            ctx.lineJoin = "round";
            ctx.strokeStyle = "#10281d";
        }

        ajustarCanvas();
        window.addEventListener("resize", ajustarCanvas);

        // Pega a posição do dedo/mouse/caneta relativa ao canvas
        function posicaoRelativa(evento) {
            const retangulo = canvas.getBoundingClientRect();
            const ponto = evento.touches ? evento.touches[0] : evento;

            return {
                x: ponto.clientX - retangulo.left,
                y: ponto.clientY - retangulo.top
            };
        }

        function iniciarTraco(evento) {
            evento.preventDefault();
            desenhando = true;
            const { x, y } = posicaoRelativa(evento);
            ultimoX = x;
            ultimoY = y;
        }

        function desenharTraco(evento) {
            if (!desenhando) return;
            evento.preventDefault();

            const { x, y } = posicaoRelativa(evento);

            ctx.beginPath();
            ctx.moveTo(ultimoX, ultimoY);
            ctx.lineTo(x, y);
            ctx.stroke();

            ultimoX = x;
            ultimoY = y;

            estadoAssinaturas[canvas.id] = true;
            verificarAssinaturasCompletas();
        }

        function pararTraco() {
            desenhando = false;
        }

        // Mouse (computador)
        canvas.addEventListener("mousedown", iniciarTraco);
        canvas.addEventListener("mousemove", desenharTraco);
        canvas.addEventListener("mouseup", pararTraco);
        canvas.addEventListener("mouseleave", pararTraco);

        // Toque (celular/tablet - dedo ou caneta)
        canvas.addEventListener("touchstart", iniciarTraco, { passive: false });
        canvas.addEventListener("touchmove", desenharTraco, { passive: false });
        canvas.addEventListener("touchend", pararTraco);
    });

    // Botões de limpar
    document.querySelectorAll(".btn-limpar-assinatura").forEach((botao) => {
        botao.addEventListener("click", () => {
            const canvas = document.getElementById(botao.dataset.target);
            const ctx = canvas.getContext("2d");
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            estadoAssinaturas[canvas.id] = false;
            verificarAssinaturasCompletas();
        });
    });
}