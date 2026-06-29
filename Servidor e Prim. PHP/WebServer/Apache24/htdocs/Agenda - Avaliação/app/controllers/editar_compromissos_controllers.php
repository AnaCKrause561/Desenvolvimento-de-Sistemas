<?php
session_start();
include_once("../models/Compromissos.php");

$obj = new Compromissos();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $data = $_POST["data"];
    $hora = $_POST["hora"];
    $status = $_POST["status"];
    $usuario = $_SESSION["usuario_id"];
    $obj->EditarCompromisso($id, $titulo, $descricao, $data, $hora, $status, $usuario);

    header("Location: ../views/compromissos.php");
    exit;
}
