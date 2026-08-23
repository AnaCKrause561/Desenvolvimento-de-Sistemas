<?php

class CadastroArea
{
    private $pdo;

    function __construct()
    {
        include_once("Connect.php");
        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    public function ListarTodasAreas()
    {
        $sql = "SELECT area_id, area FROM usuario_areas ORDER BY area ASC;";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute()) {
            return ($stmt->fetchAll(PDO::FETCH_ASSOC));
        } else {
            return (FALSE);
        }
    }
}