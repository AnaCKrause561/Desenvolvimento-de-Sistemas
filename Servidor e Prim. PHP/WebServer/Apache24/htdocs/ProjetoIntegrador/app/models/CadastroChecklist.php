<?php

class CadastroChecklist
{
    private $pdo;
    private $ultimoErro = null;

    function __construct()
    {
        include_once("Connect.php");
        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    public function ListarTodosChecklists($usuario_id)
    {
        $sql = "SELECT c.id, c.nome, c.criado_em, c.area_id, a.area
                FROM checklists c
                JOIN usuario_areas a ON c.area_id = a.area_id
                WHERE c.usuario_id = :usuario_id
                ORDER BY c.criado_em DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":usuario_id", $usuario_id);

        if ($stmt->execute()) {
            return ($stmt->fetchAll(PDO::FETCH_ASSOC));
        } else {
            return (FALSE);
        }
    }

    public function ListarUmChecklist($id)
    {
        $sql = "SELECT id, nome, area_id FROM checklists WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $checklist = $stmt->fetch(PDO::FETCH_ASSOC);

        $sqlPerguntas = "SELECT id, pergunta FROM checklist_perguntas WHERE checklist_id = :id ORDER BY ordem ASC;";
        $stmtPerguntas = $this->pdo->prepare($sqlPerguntas);
        $stmtPerguntas->bindParam(":id", $id);
        $stmtPerguntas->execute();
        $checklist["perguntas"] = $stmtPerguntas->fetchAll(PDO::FETCH_ASSOC);

        return ($checklist);
    }

    public function CadastrarChecklist($nome, $area_id, $usuario_id, $perguntas)
    {
        try {
            $this->pdo->beginTransaction();

            // 1) insere o checklist e pega o id que o banco gerou
            $sql = "INSERT INTO checklists (nome, area_id, usuario_id)
                    VALUES (:nome, :area_id, :usuario_id) RETURNING id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":area_id", $area_id);
            $stmt->bindParam(":usuario_id", $usuario_id);
            $stmt->execute();
            $checklist_id = $stmt->fetchColumn();

            // 2) insere cada pergunta, ligada a esse checklist_id
            $sqlPergunta = "INSERT INTO checklist_perguntas (checklist_id, pergunta, ordem)
                             VALUES (:checklist_id, :pergunta, :ordem);";
            $stmtPergunta = $this->pdo->prepare($sqlPergunta);

            $ordem = 1;
            foreach ($perguntas as $texto) {
                $stmtPergunta->bindParam(":checklist_id", $checklist_id);
                $stmtPergunta->bindParam(":pergunta", $texto);
                $stmtPergunta->bindParam(":ordem", $ordem);
                $stmtPergunta->execute();
                $ordem++;
            }

            $this->pdo->commit();
            return (TRUE);

        } catch (PDOException $erro) {
            $this->pdo->rollBack();
            $this->ultimoErro = $erro->getMessage();
            return (FALSE);
        }
    }

    public function EditarChecklist($id, $nome, $area_id, $perguntas)
    {
        try {
            $this->pdo->beginTransaction();

            // 1) atualiza os dados do checklist
            $sql = "UPDATE checklists SET nome = :nome, area_id = :area_id WHERE id = :id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":area_id", $area_id);
            $stmt->execute();

            // 2) apaga as perguntas antigas...
            $sqlApagar = "DELETE FROM checklist_perguntas WHERE checklist_id = :id;";
            $stmtApagar = $this->pdo->prepare($sqlApagar);
            $stmtApagar->bindParam(":id", $id);
            $stmtApagar->execute();

            // ...e insere as novas, na ordem que vieram do modal
            $sqlPergunta = "INSERT INTO checklist_perguntas (checklist_id, pergunta, ordem)
                             VALUES (:checklist_id, :pergunta, :ordem);";
            $stmtPergunta = $this->pdo->prepare($sqlPergunta);

            $ordem = 1;
            foreach ($perguntas as $texto) {
                $stmtPergunta->bindParam(":checklist_id", $id);
                $stmtPergunta->bindParam(":pergunta", $texto);
                $stmtPergunta->bindParam(":ordem", $ordem);
                $stmtPergunta->execute();
                $ordem++;
            }

            $this->pdo->commit();
            return (TRUE);

        } catch (PDOException $erro) {
            $this->pdo->rollBack();
            $this->ultimoErro = $erro->getMessage();
            return (FALSE);
        }
    }

    public function ExcluirChecklist($id)
    {
        $sql = "DELETE FROM checklists WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return (TRUE);
        } else {
            $this->ultimoErro = implode(" | ", $stmt->errorInfo());
            return (FALSE);
        }
    }

    public function getUltimoErro()
    {
        return ($this->ultimoErro);
    }
}