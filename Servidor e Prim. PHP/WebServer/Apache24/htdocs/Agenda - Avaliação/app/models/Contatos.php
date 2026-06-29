<?php

class Contatos
{
    private $pdo;

    function __construct()
    {
        include_once("connect.php");
        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    public function ListarTodosContatos()
    {
        $usuario = $_SESSION["usuario_id"];

        $sql = "SELECT * FROM contatos WHERE usuario_idfk = :usuario ORDER BY id ASC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":usuario", $usuario);

        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ($result);
        } else {
            return (FALSE);
        }
    }

    public function ExcluirContato($id)
    {
        $usuario = $_SESSION["usuario_id"];

        $sql = "DELETE FROM contatos WHERE id = :id AND usuario_idfk = :usuario;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':usuario', $usuario);
        if ($stmt->execute()) {
            echo '<script>
                    alert("Usuário excluido com sucesso.");
                    window.location.href="http://localhost/Agenda%20-%20Avaliação/app/views/contatos.php";
                    </script>';
        } else {
            echo "Erro";
        }
    }

    public function EditarContato($id, $nome, $telefone, $email, $descricao, $usuario)
    {
        $usuario = $_SESSION["usuario_id"];

        $sql = "UPDATE contatos SET nome=:nome, telefone=:telefone, email=:email, descricao=:descricao WHERE id = :id AND usuario_idfk = :usuario;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":usuario", $usuario);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Usuário excluido com sucesso.");
                    window.location.href="http://localhost/Agenda%20-%20Avaliação/app/views/contatos.php";
                    </script>';
        } else {
            echo "Erro";
        }
    }

    public function ListarUmContato($id)
    {
        $usuario = $_SESSION["usuario_id"];

        $sql = "SELECT * FROM contatos WHERE id = :id AND usuario_idfk = :usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":usuario", $usuario);

        if($stmt->execute())
            {
                $result= $stmt->fetch(PDO::FETCH_ASSOC);
                return($result);
            }
            else
            {
                return (FALSE);
            }
    }

    public function CadastrarContato($email, $nome, $telefone, $descricao, $arquivo)
    {
        $usuario_id = $_SESSION["usuario_id"];
        $usuarioLogado = $email;
        $pastaDestino = "../../public/img/fotos_perfil/";

        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true);
        }

        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $usuarioLimpo = preg_replace('/[^a-zA-Z0-9_\-]/', '', $usuarioLogado);

        // 5. Cria o novo nome:
        $novoNomeArquivo = MD5($usuarioLimpo) . "." . $extensao;

        // 6. Define o caminho final completo
        $url = $pastaDestino . $novoNomeArquivo;

        if (move_uploaded_file($arquivo['tmp_name'], $url)) {
            echo "Sucesso: Arquivo salvo como <strong>" . $novoNomeArquivo . "</strong>";
        } else {
            echo "Erro: Não foi possível salvar o arquivo.";
        }

        $sql = "INSERT INTO contatos (nome, email, telefone, descricao, url, usuario_idfk) VALUES (:nome, :email, :telefone, :descricao, :url, :usuario);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':usuario', $usuario_id);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Usuário cadastrado com sucesso.");
                    window.location.href="http://localhost/Agenda%20-%20Avaliação/app/views/contatos.php";
                    </script>';

            return (TRUE);
        } else {
            echo "Erro";
            return (FALSE);
        }
    }
}
