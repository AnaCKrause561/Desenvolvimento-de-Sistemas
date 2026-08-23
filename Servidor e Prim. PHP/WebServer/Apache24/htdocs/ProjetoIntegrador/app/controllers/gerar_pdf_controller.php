<?php

session_name("ProjetoIntegrado");
session_start();

require_once("../../vendor/autoload.php");
require_once("../models/CadastroChecklist.php");
require_once("../models/CadastroChecklistPdf.php");

use Dompdf\Dompdf;

$id = $_GET["id"] ?? null;

if (!$id) {
    http_response_code(400);
    echo "ID do checklist não informado.";
    exit;
}

// 1) busca os dados do checklist (nome, área e perguntas)
$modeloChecklist = new CadastroChecklist();
$checklist = $modeloChecklist->ListarUmChecklist($id);

if (!$checklist || !$checklist["nome"]) {
    http_response_code(404);
    echo "Checklist não encontrado.";
    exit;
}

// 2) monta o HTML que vai virar o PDF
$listaPerguntasHtml = "";
foreach ($checklist["perguntas"] as $indice => $item) {
    $numero = $indice + 1;
    $texto = htmlspecialchars($item["pergunta"]);
    $listaPerguntasHtml .= "<tr><td>{$numero}</td><td>{$texto}</td></tr>";
}

$nomeChecklist = htmlspecialchars($checklist["nome"]);
$dataGeracao = date("d/m/Y H:i");

$html = "
<html>
<head>
    <style>
        @page { margin: 30px; }
        body { font-family: Arial, sans-serif; color: #222; margin: 0; }

        .cabecalho {
            background-color: #1f5c33;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .cabecalho h1 { margin: 0; font-size: 22px; }
        .cabecalho p { margin-top: 6px; font-size: 12px; }

        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        table { width: 100%; border-collapse: collapse; }
        th {
            background-color: #1f5c33;
            color: white;
            padding: 8px;
            text-align: left;
        }
        td { padding: 8px; border-bottom: 1px solid #eee; }
        tr:nth-child(even) { background-color: #f8f9fa; }

        .rodape {
            margin-top: 25px;
            padding-top: 8px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #777;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class='cabecalho'>
        <h1>{$nomeChecklist}</h1>
        <p>Gerado em {$dataGeracao}</p>
    </div>

    <div class='card'>
        <table>
            <thead>
                <tr><th>#</th><th>Pergunta</th></tr>
            </thead>
            <tbody>
                {$listaPerguntasHtml}
            </tbody>
        </table>
    </div>

    <div class='rodape'>Documento gerado pelo Farms Check</div>
</body>
</html>
";

// 3) gera o PDF com o dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper("A4", "portrait");
$dompdf->render(); 

// 4) salva o arquivo em public/pdfs
$nomeArquivo = "checklist_{$id}_" . time() . ".pdf";
$caminhoPasta = "../../public/pdfs/";
$caminhoCompleto = $caminhoPasta . $nomeArquivo;

file_put_contents($caminhoCompleto, $dompdf->output());

// 5) registra no banco que esse PDF existe
$modeloPdf = new CadastroChecklistPdf();
$modeloPdf->SalvarRegistroPdf($id, "public/pdfs/" . $nomeArquivo);

// 6) devolve o arquivo pro navegador
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=\"{$nomeArquivo}\"");
readfile($caminhoCompleto);
exit;