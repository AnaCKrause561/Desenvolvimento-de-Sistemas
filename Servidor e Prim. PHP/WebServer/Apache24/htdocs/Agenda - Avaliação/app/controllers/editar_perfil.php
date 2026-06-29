<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $descricao = $_POST["descricao"];

    include_once("../models/Usuario.php");

    $obj = new Usuario();
    $resp = $obj->AtualizarUsuario($id, $nome, $email, $telefone, $descricao);

    if ($resp) {
        echo '<script>
                alert("Perfil atualizado com sucesso!");
                window.location.href="../views/perfil.php";
              </script>';
    } else {
        echo '<script>
                alert("Erro ao atualizar perfil");
                window.location.href="../views/perfil.php";
              </script>';
    }
}