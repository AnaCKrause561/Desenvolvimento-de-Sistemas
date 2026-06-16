<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="cookies.php">
        <label>E-mail:</label>
        <input type="email" name="email" require />
        <label>Senha:</label>
        <input type="password" name="senha" require />
        <label>
            <input type="checkbox" name="lembrar" />
            lembra-se 
        </label>
        <input type="submit" values="Entrar" name="entrar" />
    </form>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == 'POST')
    {
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        if(isset($_POST["lembrar"]))
        {
            $valor = base64_encode($email);
            $duracao = strtotime("+1 days");
            setcookie("lembrar",$valor,$duracao);
        }
    }
?>