<?php

        $id= $_GET["var"];
 
        include_once("../models/User.php");

        $obj = new User();
        $resp = $obj->ExcluirUsuario($id);

        
?>