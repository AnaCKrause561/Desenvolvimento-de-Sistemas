<?php

require 'vendor/autoload.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$html = '
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">

    <style>

        @page {
            margin: 30px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .cabecalho {
            background-color: #2563eb;
            color: white;
            padding: 25px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .cabecalho h1 {
            margin: 0;
            font-size: 28px;
        }

        .cabecalho p {
            margin-top: 8px;
            font-size: 14px;
        }

        .titulo {
            color: #2563eb;
            font-size: 20px;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }

        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .card h3 {
            margin-top: 0;
            color: #2563eb;
        }

        .informacoes {
            width: 100%;
            border-collapse: collapse;
        }

        .informacoes td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }

        .informacoes td:first-child {
            font-weight: bold;
            width: 30%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #2563eb;
            color: white;
            padding: 10px;
            text-align: left;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .destaque {
            background-color: #eff6ff;
            border-left: 5px solid #2563eb;
            padding: 15px;
            margin: 20px 0;
        }

        .rodape {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #777;
            font-size: 11px;
        }

    </style>

</head>

<body>

    <div class="cabecalho">
        <h1>Olá, eu sou a Ana! 💙</h1>
        <p>Exemplo de PDF estilizado com HTML + CSS + Dompdf</p>
    </div>

    <h2 class="titulo">Informações pessoais</h2>

    <div class="card">

        <table class="informacoes">

            <tr>
                <td>Nome:</td>
                <td>Ana Cristina</td>
            </tr>

            <tr>
                <td>Profissão:</td>
                <td>Desenvolvedora de Sistemas</td>
            </tr>

            <tr>
                <td>Cidade:</td>
                <td>Dois Vizinhos - PR</td>
            </tr>

            <tr>
                <td>E-mail:</td>
                <td>ana@email.com</td>
            </tr>

        </table>

    </div>

    <div class="destaque">
        <strong>Sobre mim</strong><br><br>
        Estou aprendendo desenvolvimento de sistemas e
        trabalhando com HTML, CSS, PHP e banco de dados.
    </div>

    <h2 class="titulo">Meus conhecimentos</h2>

    <table>

        <thead>
            <tr>
                <th>Tecnologia</th>
                <th>Nível</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>HTML</td>
                <td>Intermediário</td>
                <td>✓ Aprendendo</td>
            </tr>

            <tr>
                <td>CSS</td>
                <td>Intermediário</td>
                <td>✓ Aprendendo</td>
            </tr>

            <tr>
                <td>PHP</td>
                <td>Básico</td>
                <td>✓ Aprendendo</td>
            </tr>

            <tr>
                <td>PostgreSQL</td>
                <td>Básico</td>
                <td>✓ Aprendendo</td>
            </tr>

        </tbody>

    </table>

    <div class="card" style="margin-top: 20px;">

        <h3>Objetivo</h3>

        <p>
            Desenvolver minhas habilidades em programação,
            criar sistemas web e evoluir profissionalmente
            na área de tecnologia.
        </p>

    </div>

    <div class="rodape">
        Documento gerado automaticamente com PHP + Dompdf
    </div>

</body>

</html>
';
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
?>