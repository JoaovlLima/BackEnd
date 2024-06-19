<?php
session_start();

// Encerra a sessão (logout)
session_unset();
session_destroy();

// Redireciona de volta para a página de login após logout
header("Location: ../View/Login.php");
exit();
?>
