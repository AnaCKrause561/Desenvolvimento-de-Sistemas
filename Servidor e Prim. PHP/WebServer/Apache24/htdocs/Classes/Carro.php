<?php

    class Carro /*Criar uma classe*/
    {
        private $cor;  /*Atributos, que podem ser publico, privado e protegido*/
        private $placa;
        private $modelo;

        public function setCaracteristicas($param1, $param2, $param3) /*Método, cadastra*/
        {
            $this->cor = $param1;
            $this->placa = $param2;
            $this->modelo = $param3;
        }

        public function getCaracteristicas() /*Método, exibe*/
        {
            return "A cor do carro é: ".$this->cor. "<br/>". 
            "A placa do carro é: ".$this->placa. "<br/>". 
            "O modelo do carro é: ".$this->modelo. "<br/>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Classe</title>
</head>

<body>
    <form method="post" action="Carro.php"> <!--metodo de como o fomulário vai ser enviado-->
        <label>Cor:</label>
        <input type="text" name="cor"/>
        <br/>

        <label>Placa:</label>
        <input type="text" name="placa"/>
        <br/>
        
        <label>Modelo:</label>
        <input type="text" name="modelo"/>
        <br/>

        <input type="submit" name="Enviar" value="Cadastrar" />
    </form>

</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") /*Server (var super global), se clicaram no cadastro*/
    {
        if(empty($_POST["cor"]) || empty($_POST["placa"]) || empty($_POST["modelo"])) /*verificar se tem algo na var, e extrai o que está no POST*/
        {
            echo "<b><i>Você deve cadastrar um veículo</i></b>";
        }
        
        else
        {
            $meuCarro = new Carro(); /*Estanciada, a classe passa a ser seu*/
            $meuCarro->setCaracteristicas($_POST["cor"], $_POST["placa"], $_POST["modelo"]); /*Enviando para set*/

            echo $meuCarro->getCaracteristicas(); /*mostrando o que ja tem*/
        }
    }
?>