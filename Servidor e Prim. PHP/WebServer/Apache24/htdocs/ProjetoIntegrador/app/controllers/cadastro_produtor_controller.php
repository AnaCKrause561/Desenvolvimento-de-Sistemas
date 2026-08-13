<?php

session_name("ProjetoIntegrado");
session_start();
date_default_timezone_set('America/Sao_Paulo');

require_once("../models/CadastroProdutor.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $telefone = $_POST["telefone"];
    $usuario_id = $_SESSION["usuario_id"];
    $criado_em = date("Y-m-d H:i:s");


    $obj = new CadastroProdutor();
    $resp = $obj->CadastrarProdutor($nome, $cpf, $telefone, $usuario_id, $criado_em);
} else {
    $resp = false;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php if ($resp == TRUE): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: 'Cadastrado com sucesso.',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = "../views/cadastros.php";
            });
        </script>
    <?php else: ?>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Erro!',
                text: 'Cadastro não realizado.',
                confirmButtonColor: '#2563eb'
            }).then(() => {
                history.back();
            });
        </script>
    <?php endif; ?>
</body>

</html>