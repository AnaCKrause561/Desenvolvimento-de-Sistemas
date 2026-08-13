<?php

class User
{
    private string $login;
    private string $password;
    private $pdo;

    function __construct()
    {
        include_once("connect.php");
        $conexao = new Connect();
        $this->pdo = $conexao->conectarBanco();
    }

    public function ValidarLogin($login, $senha)
    {
        $this->login = $login;
        $this->password = $senha;

        $sql = "SELECT * FROM usuarios WHERE login = :login AND senha = :senha AND ativo = TRUE;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':login', $this->login);
        $stmt->bindParam(':senha', $this->password);
        $stmt->execute();

        $vetor = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($vetor["login"]) && isset($vetor["senha"])) {
            $_SESSION["foto"] = $vetor["url"];
            $_SESSION["nome"] = $vetor["nome"];
            $_SESSION["login"] = $vetor["login"];
            $_SESSION["usuario_id"] = $vetor["id"];
            $_SESSION["nivel_acesso"] = $vetor["nivel_acesso"];

            return (TRUE);
        } else {
            return (FALSE);
        }
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
        $sql = "SELECT * FROM usuarios WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return ($result);
        } else {
            return (FALSE);
        }
    }

    public function EditarUsuario($nome, $email, $login, $senha, $cargo, $arquivo, $nivel_acesso, $criado_em, $ativo, $areas)
    {
        $sql = "UPDATE usuarios SET login = :login WHERE id = :id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':arquivo', $arquivo);
        $stmt->bindParam(':nivel_acesso', $nivel_acesso);
        $stmt->bindParam(':criado_em', $criado_em);
        $stmt->bindParam(':ativo', $ativo);
        $stmt->bindParam(':areas', $areas);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Usuário atualizado com sucesso.");
                    window.location.href="http://localhost/ProjetoIntegrador/app/views/cadastros.php";
                    </script>';
        } else {
            echo "Erro";
        }
    }

    public function ExcluirUsuario($id)
    {
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

    public function CadastrarUsuario($nome, $email, $login, $senha, $cargo, $arquivo, $nivel_idfk, $criado_em, $ativo, $areas)
    {

        $url = null;

        if ($arquivo && $arquivo['error'] === UPLOAD_ERR_OK) {
            $pastaDestino = "../../public/img/fotos_perfil/";

            if (!is_dir($pastaDestino)) {
                mkdir($pastaDestino, 0777, true);
            }

            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $loginLimpo = preg_replace('/[^a-zA-Z0-9_\-]/', '', $login);
            $novoNomeArquivo = md5($loginLimpo . time()) . "." . $extensao;
            $url = "public/img/fotos_perfil/" . $novoNomeArquivo;

            move_uploaded_file($arquivo['tmp_name'], $pastaDestino . $novoNomeArquivo);
        }

        $sql = "INSERT INTO usuarios (nome, email, login, senha, cargo, url, nivel_idfk, ativo, area_acesso, criado_em)
            VALUES (:nome, :email, :login, :senha, :cargo, :url, :nivel_idfk, :ativo, :area_acesso,  :criado_em);";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':nivel_idfk', $nivel_idfk);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_BOOL);
        $stmt->bindParam(':area_acesso', $areas[0]);
        $stmt->bindParam(':criado_em', $criado_em);

        if ($stmt->execute()) {
            return (TRUE);
            } else {
            return (FALSE);
        }
    }
}