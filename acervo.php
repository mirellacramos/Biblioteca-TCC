<?php
session_start();
//msg de não logado p/ reserva ou livro disponível
if (isset($_SESSION['mensagem'])) {
    echo "<script>alert('" . $_SESSION['mensagem'] . "');</script>";
    unset($_SESSION['mensagem']); 
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acervo</title>
    <style>
          header {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white;
    padding: 55px; 
    position: relative;
    border-bottom: 2px solid #cccccc;
}
.logo {
    position: absolute;
    left: 20px; 
}
.logo img {
    height: 105px; 
    width: auto; 
}
nav ul {
    list-style-type: none;
    display: flex;
    gap: 30px; 
    margin: 0;
    padding: 0;
}
nav ul li {
    display: inline;
}
nav ul li a {
    text-decoration: none;
    color: purple; 
    font-size: 18px; 
    font-weight: normal;
}
nav ul li a:hover {
    color: #1a1a8b; 
}
.icon {
    position: absolute; 
    top: 20px; 
    right: 55px; 
    font-size: 27px; 
}
.logout{
    position: absolute; 
    top: 20px; 
    right: 10px; 
    font-size: 12px; 
    background-color: white;
    text-align: center;
    border: none;
    cursor: pointer;
}

body {
    background-color: white;
    margin: 0;
    padding: 0;
    font-family: calibri; 
    font-size: 17px;
}
.box-search {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    border-radius: 4px;
}
#lupa {
    background-color: white;
    color: purple;
    border: none;
    cursor: pointer;

}
#lupa .bi-search {
    fill: purple;
}
input {
    color: gray;
    width: 23%;
    height: 27px; 
    border: 2px solid purple; 
    border-radius: 20px; 
    padding: 0 10px; 
}

/*acervo*/
.catalogo-container {
    padding: 0;
    background-color: white;
    width: 100vw; 
    box-sizing: border-box; 
}
table {
    width: 99.5%; 
    border-collapse: collapse; 
    background-color: #f4f4f4;
    margin: 0; 
}
table thead th {
    padding: 6px;
    background-color: #dda0ca;
    border: none; 
    text-align: center; 
}
table tbody tr {
    border-bottom: 1px solid gray; 
}
table tbody tr td {
    padding: 10px;
    color: #333333;
    text-align: center; 
    border: none; 
    font-family: times;
    color:black;
}
table tbody tr td:last-child {
    border-right: none;
}
table tbody tr td a {
    color: #0066cc;
    text-decoration: none;
}
table tbody tr td a:hover {
    text-decoration: underline;
}
td img {
    width: 105px; 
    height: auto; 
    max-height: 145px; 
    object-fit: cover; 
    display: block;
    margin: 0 auto; 
}
td a{
    background-color: #f4f4f4;
    border: 2px solid purple;
    border-radius: 5px;
    padding: 5px 10px;
}
    </style>
</head>

<body>
<header>
        <div class="logo">
            <a href="index.html">
            <img src="icon.png" alt="Logo da Biblioteca">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="index.html"><b>INÍCIO</b></a></li>
                <li><a href="acervo.php"><b>ACERVO</b></a></li>
                <li><a href="associacao.php"><b>ASSOCIE-SE</b></a></li>
                <li><a href="login.php"><b>LOGIN</b></a></li>
                <li><a href="index.html#sobre"><b>SOBRE</b></a></li>
              
            </ul>
        </nav>
        <div class="icon">
            <a href="minhassociacao.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="23" fill="purple" class="bi bi-person-square" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                  </svg> 
            </a>
        </div>
        <form action="logout.php" method="post">
            <button type="submit" class="logout">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="25" fill="red" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                </svg>
            </button>
        </form>
    </header>
    
    <div class="catalogo-container">
    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-custom" id="lupa">
        <svg xmlns='http://www.w3.org/2000/svg' width='17' height='17' fill='currentColor' class='bi bi-search' viewBox='0 0 16 16'>
  <path d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0'/>
</svg>
    </div>
    <br>

    <div>
        <table>
            <thead>
                <tr>
                    <th scope="col">Cód.</th>
                    <th scope="col">Capa</th>
                    <th scope="col">Título</th>
                    <th scope="col">Autor(es)</th>
                    <th scope="col">Gênero(s)</th>
                    <th scope="col">Editora</th>
                    <th scope="col">Ano de publicação</th>
                    <th scope="col">Disponível para empréstimo</th>
                    <th scope="col">ISBN</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                <?php
                include_once('config.php');
                
                $sql = "SELECT * FROM livro ORDER BY titulo ASC";
                //para pesquisar livro
                if(!empty($_GET['search'])){
                    
                    $data = $_GET['search'];
                    $sql = "SELECT * FROM livro WHERE titulo LIKE '%$data%' OR generos LIKE '%$data%' 
OR isbn LIKE '%$data%' OR autores LIKE '%$data%' ORDER BY titulo ASC";
                }else{
                $sql = "SELECT * FROM livro ORDER BY titulo ASC";
                }

                $result = $conexao->query($sql);
                while($row=$result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td>".$row['id_livro']."</td>";
                    echo "<td><img src='".$row["capa"]."'</td>";
                    echo "<td>".$row['titulo']."</td>";
                    echo "<td>".$row['autores']."</td>";
                    echo "<td>".$row['generos']."</td>";
                    echo "<td>".$row['editora']."</td>";
                    echo "<td>".$row['anopubli']."</td>";
                    echo "<td>".$row['disp_emprest']."</td>";
                    echo "<td>".$row['isbn']."</td>";
                    echo "<td><a href='reservar_livro.php?id=" . $row["id_livro"] . "' style='color: black; text-decoration:none;'>Reservar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
            </div>
</body>
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'acervo.php?search='+search.value;
    }
</script>
</html>