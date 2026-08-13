<?php
session_name("ProjetoIntegrado");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $senha = md5($_POST["senha"]);
    $cargo = $_POST["cargo"];
    $nivel_acesso = $_POST["nivel_acesso"];
    $criado_em = date("Y-m-d H:i:s");
    $ativo = isset($_POST["ativo"]);
    $areas = isset($_POST["usuarioAreas"]) ? $_POST["usuarioAreas"] : [];
    $arquivo = $_FILES["arquivo"];

    $obj = new User();
    $resp = $obj->EditarUsuario($nome, $email, $login, $senha, $cargo, $arquivo, $nivel_acesso, $criado_em, $ativo, $areas);
}else {
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
                text: 'Editado com sucesso.',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = "../views/perfil.php";
            });
        </script>
    <?php else: ?>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Erro!',
                text: 'Editado não realizado.',
                confirmButtonColor: '#2563eb'
            }).then(() => {
                history.back();
            });
        </script>
    <?php endif; ?>
</body>

</html>