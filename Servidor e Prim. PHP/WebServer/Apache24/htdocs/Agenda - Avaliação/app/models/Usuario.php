<?php

class Usuario
{
    private $pdo;

    function __construct()
    {
        include_once("connect.php");
        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    public function BuscarUsuario($id)
    {
        $sql = "SELECT * FROM usuario WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function AtualizarUsuario($id, $nome, $email, $telefone, $descricao)
    {
        $sql = "UPDATE usuario 
            SET nome = :nome,
                email = :email,
                telefone = :telefone,
                descricao = :descricao
            WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":descricao", $descricao);

        return $stmt->execute();
    }
}
