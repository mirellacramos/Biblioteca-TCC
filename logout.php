<?php
session_start(); 
session_unset(); // Remover todas as variáveis de sessão
session_destroy(); // Destruir a sessão

header("Location: index.html"); 
exit();
?>