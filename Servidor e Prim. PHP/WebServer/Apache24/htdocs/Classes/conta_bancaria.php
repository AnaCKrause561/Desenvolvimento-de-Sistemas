<?php

    Class ContaBancaria
    {

        private $usuario;
        private $saldo;

        public function setAbrirConta ($user)
        {
            $this->user = $user;
            $this->valor = 100.00;
        }

        public function setSacar($user, $valor)
        {
            if($this->saldo>=valor)
                {
                    $this->usuario = $user;
                    $this->saldo -= $valor;
                    return("Saque realizado com sucesso!");
                }
            else
                {
                    return("Saldo Insuficiente");
                }
        }

        public function setDepositar($user, $valor)
        {
            if($this->saldo>=$valor)
                {
                    $this->usuario = $user;
                    $this->saldo = saldo + $valor;
                    return ("Deposito realizado com sucesso!")
                }
        }

        public function getConsultarSaldo($user, $valor)
        {
             return ("o usuario é:".$this->usuario."<br/> Seu saldo é:".$this->saldo);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta Bancaria</title>
</head>
<body>
     <form method="post" action="ContaBancaria.php">
        <label>Usuário:</label>   
        <input type="text" name="user" require>
        <br/>
        <label>Valor:</label>   
        <input type="number" name="valor" require>
        <br/>
        <input type="submit" name="Despositar" value="Cadastrar"/>
        <input type="submit" name="Sacar" value="Cadastrar"/>
    </form>    
    
</body>
</html>

<?php

    if($_SERVER["REQUEST_METHOD"]== "POST")
    {
        $minhaConta = new ContaBancaria();
        $minhaConta->setAbrirConta($_POST["user"]);

        if(isset($_POST["sacar"]))
            {
                echo $minhaConta->setSacar($_POST["user"],$_POST["valor"]);
            }
        else
            {
                echo $minhaConta->setDepositar($_POST["user"],$_POST["valor"]);
            }

        echo $minhaConta->getConsultarSaldo();
     }
?>