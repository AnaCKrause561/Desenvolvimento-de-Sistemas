<?php

class CadastroProdutor
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

    public function ListarTodosProdutores()
    {
        $sql = "SELECT id, nome, cpf FROM produtores ORDER BY nome ASC;";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ($result);
        } else {
            return (FALSE);
        }
    }


    public function ListarUmProdutor($id)
    {
        $sql = "SELECT * FROM produtores WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return ($result);
        } else {
            return (FALSE);
        }
    }

    public function EditarProdutor($id, $nome, $cpf, $telefone, $usuario_id, $empresa_id, $criado_em)
    {
        $sql = "UPDATE produtores SET nome = :nome, cpf = :cpf, telefone = :telefone, usuario_id = :usuario_id, empresa_id = :empresa_id WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":usuario_id", $usuario_id);
        $stmt->bindParam(":empresa_id", $empresa_id);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Usuário atualizado com sucesso.");
                    window.location.href="http://localhost/ProjetoIntegrador/app/views/cadastros.php";
                    </script>';
        } else {
            echo "Erro";
        }
    }

    public function ExcluirProdutor($id)
    {

        $sql = "DELETE FROM produtores WHERE id = :id;";
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

    public function CadastrarProdutor($nome, $cpf, $telefone, $usuario_id, $criado_em)
    {
        $sql = "INSERT INTO produtores (nome, cpf, telefone, usuario_id, criado_em) VALUES (:nome, :cpf, :telefone, :usuario_id, :criado_em);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':criado_em', $criado_em);

        if ($stmt->execute()) {
            return (TRUE);
            } else {
            return (FALSE);
        }
    }
}