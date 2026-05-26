<?php
      
    include_once("../models/User.php");

    $obj = new User();
    $resp = $obj->ListarTodosUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
    <link href="../../public/css/style_listar_usuario.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <div class="container">

        <div class="topo">

            <h1>Usuários</h1>

            <a href="#" class="btn">
                Novo Usuário
            </a>

        </div>

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                </tr>

            </thead>

            <tbody>

                <!-- LOOP PHP -->
                <?php foreach($resp as $usuarios): ?>
                <tr>
                    <td><?= $usuarios["id_usuarios"]; ?></td>
                    <td><?= $usuarios["email"]; ?></td>
                    <td><?= $usuarios["ativo"]; ?></td>

                    <td><a href="editar_usuario.php?var=<?= $usuarios["id_usuarios"]; ?>" class="editar">Editar</a></td>
                    <td><a href="#" class="excluir">Excluir</a></td>
                </tr>
                <?php endforeach ?>

            </tbody>

        </table>

    </div>

</body>
</html>