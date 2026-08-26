<?php

class CadastroAuditoria
{
    private $pdo;
    private $ultimoErro = null;

    function __construct()
    {
        include_once("Connect.php");
        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    // Salva a auditoria completa (capa + itens) numa transação só
    public function SalvarAuditoria($dados)
    {
        try {
            $this->pdo->beginTransaction();

            // 1) Salva a "capa" da auditoria e pega o id gerado
            $sql = "INSERT INTO auditorias
                        (area_id, empresa_id, granja_id, checklist_id, usuario_id,
                         nome_auditor, nome_responsavel,
                         assinatura_auditor_url, assinatura_responsavel_url)
                    VALUES
                        (:area_id, :empresa_id, :granja_id, :checklist_id, :usuario_id,
                         :nome_auditor, :nome_responsavel,
                         :assinatura_auditor_url, :assinatura_responsavel_url)
                    RETURNING id;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(":area_id", $dados["area_id"]);
            $stmt->bindParam(":empresa_id", $dados["empresa_id"]);
            $stmt->bindParam(":granja_id", $dados["granja_id"]);
            $stmt->bindParam(":checklist_id", $dados["checklist_id"]);
            $stmt->bindParam(":usuario_id", $dados["usuario_id"]);
            $stmt->bindParam(":nome_auditor", $dados["nome_auditor"]);
            $stmt->bindParam(":nome_responsavel", $dados["nome_responsavel"]);
            $stmt->bindParam(":assinatura_auditor_url", $dados["assinatura_auditor_url"]);
            $stmt->bindParam(":assinatura_responsavel_url", $dados["assinatura_responsavel_url"]);
            $stmt->execute();

            $auditoriaId = $stmt->fetchColumn();

            // 2) Salva cada item, um de cada vez, vinculado à auditoria recém-criada
            $sqlItem = "INSERT INTO auditoria_itens
                            (auditoria_id, pergunta, pontuacao, observacao, foto_url, ordem)
                        VALUES
                            (:auditoria_id, :pergunta, :pontuacao, :observacao, :foto_url, :ordem);";

            $stmtItem = $this->pdo->prepare($sqlItem);

            $ordem = 1;
            foreach ($dados["itens"] as $item) {
                $stmtItem->bindParam(":auditoria_id", $auditoriaId);
                $stmtItem->bindParam(":pergunta", $item["pergunta"]);
                $stmtItem->bindParam(":pontuacao", $item["pontuacao"]);
                $stmtItem->bindParam(":observacao", $item["observacao"]);
                $stmtItem->bindParam(":foto_url", $item["foto"]);
                $stmtItem->bindParam(":ordem", $ordem);
                $stmtItem->execute();
                $ordem++;
            }

            $this->pdo->commit();
            return $auditoriaId;

        } catch (PDOException $erro) {
            $this->pdo->rollBack();
            $this->ultimoErro = $erro->getMessage();
            return FALSE;
        }
    }

    // Busca os nomes (área, granja/empresa, checklist) pra tela de Revisão mostrar
    public function BuscarResumoRevisao($sessao)
    {
    $resumo = [];

    // A sessão já guarda o nome da área como texto — não precisa buscar no banco
    $resumo["area"] = ucfirst($sessao["area"]);

    // Nome da granja OU da empresa, dependendo de qual foi escolhida
    if ($sessao["local_tipo"] === "granja") {
        $sql = "SELECT nome FROM granjas WHERE id = :id;";
    } else {
        $sql = "SELECT nome FROM empresas WHERE id = :id;";
    }
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(":id", $sessao["local_id"]);
    $stmt->execute();
    $resumo["local_nome"] = $stmt->fetchColumn();

    // Nome do checklist (só existe se veio da Rota B — checklist pronto)
    if ($sessao["checklist_id"] !== null) {
        $sql = "SELECT nome FROM checklists WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $sessao["checklist_id"]);
        $stmt->execute();
        $resumo["checklist_nome"] = $stmt->fetchColumn();
    } else {
        $resumo["checklist_nome"] = "Checklist criado na hora";
    }

    return $resumo;
    }
}