<?php

class CadastroGranja
{
    private string $login;
    private string $password;
    private $pdo;

    function __construct()
    {
        include_once("Connect.php");
        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    public function ListarTodasGranjas()
    {
        $sql = "SELECT id, nome FROM granjas ORDER BY nome ASC;";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ($result);
        } else {
            return (FALSE);
        }
    }
    
    public function EditarGranja($id, $nome, $area, $endereco, $produtor_id, $usuario_id, $empresa_id, $criado_em)
    {

        $sql = "UPDATE granjas SET nome = :nome, area = :area, endereco = :endereco, produtor_id = :produtor_id, usuario_id = :usuario_id, empresa_id = :empresa_id, criado_em = :criado_em WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":area", $area);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":produtor_id", $produtor_id);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":empresa_id", $empresa_id);
        $stmt->bindParam(":criado_em", $criado_em);

        if ($stmt->execute()) {
            return (TRUE);
        } else {
            echo "Erro";
            return (FALSE);
        }
    }

    public function ExcluirUmaGranja($id)
    {
        $sql = "DELETE * FROM granjas WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
        } else {
            echo "Erro";
        }
    }

    public function CadastrarGranja($nome, $area, $endereco, $produtor_id, $usuario_id, $empresas_id, $criado_em)
    { 
        $sql = "INSERT INTO granjas (nome, area, endereco, produtor_id, usuario_id, empresas_id, criado_em) VALUES (:nome, :area, :endereco, :produtor_id, :usuario_id, :empresas_id, :criado_em);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":area", $area);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":produtor_id", $produtor_id);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":empresas_id", $empresas_id);
        $stmt->bindParam(":criado_em", $criado_em);

        if ($stmt->execute()) {
            return (TRUE);
        } else {
            echo "Erro";
            return (FALSE);
        }
    }

    public function ListarGranjasPorArea($area) {
    $sql = "SELECT id, nome, endereco FROM granjas WHERE area = :area ORDER BY nome";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":area", $area);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}