// Configura um canvas de assinatura: desenho (mouse + toque) e helpers de limpar/salvar
function configurarCanvasAssinatura(canvas, inputEscondido) {
    const ctx = canvas.getContext("2d");
    ctx.strokeStyle = "#154217";
    ctx.lineWidth = 2;
    ctx.lineCap = "round";

    let desenhando = false;
    let assinou = false;

    function pegarPosicao(evento) {
        const rect = canvas.getBoundingClientRect();
        const escalaX = canvas.width / rect.width;
        const escalaY = canvas.height / rect.height;

        const origem = evento.touches ? evento.touches[0] : evento;

        return {
            x: (origem.clientX - rect.left) * escalaX,
            y: (origem.clientY - rect.top) * escalaY,
        };
    }

    function iniciar(evento) {
        evento.preventDefault();
        desenhando = true;
        const pos = pegarPosicao(evento);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    }

    function desenhar(evento) {
        if (!desenhando) return;
        evento.preventDefault();
        const pos = pegarPosicao(evento);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
        assinou = true;
        atualizarBotaoProximo();
    }

    function parar() {
        desenhando = false;
    }

    canvas.addEventListener("mousedown", iniciar);
    canvas.addEventListener("mousemove", desenhar);
    canvas.addEventListener("mouseup", parar);
    canvas.addEventListener("mouseleave", parar);

    canvas.addEventListener("touchstart", iniciar);
    canvas.addEventListener("touchmove", desenhar);
    canvas.addEventListener("touchend", parar);

    return {
        limpar() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            assinou = false;
            inputEscondido.value = "";
            atualizarBotaoProximo();
        },
        assinou() {
            return assinou;
        },
        salvarNoInput() {
            inputEscondido.value = assinou ? canvas.toDataURL("image/png") : "";
        },
    };
}

// Ajusta a resolução interna do canvas pro tamanho real exibido na tela
// (sem isso, o desenho fica borrado ou desalinhado do dedo/mouse)
function ajustarResolucaoCanvas(canvas) {
    const rect = canvas.getBoundingClientRect();
    canvas.width = rect.width;
    canvas.height = rect.height;
}

const canvasAuditor = document.getElementById("canvasAuditor");
const canvasResponsavel = document.getElementById("canvasResponsavel");
const inputAssinaturaAuditor = document.getElementById("inputAssinaturaAuditor");
const inputAssinaturaResponsavel = document.getElementById("inputAssinaturaResponsavel");
const btnProximo = document.querySelector(".btn-proximo");
const form = document.getElementById("formAssinatura");

ajustarResolucaoCanvas(canvasAuditor);
ajustarResolucaoCanvas(canvasResponsavel);

const assinaturaAuditor = configurarCanvasAssinatura(canvasAuditor, inputAssinaturaAuditor);
const assinaturaResponsavel = configurarCanvasAssinatura(canvasResponsavel, inputAssinaturaResponsavel);

function atualizarBotaoProximo() {
    btnProximo.disabled = !assinaturaAuditor.assinou();
}

// Botão "Limpar assinatura" — usa o data-target pra saber qual canvas limpar
document.querySelectorAll(".btn-limpar-assinatura").forEach((botao) => {
    botao.addEventListener("click", () => {
        const alvo = botao.dataset.target;
        if (alvo === "canvasAuditor") assinaturaAuditor.limpar();
        if (alvo === "canvasResponsavel") assinaturaResponsavel.limpar();
    });
});

// Antes de enviar o form, converte o desenho de cada canvas em imagem (base64)
form.addEventListener("submit", () => {
    assinaturaAuditor.salvarNoInput();
    assinaturaResponsavel.salvarNoInput();
});