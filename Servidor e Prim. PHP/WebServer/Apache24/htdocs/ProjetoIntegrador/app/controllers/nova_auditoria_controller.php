<?php
session_name("ProjetoIntegrado");
session_start();

// Segurança: sem login, não passa
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../../index.html");
    exit;
}

$etapa = $_GET["etapa"] ?? null;

if ($etapa === "area") {

    // Lista de áreas válidas (mesmas do HTML) — evita que mande um valor inventado
    $areasValidas = ["avicultura", "agronomia", "incubatorio", "abatedouro"];
    $area = $_POST["area"] ?? null;

    if (!in_array($area, $areasValidas)) {
        // Se não veio uma área válida, volta pro passo 1
        header("Location: ../views/novo_checklist.php");
        exit;
    }

    // Guarda a área escolhida na "sacola" da sessão
    $_SESSION["nova_auditoria"]["area"] = $area;

    // Segue pro passo 2
    header("Location: novo_checklist_empresas.php");
    exit;
}