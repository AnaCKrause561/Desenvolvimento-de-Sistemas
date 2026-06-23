<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = $_POST["email"];
        $senha = md5($_POST["senha"]);
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $arquivo = $_FILES["arquivo"];
        
        include_once("../models/User.php");

        $obj = new User();
        $resp = $obj->CadastrarUsuario($email,$senha,$nome,$descricao,$arquivo);

        if($resp == TRUE)
        {
           // header("Location: ../views/dashboard.php");
        }
        else
        {
            echo '<script>
                        alert("Não foi possível cadastrar seu usuário");
                        window.location.href="http://localhost/Agenda%20-%20Avaliação/app/views/cadastrar_usuario.php";
                </script>';
                
        }
    }
?>