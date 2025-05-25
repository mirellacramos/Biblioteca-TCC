<?php
session_start();

// Verifica se o administrador não está logado
if (!isset($_SESSION['adm'])) {
    header('Location: login.php');
    exit;
}
?>

<?php
if(isset($_POST['submit'])){
    include_once('config.php');
    
    $capa = $_POST['capa'] ?? ''; 
    $isbn = $_POST['isbn'] ?? '';   
    $titulo = $_POST['titulo'] ?? '';  
    $autores = $_POST['autores'] ?? '';
    $generos = $_POST['generos'] ?? '';   
    $editora = $_POST['editora'] ?? '';
    $anopubli = $_POST['anopubli'] ?? '';   
    $disp_emprest = $_POST['disp_emprest'] ?? '';

    $stmt = $conexao->prepare("INSERT INTO livro (capa, isbn, titulo, autores, generos, editora, anopubli, disp_emprest)
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssii", $capa, $isbn, $titulo, $autores, $generos, $editora, $anopubli, $disp_emprest);

    if($stmt->execute()){
        echo "Livro adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar livro: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Livro</title>
    <style>
         body{
            background-color: white;
            font-family: calibri;
            font-size: 17px;
        }
       * {
    margin: 0;
    padding: 0;
    box-sizing: border-box; 
}
        header {
    width: 100%; 
    background-color: plum;
    padding: 22px 0;
    text-align: center;
}
nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}
nav ul li {
    display: inline-block;
    margin: 0 15px;
}
nav ul li a {
    text-decoration: none;
    color: purple;
    background-color: plum;
    font-weight: bold;
    padding: 8px 16px;
    border: 2px solid white; 
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}
nav ul li a:hover {
    background-color: skyblue;
}

/*form*/
#formulário {
  width: 33%; 
  margin: 0 auto; 
  padding: 13px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  background-color:  #f4f4f4;
}
#formulário h2 {
  text-align: center;
}
#formulário label {
  display: block;
  margin-bottom: 5px;
}
#formulário input[type="text"],
#formulário input[type="number"] {
  width: 100%;
  padding: 6px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
#formulário input[type="submit"] {
  background-color: #4CAF50;
  color: black;
  padding: 10px 20px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
}
#formulário input[type="submit"]:hover {
  background-color: #45a049;
}
h3{
    font-family: calibri;
    color: purple;
    text-align: center;
}
#submit{
    font-weight: bold
}
    </style>
</head>

<body>
<header>
   <nav>
            <ul>
                <li><a href="adicionar_livros.php">Adicionar livros</a></li>
                <li><a href="restrito_reservas.php">Reservas</a></li>
                <li><a href="editar_catalogo.php">Editar acervo</a></li>
                <li><a href="ver_associacoes.php">Associações</a></li>
            </ul>
        </nav>
   </header>
   
   <br><br>
   <div id="formulário">
    <h3>Adicionar novo livro</h3>
    <form action="adicionar_livros.php" method="POST">
        <label for="capa">Capa:</label>
        <input type="text" id="capa" name="capa" required><br><br>

        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" required><br><br>

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="autores">Autores:</label>
        <input type="text" id="autores" name="autores" required><br><br>

        <label for="generos">Gêneros:</label>
        <input type="text" id="generos" name="generos" required><br><br>

        <label for="editora">Editora:</label>
        <input type="text" id="editora" name="editora" required><br><br>

        <label for="anopubli">Ano de publicação:</label>
        <input type="number" id="anopubli" name="anopubli" required><br><br>

        <label for="disp_emprest">Disponível para empréstimo:</label>
        <input type="number" id="disp_emprest" name="disp_emprest" required><br><br>

        <input type="submit" name="submit"  id="submit" value="Adicionar">
    </form>
</div>
<br>
</body>
</html>