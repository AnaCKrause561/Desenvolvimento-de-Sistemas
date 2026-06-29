<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $data = $_POST["data"];
    $hora = $_POST["hora"];
    $status = $_POST["status"];

    include_once("../models/Compromissos.php");

    $obj = new Compromissos();
    $resp = $obj->CadastrarCompromisso($titulo, $descricao, $data, $hora, $status);

    if (!$resp) {
        echo '<script>
                alert("Erro ao cadastrar compromisso");
                window.location.href="../views/novo_compromisso.php";
              </script>';
    }
}