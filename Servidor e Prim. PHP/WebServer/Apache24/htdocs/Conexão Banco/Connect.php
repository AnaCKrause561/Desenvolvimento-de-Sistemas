<?php
    class Connect
    {
        private $host; //End onde o servidor de bancos de dados está instalado.
        private $dbname; //Nome da base de dados que iremos utilizar.
        private $password; //Senha do meu banco de dados.
        private $user; //É o usuário do banco de dados no postgre é admin.
        private $port; //Porta onde é executado as conexões com o banco de dados o padrão do Postgre é 5432.

        function __construct()
        {
            $this->host = "localhost";
            $this->dbname = "teste";
            $this->password = "123";
            $this->user = "postgres";
            $this->port = "5432";
        }

        public function conectarBanco()
        {
            try
            {
                $PDO = new PDO("pgsql:host=".$this->host.";port=".$this->port.";dbname=".$this->dbname,$this->user,$this->password);
                ///echo "Eu sou boa";
                return($PDO);
            }
            catch(PDOException $erro)
            {
                $msg = "Falha no acesso com o PostGres:".$erro->getMessage();
                echo $msg;
                return(NULL);
            }
        }

    }
?>