<?php
    class User
    {
        private string $usuario;
        private string $password;
        private $pdo;

        public function_construct()
        {
            include_once("Connect.php");
            $obj = new Connect();
            $this->pdo = $obj->conectarBanco();
        }

        public function getUser($param1,$param2)
        {
            $this->usuario = $param1;
            $this->password = $param2;

            $sql = "SELECT * FROM users WHERE login =:login AND password = :pass AND ativo = true;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':login', $this->usuario);
            $stmt->bindValue(':pass', $this->password);

            if($stmt->execute())
            {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result["login"] == $this->usuario)
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
            else
                return FALSE;
        }
    }
?>