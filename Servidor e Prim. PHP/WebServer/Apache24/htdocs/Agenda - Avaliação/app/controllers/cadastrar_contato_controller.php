<?php

    session_start();
    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $email = $_POST["email"];
        $nome = $_POST["nome"];
        $telefone = $_POST["telefone"];
        $descricao = $_POST["descricao"];
        $arquivo = $_FILES["arquivo"];
        $_SESSION["usuario_id"];
        
        include_once("../models/Contatos.php");

        $obj = new Contatos();
        $resp = $obj->CadastrarContato($email,$nome,$telefone,$descricao,$arquivo);

        if($resp == TRUE)
        {
           // header("Location: ../views/dashboard.php");
        }
        else
        {
            echo '<script>
                        alert("Não foi possível cadastrar seu usuário");
                        window.location.href="http://localhost/Agenda%20-%20Avaliação/app/views/novo_contato.php";
                </script>';
                
        }
    }
?>