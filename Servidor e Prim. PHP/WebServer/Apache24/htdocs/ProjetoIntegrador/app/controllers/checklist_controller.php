<?php
session_name("ProjetoIntegrado");
session_start();

require_once("../models/CadastroChecklist.php");

header("Content-Type: application/json");

$acao = $_GET["acao"] ?? "";
$obj = new CadastroChecklist();

if ($acao === "salvar") {

    // JSON não vem em $_POST — precisa ler o corpo bruto da requisição
    $dados = json_decode(file_get_contents("php://input"), true);

    $id        = $dados["id"] ?? null;
    $nome      = $dados["nome"] ?? "";
    $area_id   = $dados["area"] ?? null;
    $perguntas = $dados["perguntas"] ?? [];
    $usuario_id = $_SESSION["usuario_id"];

    if (empty($id)) {
        $resp = $obj->CadastrarChecklist($nome, $area_id, $usuario_id, $perguntas);
    } else {
        $resp = $obj->EditarChecklist($id, $nome, $area_id, $perguntas);
    }

    echo json_encode([
        "sucesso" => $resp,
        "mensagem" => $resp ? null : $obj->getUltimoErro()
    ]);

} elseif ($acao === "excluir") {

    $id = $_POST["id"] ?? null;
    $resp = $id ? $obj->ExcluirChecklist($id) : false;

    echo json_encode(["sucesso" => $resp]);

} else {
    echo json_encode(["sucesso" => false, "mensagem" => "Ação inválida."]);
}