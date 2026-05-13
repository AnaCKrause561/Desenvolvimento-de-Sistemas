<?php
    
    class Aluno
    {
        private string $nome;
        private string $email;

        public function cadastrarAluno($nomeAluno, $emailAluno)
        {
            require_once("Connect.php");
            $obj = new Connect();
            $pdo = $obj->conectarBanco();

            $this->nome = $nomeAluno;
            $this->email = $emailAluno;

            $sql = "INSERT INTO alunos (nome, email) VALUES (:nome, :email);";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':nome',$nomeAluno);
            $stmt->bindValue(':email',$emailAluno);

            $stmt->execute();

            echo "Aluno Cadastrado com sucesso.";
        }
    }
?>