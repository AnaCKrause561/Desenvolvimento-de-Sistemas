<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos</title>
</head>

<body>
    <h1> Cadastro de Aluno </h1>
    <form method="post" action="salvar.php">
        <label>Nome do Aluno</label>
        <input type="text" name="nome" placeholder="Digite o nome" />
        <br />
        <label>E-mail:</label>
        <input type="email" name="email" placeholder="Digite o e-mail" />
        <br />
        <input type="submit" name="cadastrar" placeholder="Cadastrar" />
    </form>
</body>
</html>
