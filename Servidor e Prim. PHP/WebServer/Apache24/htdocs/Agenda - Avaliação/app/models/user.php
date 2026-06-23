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

        public function ValidarLogin($email, $senha)
        {
            $this->login = $email;
            $this->password = $senha;

            $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha AND ativo = TRUE;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $this->login);
            $stmt->bindParam(':senha', $this->password);
            $stmt->execute();
             
            $vetor = $stmt->fetch(PDO::FETCH_ASSOC);
            if(isset($vetor["email"]) && isset($vetor["senha"]))
            {
                $_SESSION["foto"] = $vetor["url"];
                $_SESSION["nome"] = $vetor["nome"];
                return (TRUE);
            }
            else
            {
                return (FALSE);
            }

        }
        public function ListarTodosUsuarios()
        {
            $sql= "SELECT * FROM usuarios ORDER BY id_usuarios ASC;";
            $stmt= $this->pdo->prepare($sql);
            if($stmt->execute())
            {
                $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
                return($result);
            }
            else
            {
                return (FALSE);
            }
        }
        public function ListarUmUsuario($id_usuarios)
        {
            $sql= "SELECT * FROM usuarios WHERE id_usuarios = :id;";
            $stmt= $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id_usuarios);
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

        public function EditarUsuario($id_usuario, $email)
        {
            $sql="UPDATE usuarios SET email = :email WHERE id_usuarios = :id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id_usuario);
            $stmt->bindParam(':email', $email);
            if($stmt->execute())
            {
                echo '<script>
                    alert("Usuário atualizado com sucesso.");
                    window.location.href="http://localhost:8080/painel/app/views/listar_usuario.php";
                    </script>';
            }
            else{
                echo "Erro";
            }
        }

        public function ExcluirUsuario($id_usuario)
        {
            $sql="DELETE FROM usuarios WHERE id_usuarios = :id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id_usuario);
            if($stmt->execute())
            {
                echo '<script>
                    alert("Usuário excluido com sucesso.");
                    window.location.href="http://localhost:8080/painel/app/views/listar_usuario.php";
                    </script>';
            }
            else{
                echo "Erro";
            }
        }

        public function CadastrarUsuario($email, $senha,$nome,$descricao,$arquivo)
        {
            $usuarioLogado = $email;
            $pastaDestino = "../../public/img/fotos_perfil/";

            if (!is_dir($pastaDestino)) 
            {
                mkdir($pastaDestino, 0777, true);
            }

            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $usuarioLimpo = preg_replace('/[^a-zA-Z0-9_\-]/', '', $usuarioLogado);

            // 5. Cria o novo nome:
            $novoNomeArquivo = MD5($usuarioLimpo). "." . $extensao;

            // 6. Define o caminho final completo
            $url = $pastaDestino . $novoNomeArquivo;

            if (move_uploaded_file($arquivo['tmp_name'], $url)) 
            {
                echo "Sucesso: Arquivo salvo como <strong>" . $novoNomeArquivo . "</strong>";
            } 
            else
            {
                echo "Erro: Não foi possível salvar o arquivo.";
            }

            $sql="INSERT INTO usuario (nome, email, senha, descricao, url, ativo ) VALUES (:nome, :email, :senha, :descricao, :url, 'true');";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':url', $url);

            if($stmt->execute())
            {
                echo '<script>
                    alert("Usuário cadastrado com sucesso.");
                    window.location.href="http://localhost/Agenda%20-%20Avaliação/info.html";
                    </script>';

                    return(TRUE);
            }
            else{
                echo "Erro";
                return(FALSE);
            }
        }

    }
?>