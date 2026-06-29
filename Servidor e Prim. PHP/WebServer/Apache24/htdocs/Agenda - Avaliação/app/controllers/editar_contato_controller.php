<?php
session_start();
include_once("../models/Contatos.php");

$obj = new Contatos();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $descricao = $_POST["descricao"];
    $usuario = $_SESSION["usuario_id"];
    $obj->EditarContato($id, $nome, $telefone, $email, $descricao, $usuario);

    header("Location: ../views/contatos.php");
    exit;
}
