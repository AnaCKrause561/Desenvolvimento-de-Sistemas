<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") /*estamos trabalhando com o Postgre, por isso SERVER*/
    {
        $email = $_POST["email"]; /*a variável que estamos utilizando no login do documento index*/
        $senha = md5($_POST["senha"]); /*md5 para não demonstrar a senha*/

        include_once("../models/User.php"); /*acesso a esse arquivo para os próximos passos*/

        $obj = new User(); /*tranformou meu obj em user*/
        $resp = $obj->ValidarLogin($email, $senha);

        if($resp["email"] == $email && $resp["senha"] == $senha)
        {
            header("Location: ../views/dashboard.php");
        }
        else
        {
            echo '<script>
                        alert("Senha ou Usuário inválido, tente novamente.");
                        window.location.href="http://localhost/painel";
                </script>';            
        }
    }


?>