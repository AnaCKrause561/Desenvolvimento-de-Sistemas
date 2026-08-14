<?php
session_name("ProjetoIntegrado");
session_start();

require_once("../models/User.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_SESSION["usuario_id"]; // edita sempre o usuário logado, nunca um id vindo do POST

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $cargo = $_POST["cargo"];
    $nivel_idfk = $_POST["nivel_acesso"];
    $ativo = isset($_POST["ativo"]);
    $areas = isset($_POST["usuarioAreas"]) ? $_POST["usuarioAreas"] : [];
    $area_acesso = $areas[0] ?? null;
    $arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : null;

    // só troca a senha se o campo foi preenchido, e só se as duas confirmações batem
    $senha = null;
    if (!empty($_POST["senha"])) {
        if ($_POST["senha"] !== $_POST["senha_confirma"]) {
            $resp = false;
        } else {
            $senha = md5($_POST["senha"]);
        }
    }

    if (!isset($resp)) {
        $obj = new User();
        $usuarioAtual = $obj->ListarUmUsuario($id);
        $resp = $obj->EditarUsuario($id, $nome, $email, $login, $senha, $cargo, $arquivo, $nivel_idfk, $ativo, $area_acesso, $usuarioAtual["url"]);
 
        if ($resp) {
            // mantém a sessão em sincronia com os dados que acabaram de ser salvos
            $_SESSION["nome"] = $nome;
            $_SESSION["login"] = $login;
        }
    }
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
                text: 'Edição não realizada.',
                confirmButtonColor: '#2563eb'
            }).then(() => {
                history.back();
            });
        </script>
    <?php endif; ?>
</body>
 
</html>