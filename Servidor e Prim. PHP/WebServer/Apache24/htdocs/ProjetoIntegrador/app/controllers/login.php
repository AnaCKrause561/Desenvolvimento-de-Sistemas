<?php
session_name("ProjetoIntegrado");
session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $login = $_POST["login"];
        $senha = md5($_POST["senha"]);
        
        include_once("../models/User.php");

        $obj = new User();
        $resp = $obj->ValidarLogin($login,$senha);

        if($resp == TRUE)
        {
            header("Location: ../views/dashboard.php");
        }
        else
        {
            echo '<script>
                        alert("Senha ou Usuário inválido, tente novamente.");
                        window.location.href="http://localhost/ProjetoIntegrador/index.html";
                </script>';
                
        }
    }
?>