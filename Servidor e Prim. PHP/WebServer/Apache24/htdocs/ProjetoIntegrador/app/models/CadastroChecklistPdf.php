<?php

class CadastroChecklistPdf
{
    private $pdo;

    function __construct()
    {
        include_once("Connect.php");
        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    public function SalvarRegistroPdf($checklist_id, $arquivo_url)
    {
        $sql = "INSERT INTO checklist_pdfs (checklist_id, arquivo_url) VALUES (:checklist_id, :arquivo_url);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":checklist_id", $checklist_id);
        $stmt->bindParam(":arquivo_url", $arquivo_url);

        return ($stmt->execute());
    }
}

