<?php

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        require_once("Aluno.php");
        $obj = new Aluno();
        $exec = $obj->cadastrarAluno($_POST["nome"],$_POST["email"]);
        ///header("Location: cadastro_aluno.php");
    }

?>