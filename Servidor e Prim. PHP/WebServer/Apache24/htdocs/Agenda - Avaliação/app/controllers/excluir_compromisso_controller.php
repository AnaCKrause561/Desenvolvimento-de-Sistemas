<?php
        session_start();
        $id= $_GET["id"];
 
        include_once("../models/Compromissos.php");

        $obj = new Compromissos();
        $resp = $obj->ExcluirCompromisso($id);

        
?>