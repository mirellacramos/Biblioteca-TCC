<?php
session_start();

if (!isset($_SESSION['adm'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restrito</title>
    <style>
        body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: calibri;
    font-size: 17px;
    background-color: plum;
}
.container {
    display: flex;
    gap: 20px; 
}
a {
  text-decoration: none;
  color: purple;
  background-color: plum;
  padding: 13px 28px;
  border-radius: 5px;
  font-size: 18px;
  transition: background-color 0.3s;
  border: 2px solid white; 
}
a:hover {
    background-color: skyblue;
}
    </style>
</head>

<body>
    <div class="container">
        <h2><a href="adicionar_livros.php">Adicionar livros</a></h2>
        <h2><a href="restrito_reservas.php">Reservas</a></h2>
        <h2><a href="editar_catalogo.php">Editar Acervo</a></h2> 
        <h2><a href="ver_associacoes.php">Associações</a></li></h2>
    </div>
</body>
</html>