<?php
session_name("ProjetoIntegrado");
session_start();

// limpa todas as variáveis da sessão
$_SESSION = [];

// apaga o cookie de sessão no navegador (evita sessão "fantasma")
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// apaga os dados da sessão no servidor
session_destroy();

// redireciona pra tela de login
header("Location: ../../index.html");
exit;