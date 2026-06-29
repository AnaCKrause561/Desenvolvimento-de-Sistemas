<?php
        session_start();
        $id= $_GET["id"];
 
        include_once("../models/Contatos.php");

        $obj = new Contatos();
        $resp = $obj->ExcluirContato($id);

        
?>