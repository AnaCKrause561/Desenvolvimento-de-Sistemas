<?php

class CadastroUsuario
{
    private $pdo;

    function __construct()
    {
        include_once("Connect.php");
        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    public function ListarTodosUsuarios()
    {        
        $sql = "SELECT * FROM usuarios ORDER BY id ASC;";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return ($result);
        } else {
            return (FALSE);
        }
    }

        public function ListarUmUsuario($id)
    {
        $usuario = $_SESSION["usuario_id"];

        $sql = "SELECT * FROM usuarios WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);

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

    public function ExcluirUsuario($id)
    {
        $usuario = $_SESSION["usuario_id"];

        $sql = "DELETE FROM usuarios WHERE id = :id;";
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

    public function EditarUsuario($id, $nome, $email, $cargo, $nivel_acesso, $ativo)
    {
        $usuario = $_SESSION["usuario_id"];

        $sql = "UPDATE usuarios SET nome = :nome, email = :email, cargo = :cargo, nivel_acesso = :nivel_acesso, ativo = :ativo WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":cargo", $cargo);
        $stmt->bindParam(":nivel_acesso", $nivel_acesso);
        $stmt->bindParam(":ativo", $ativo, PDO::PARAM_BOOL);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Usuário excluido com sucesso.");
                    window.location.href="http://localhost/ProjetoIntegrador/app/views/cadastros.php";
                    </script>';
        } else {
            echo "Erro";
        }
    }

    public function CadastrarUsuario($nome, $email, $login, $senha, $cargo, $arquivo, $nivel_acesso, $criado_em, $ativo)
    {
        $usuario_id = $_SESSION["usuario_id"];
        $usuarioLogado = $login;
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

         // Mantido em MD5 para bater com o login.php que já está em produção
        $senhaHash = md5($senha);

        $sql = "INSERT INTO usuarios (nome, email, login, senha, cargo, url, nivel_acesso, ativo, criado_em) VALUES (:nome, :email, :login, :senha, :cargo, :url, :nivel_acesso, :ativo, :criado_em);";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':nivel_acesso', $nivel_acesso);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_BOOL);
        $stmt->bindParam(':criado_em', $criado_em);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Usuário cadastrado com sucesso.");
                    window.location.href="http://localhost/ProjetoIntegrador/app/views/cadastros.php";
                    </script>';

            return (TRUE);
        } else {
            echo "Erro";
            return (FALSE);
        }

        $usuarioId = $this->pdo->lastInsertId('usuarios_id_seq');

        // Grava as áreas de atuação marcadas (tabela usuario_areas)
        if (!empty($_POST['usuarioAreas']) && is_array($_POST['usuarioAreas'])) {
            $sqlArea = "INSERT INTO usuario_areas (usuario_id, area) VALUES (:usuario_id, :area);";
            $stmtArea = $this->pdo->prepare($sqlArea);
 
            foreach ($_POST['usuarioAreas'] as $area) {
                $stmtArea->bindParam(':usuario_id', $usuarioId);
                $stmtArea->bindParam(':area', $area);
                $stmtArea->execute();
            }
        }
 
        return TRUE;
    }
}