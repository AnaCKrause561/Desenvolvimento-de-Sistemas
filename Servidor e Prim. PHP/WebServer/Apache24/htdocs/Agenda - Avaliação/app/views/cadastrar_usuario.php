<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../public/css/Cadastro.css" />
    <title>Cadastro</title>
</head>

<body>

    <div class="container">

        <!-- Lado esquerdo -->
        <div class="lado_esquerdo">

            <div class="overlay"></div>

            <div class="conteudo_esquerdo">

                <h1>Cadastre-se!</h1>
                <p>Preencha os dados ao lado para se cadastrar.</p>

            </div>

        </div>

        <!-- Lado direito -->
        <div class="lado_direito">

            <div class="formulario">

                <form>

                    <div class="foto_perfil">

                        <img src="../../public/img/login.png" alt="Conecte-se">

                        <div class="campo_foto">
                            <label>Foto de Perfil</label>
                            <input type="file" accept="image/*">
                        </div>

                    </div>

                    <label>Nome Completo</label>
                    <input type="text" placeholder="Digite seu nome">

                    <label>E-mail</label>
                    <input type="email" placeholder="Digite seu e-mail">

                    <label>Telefone</label>
                    <input type="tel" placeholder="(46) 99999-9999">

                    <label>Descrição Pessoal</label>
                    <textarea placeholder="Fale um pouco sobre você"></textarea>

                    <input type="submit" value="Cadastrar">

                </form>

                <p class="cadastro">Já possui uma conta? <a href="../../info.html">Entrar</a></p>
            </div>
        </div>
    </div>

</body>

</html>