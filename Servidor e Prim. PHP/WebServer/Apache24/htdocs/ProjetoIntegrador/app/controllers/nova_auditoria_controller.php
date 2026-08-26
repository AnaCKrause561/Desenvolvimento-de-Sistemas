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

    $areasValidas = ["avicultura", "agronomia", "incubatorio", "abatedouro"];
    $area = $_POST["area"] ?? null;

    if (!in_array($area, $areasValidas)) {
        header("Location: ../views/novo_checklist.php");
        exit;
    }

    $_SESSION["nova_auditoria"]["area"] = $area;
    header("Location: ../views/novo_checklist_empresas.php");
    exit;
}

if ($etapa === "empresa") {

    // Não deixa pular o passo 1
    if (!isset($_SESSION["nova_auditoria"]["area"])) {
        header("Location: ../views/novo_checklist.php");
        exit;
    }

    $valor = $_POST["granja"] ?? null;

    if (!$valor || !preg_match('/^(empresa|granja)_(\d+)$/', $valor, $m)) {
        header("Location: ../views/novo_checklist_empresas.php");
        exit;
    }

    $_SESSION["nova_auditoria"]["local_tipo"] = $m[1];
    $_SESSION["nova_auditoria"]["local_id"] = (int) $m[2];

    header("Location: ../views/novo_checklist_check.php");
    exit;
}

if ($etapa === "checklist") {

    // Não deixa pular o passo 2
    if (!isset($_SESSION["nova_auditoria"]["local_id"])) {
        header("Location: ../views/novo_checklist_empresas.php");
        exit;
    }

    $valor = $_POST["checklist"] ?? null;

    if ($valor === "novo") {
        $_SESSION["nova_auditoria"]["checklist_id"] = null;
    } elseif (ctype_digit($valor)) {
        $_SESSION["nova_auditoria"]["checklist_id"] = (int) $valor;
    } else {
        header("Location: ../views/novo_checklist_check.php");
        exit;
    }

    header("Location: ../views/novo_checklist_auditoria.php");
    exit;
}


if ($etapa === "auditoria") {

    // Não deixa pular o passo 3
    if (!array_key_exists("checklist_id", $_SESSION["nova_auditoria"])) {
        header("Location: ../views/novo_checklist_check.php");
        exit;
    }

    $itensRecebidos = $_POST["itens"] ?? [];
    $arquivosRecebidos = $_FILES["itens"] ?? [];

    if (empty($itensRecebidos)) {
        header("Location: ../views/novo_checklist_auditoria.php");
        exit;
    }

    // Pasta temporária pra guardar as fotos enquanto a auditoria não é finalizada
    $pastaTemp = "../../public/uploads/temp/";
    if (!is_dir($pastaTemp)) {
        mkdir($pastaTemp, 0755, true);
    }

    $itensProntos = [];

    foreach ($itensRecebidos as $index => $item) {
        $caminhoFoto = null;

        // Confere se essa posição tem um arquivo de foto enviado
        if (
            isset($arquivosRecebidos["error"][$index]["foto"]) &&
            $arquivosRecebidos["error"][$index]["foto"] === UPLOAD_ERR_OK
        ) {
            $nomeOriginal = $arquivosRecebidos["name"][$index]["foto"];
            $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
            $nomeArquivo = uniqid("foto_") . "." . $extensao;

            $tmpName = $arquivosRecebidos["tmp_name"][$index]["foto"];
            move_uploaded_file($tmpName, $pastaTemp . $nomeArquivo);

            $caminhoFoto = "public/uploads/temp/" . $nomeArquivo;
        }

        $itensProntos[] = [
            "pergunta"    => trim($item["pergunta"] ?? ""),
            "pontuacao"   => $item["pontuacao"] ?? "",
            "observacao"  => trim($item["observacao"] ?? ""),
            "foto"        => $caminhoFoto,
        ];
    }

    $_SESSION["nova_auditoria"]["itens"] = $itensProntos;

    header("Location: ../views/novo_checklist_foto.php");
    exit;
}

if ($etapa === "assinatura") {

    if (!isset($_SESSION["nova_auditoria"]["itens"])) {
        header("Location: ../views/novo_checklist_auditoria.php");
        exit;
    }

    $assinaturaAuditor = $_POST["assinatura_auditor"] ?? "";
    $assinaturaResponsavel = $_POST["assinatura_responsavel"] ?? "";
    $nomeAuditor = trim($_POST["nome_auditor"] ?? "");
    $nomeResponsavel = trim($_POST["nome_responsavel"] ?? "");

    // Só a assinatura do auditor é obrigatória
    if (!$assinaturaAuditor) {
        header("Location: ../views/novo_checklist_ass.php");
        exit;
    }

    $pastaTemp = "../../public/uploads/temp/";
    if (!is_dir($pastaTemp)) {
        mkdir($pastaTemp, 0755, true);
    }

    function salvarAssinatura($dataUrl, $pastaTemp, $prefixo) {
        $dados = explode(",", $dataUrl)[1] ?? "";
        $binario = base64_decode($dados);

        $nomeArquivo = uniqid($prefixo . "_") . ".png";
        file_put_contents($pastaTemp . $nomeArquivo, $binario);

        return "public/uploads/temp/" . $nomeArquivo;
    }

    $_SESSION["nova_auditoria"]["assinaturas"] = [
        "auditor" => [
            "nome"   => $nomeAuditor,
            "imagem" => salvarAssinatura($assinaturaAuditor, $pastaTemp, "assinatura_auditor"),
        ],
        "responsavel" => [
            "nome"   => $nomeResponsavel,
            // Só salva a imagem se o responsável realmente assinou
            "imagem" => $assinaturaResponsavel
                ? salvarAssinatura($assinaturaResponsavel, $pastaTemp, "assinatura_responsavel")
                : null,
        ],
    ];

    header("Location: ../views/novo_checklist_revisao.php");
    exit;
}