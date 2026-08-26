<?php

class CadastroEmpresa
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

    public function ListarTodasEmpresas()
    {
        $sql = "SELECT id, nome FROM empresas ORDER BY nome ASC;";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ($result);
        } else {
            return (FALSE);
        }
    }
    
    public function EditarEmpresa($id, $nome, $area, $endereco, $produtor_id, $usuario_id, $criado_em)
    {
        // "Nenhum" produtor vem como string vazia do <select> — precisa virar NULL pro banco
        $produtorId = ($produtor_id === '' || $produtor_id === null) ? null : $produtor_id;
        $tipoParam  = $produtorId === null ? PDO::PARAM_NULL : PDO::PARAM_INT;

        $sql = "UPDATE empresas SET nome = :nome, area = :area, endereco = :endereco, produtor_id = :produtor_id, usuario_id = :usuario_id, criado_em = :criado_em WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":area", $area);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":criado_em", $criado_em);

        if ($stmt->execute()) {
            return (TRUE);
        } else {
            echo "Erro";
            return (FALSE);
        }
    }

    public function ExcluirUmaEmpresa($id)
    {
        $sql = "DELETE id FROM empresas WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Usuário excluido com sucesso.");
                    window.location.href="http://localhost/ProjetoIntegrador/app/views/cadastros.php";
                    </script>';
        } else {
            echo "Erro";
        }
    }

    public function CadastrarEmpresa($nome, $area, $endereco, $usuario_id, $criado_em)
    {
        $sql = "INSERT INTO empresas (nome, area, endereco, usuario_id, criado_em) VALUES (:nome, :area, :endereco, :usuario_id, :criado_em);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":area", $area);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":criado_em", $criado_em);

        if ($stmt->execute()) {
           return (TRUE);
        } else {
            echo "Erro";
            return (FALSE);
        }
    }

    public function ListarEmpresasPorArea($area) {
    $sql = "SELECT id, nome, endereco FROM empresas WHERE area = :area ORDER BY nome";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":area", $area);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}