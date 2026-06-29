<?php

class Compromissos
{
    private $pdo;

    function __construct()
    {
        include_once("connect.php");
        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    public function ListarTodosCompromissos()
    {
        $usuario = $_SESSION["usuario_id"];

        $sql = "SELECT * FROM compromissos 
                WHERE usuario_idfk = :usuario 
                ORDER BY data ASC, hora ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":usuario", $usuario);

        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function ListarUmCompromisso($id)
    {
        $usuario = $_SESSION["usuario_id"];

        $sql = "SELECT * FROM compromissos 
                WHERE id = :id AND usuario_idfk = :usuario";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":usuario", $usuario);

        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function CadastrarCompromisso($titulo, $descricao, $data, $hora, $status)
    {
        $usuario = $_SESSION["usuario_id"];

        $sql = "INSERT INTO compromissos 
                (titulo, descricao, data, hora, status, usuario_idfk)
                VALUES (:titulo, :descricao, :data, :hora, :status, :usuario)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":data", $data);
        $stmt->bindParam(":hora", $hora);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":usuario", $usuario);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Compromisso cadastrado com sucesso.");
                    window.location.href="http://localhost/Agenda%20-%20Avaliação/app/views/compromissos.php";
                  </script>';
            return true;
        }

        echo "Erro ao cadastrar";
        return false;
    }

    public function EditarCompromisso($id, $titulo, $descricao, $data, $hora, $status)
    {
        $usuario = $_SESSION["usuario_id"];

        $sql = "UPDATE compromissos 
                SET titulo = :titulo,
                    descricao = :descricao,
                    data = :data,
                    hora = :hora,
                    status = :status
                WHERE id = :id AND usuario_idfk = :usuario";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":data", $data);
        $stmt->bindParam(":hora", $hora);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":usuario", $usuario);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Compromisso atualizado com sucesso.");
                    window.location.href="../views/compromissos.php";
                  </script>';
            return true;
        }

        echo "Erro ao atualizar";
        return false;
    }

    public function ExcluirCompromisso($id)
    {
        $usuario = $_SESSION["usuario_id"];

        $sql = "DELETE FROM compromissos 
                WHERE id = :id AND usuario_idfk = :usuario";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":usuario", $usuario);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Compromisso excluído com sucesso.");
                    window.location.href="http://localhost/Agenda%20-%20Avaliação/app/views/compromissos.php";
                  </script>';
            return true;
        }

        echo "Erro ao excluir";
        return false;
    }
}