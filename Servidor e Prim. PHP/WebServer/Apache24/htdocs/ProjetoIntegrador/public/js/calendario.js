/* calendario.css — sidebar, topo e cabeçalho vêm do dashboard.css.
   Cards e modal seguem o mesmo padrão visual das outras páginas internas. */
@import url("dashboard.css");

/* ===== CARD ===== */
.card-calendario {
    background: #fff;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 2px 10px rgba(21, 66, 23, .06);
    margin-bottom: 25px;
}

.card-calendario h3 {
    font-family: Georgia, 'Times New Roman', serif;
    font-size: 20px;
    color: #154217;
    margin-bottom: 18px;
}

/* ===== NAVEGAÇÃO DO MÊS ===== */
.calendario-topo {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 20px;
}

.calendario-navegacao {
    display: flex;
    align-items: center;
    gap: 18px;
}

.calendario-navegacao h2 {
    font-family: Georgia, 'Times New Roman', serif;
    font-size: 22px;
    color: #154217;
    min-width: 200px;
    text-align: center;
    text-transform: capitalize;
}

.btn-nav {
    width: 34px;
    height: 34px;
    border: 2px solid #e4e9d8;
    border-radius: 8px;
    background: #fff;
    color: #154217;
    font-size: 18px;
    cursor: pointer;
    transition: .2s;
}

.btn-nav:hover {
    border-color: #8f9f39;
    background: #f3f6ec;
}

.btn-novo-compromisso {
    background: #8f9f39;
    color: #F8F9FA;
    border: none;
    border-radius: 10px;
    padding: 10px 22px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: .2s;
}

.btn-novo-compromisso:hover {
    background: #154217;
}

/* ===== LEGENDA ===== */
.calendario-legenda {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e4e9d8;
}

.legenda-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #6b7263;
}

.legenda-bolinha {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
}

/* ===== TIPOS (cores) ===== */
.tag-visita { background: #4c7a2e; }
.tag-plano { background: #c0392b; }
.tag-reuniao { background: #185fa5; }
.tag-outro { background: #9aa08a; }

/* ===== CABEÇALHO DOS DIAS DA SEMANA ===== */
.calendario-semana {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
    font-size: 12px;
    font-weight: bold;
    color: #6b7263;
    text-transform: uppercase;
    letter-spacing: .04em;
    padding-bottom: 10px;
}

/* ===== GRADE DE DIAS ===== */
.calendario-grade {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 6px;
}

.dia-celula {
    min-height: 92px;
    border: 2px solid #e4e9d8;
    border-radius: 10px;
    padding: 8px;
    cursor: pointer;
    transition: .2s;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.dia-celula:hover {
    border-color: #8f9f39;
    background: #f3f6ec;
}

.dia-celula.fora-do-mes {
    opacity: .35;
}

.dia-celula.hoje {
    border-color: #154217;
    background: #f3f6ec;
}

.dia-celula.selecionado {
    border-color: #154217;
    background: #e4e9d8;
}

.dia-celula__numero {
    font-size: 13px;
    font-weight: bold;
    color: #154217;
}

.dia-celula__tags {
    display: flex;
    flex-wrap: wrap;
    gap: 3px;
}

.dia-celula__tags .legenda-bolinha {
    width: 7px;
    height: 7px;
}

/* ===== LISTA DE COMPROMISSOS DO DIA ===== */
.lista-compromissos {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.compromissos-vazio {
    color: #9aa08a;
    font-size: 14px;
    text-align: center;
    padding: 20px 0;
}

.item-compromisso {
    display: flex;
    align-items: center;
    gap: 14px;
    border: 2px solid #e4e9d8;
    border-radius: 12px;
    padding: 14px 16px;
    cursor: pointer;
    transition: .2s;
}

.item-compromisso:hover {
    border-color: #8f9f39;
}

.item-compromisso__tag {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
}

.item-compromisso__corpo {
    flex: 1;
}

.item-compromisso__titulo {
    display: block;
    font-size: 14px;
    font-weight: bold;
    color: #154217;
}

.item-compromisso__meta {
    display: block;
    font-size: 12px;
    color: #6b7263;
    margin-top: 2px;
}

/* ===== MODAL ===== */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(13, 43, 24, .55);
    z-index: 999;
}

.modal-overlay.ativo {
    display: block;
}

.modal-compromisso {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: min(560px, 92vw);
    max-height: 88vh;
    overflow-y: auto;
    background: #fff;
    border-radius: 16px;
    padding: 34px;
    box-shadow: 0 10px 40px rgba(21, 66, 23, .25);
    z-index: 1000;
}

.modal-compromisso.aberto {
    display: block;
}

.modal-compromisso h2 {
    font-family: Georgia, 'Times New Roman', serif;
    font-size: 22px;
    color: #154217;
    margin-bottom: 22px;
}

.modal-fechar {
    position: absolute;
    top: 18px;
    right: 18px;
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 8px;
    background: #f3f6ec;
    color: #154217;
    font-size: 15px;
    cursor: pointer;
    transition: .2s;
}

.modal-fechar:hover {
    background: #e4e9d8;
}

/* ===== CAMPOS DO FORMULÁRIO (reaproveitando o padrão) ===== */
.grade-campos {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 16px;
    margin-bottom: 18px;
}

.item-campo {
    margin-bottom: 18px;
}

.item-campo label {
    display: block;
    font-size: 13px;
    color: #6b7263;
    margin-bottom: 6px;
    font-weight: bold;
}

.item-campo input,
.item-campo select,
.item-campo textarea {
    width: 100%;
    padding: 10px 14px;
    border: 2px solid #e4e9d8;
    border-radius: 10px;
    font-size: 14px;
    color: #10281d;
    font-family: inherit;
    background: #fff;
    transition: .2s;
    resize: vertical;
}

.item-campo input:focus,
.item-campo select:focus,
.item-campo textarea:focus {
    outline: none;
    border-color: #8f9f39;
}

.rodape-form {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 12px;
}

.btn-salvar {
    background: #154217;
    color: #F8F9FA;
    border: none;
    border-radius: 10px;
    padding: 12px 26px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    transition: .2s;
}

.btn-salvar:hover {
    background: #0d2b18;
}

.btn-excluir-compromisso {
    background: transparent;
    color: #c0392b;
    border: 2px solid #f0d3d0;
    border-radius: 10px;
    padding: 12px 20px;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    margin-right: auto;
    transition: .2s;
}

.btn-excluir-compromisso:hover {
    background: #fbe9e7;
}

/* ===== RESPONSIVO ===== */
@media (max-width:768px) {
    .card-calendario {
        padding: 20px;
    }

    .calendario-topo {
        flex-direction: column;
        align-items: stretch;
    }

    .calendario-navegacao {
        justify-content: center;
    }

    .dia-celula {
        min-height: 64px;
        padding: 6px;
    }

    .grade-campos {
        grid-template-columns: 1fr;
    }

    .modal-compromisso {
        padding: 22px;
    }
}