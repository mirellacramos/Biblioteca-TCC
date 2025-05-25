<?php
session_start();
include_once('config.php');

if (isset($_POST['submit'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha']; 

    // Verifica se é o administrador
    if ($usuario === 'admuser' && $senha === 'admpass') {
        $_SESSION['adm'] = 'adm'; 
        header("Location: restrito.php"); 
        exit();
    } else {
        // Evita SQL Injection
        $usuario = $conexao->real_escape_string($usuario);
        $senha = $conexao->real_escape_string($senha);
        //verifica se o usuário já fez associação
        $sql = "SELECT id_associado FROM associacao WHERE usuario = '$usuario' AND senha='$senha'";
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['id_usuario'] = $row['id_associado'];
            header("Location: index.html"); 
            exit();
        } else {
            $_SESSION['login_error'] = "Usuário ou senha incorretos.";
            header("Location: login.php"); 
            exit();
        }
    }
}
?>