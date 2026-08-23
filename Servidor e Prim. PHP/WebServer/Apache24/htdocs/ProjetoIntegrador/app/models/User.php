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
            $_SESSION["nivel_acesso"] = $vetor["nivel_idfk"];

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

    /*MUDAR FOTO; Pega a extensão do arquivo enviado → gera um nome único e seguro baseado no login + timestamp 
    → monta o caminho final → move o arquivo da pasta temporária pra pasta definitiva 
    → devolve o caminho pra ser salvo no banco.*/
    
    private function SalvarFotoPerfil($arquivo, $login, $urlAtual)
    {
        // nenhum arquivo novo enviado (campo vazio) -> mantém a foto atual
        if (!$arquivo || !isset($arquivo['error']) || $arquivo['error'] === UPLOAD_ERR_NO_FILE) {
            return $urlAtual;
        }

        if ($arquivo['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Falha no envio do arquivo. Tente novamente.");
        }

        $tamanhoMaximo = 5 * 1024 * 1024; // 5MB
        if ($arquivo['size'] > $tamanhoMaximo) {
            throw new Exception("A imagem deve ter no máximo 5MB.");
        }

        $tiposPermitidos = ['image/jpeg', 'image/png'];
        $tipoReal = mime_content_type($arquivo['tmp_name']); // valida o conteúdo real do arquivo, não só a extensão do nome
        if (!in_array($tipoReal, $tiposPermitidos, true)) {
            throw new Exception("Envie apenas imagens JPG ou PNG.");
        }
 
        $pastaDestino = "../../public/img/fotos_perfil/";
 
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true);
        }
 
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION); //nome seguro para o arquivo
        $loginLimpo = preg_replace('/[^a-zA-Z0-9_\-]/', '', $login); //limpa o login, removendo qualquer caractere que não seja letra
        $novoNomeArquivo = md5($loginLimpo . time()) . "." . $extensao; //gera um nome novo e único
        $url = "public/img/fotos_perfil/" . $novoNomeArquivo; //onde fica salvo a img
 
        move_uploaded_file($arquivo['tmp_name'], $pastaDestino . $novoNomeArquivo); //onde move o arquivo do temporário para o destino final
 
        return $url;
    }

    public function EditarUsuario($id, $nome, $email, $login, $senha, $cargo, $arquivo, $nivel_idfk, $ativo, $area_acesso, $urlAtual)
    {
        $url = $this->SalvarFotoPerfil($arquivo, $login, $urlAtual);
        $trocarSenha = ($senha !== null && $senha !== '');
 
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, login = :login, cargo = :cargo, url = :url, nivel_idfk = :nivel_idfk, ativo = :ativo, area_acesso = :area_acesso"
                . ($trocarSenha ? ", senha = :senha" : "") . " WHERE id = :id;";
 
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':url', $url);
        $stmt->bindParam(':nivel_idfk', $nivel_idfk);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_BOOL);
        $stmt->bindParam(':area_acesso', $area_acesso);
        $stmt->bindParam(':id', $id);
 
        if ($trocarSenha) {
            $stmt->bindParam(':senha', $senha);
        }
 
        return $stmt->execute();
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