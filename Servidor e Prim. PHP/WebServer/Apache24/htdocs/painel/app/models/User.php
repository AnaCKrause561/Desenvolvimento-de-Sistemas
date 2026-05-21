<?php
    class User 
    {
        private string $login; /*o que ele vai receber da pág login*/
        private string $password;
        private $pdo; /*criando uma vriavel para receber*/ 

        public function __construct() /*para fazer conexão com o banco de dados*/
        {
            include_once("Connect.php"); /*conecta com o banco - doc Connect*/ 
            $conexao = new Connect(); /*instaciou a classe - se trounou um obj*/ 
            $this->pdo = $conexao->conectarBanco();
        }

        public function ValidarLogin($email, $senha)
        {
            $this->login = $email; /*parâmetro*/ 
            $this->password = $senha;

            $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha AND ativo = TRUE;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $this->login);
            $stmt->bindParam(':senha', $this->password);
            $stmt->execute();

            $vetor = $stmt->fetch(PDO::FETCH_ASSOC);
            if(isset ($vetor["email"]) && isset ($vetor["senha"]))
            {
                return (TRUE);
            }
            else
            {
                return (FALSE);
            }
        }
    }
?>