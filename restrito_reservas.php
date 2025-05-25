<?php
session_start();
// Verifica se o administrador está logado
if(!isset($_SESSION['adm'])) {
    header('Location: login.php');
    exit;
}
?>

<?php
include_once('config.php');
//pega os dados das tabelas que vão ser exibidos
$sql = "
    SELECT reservas.id_reserva, reservas.associado_id, associacao.nome, associacao.email, reservas.livro_id, livro.titulo, livro.disp_emprest, reservas.data
    FROM reservas
    JOIN associacao ON reservas.associado_id = associacao.id_associado
    JOIN livro ON reservas.livro_id = livro.id_livro
";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
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
body {
    background-color: white;
    font-family: Calibri, sans-serif;
    font-size: 17px;
    margin: 0;
    padding: 0;
}
* {
    box-sizing: border-box; 
}

/* Cabeçalho */
header {
    width: 100%;
    background-color: plum;
    padding: 22px 0;
    text-align: center;
}
nav ul {
    list-style: none;
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

/* Tabela */
table {
    border-collapse: collapse;
    width: 80%;
    margin: 20px auto;
    border: 1px solid #ccc;
}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}
th {
    background-color: #f2f2f2;
}
#reservas {
    color: purple;
}
td {
    vertical-align: middle;
}

/* Botões */
button.excluir,
button.notificar {
    color: #fff;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
button.excluir {
    background-color: #ff0000; 
}

button.excluir:hover {
    background-color: #cc0000; 
}

button.notificar {
    background-color: #007bff; 
}

button.notificar:hover {
    background-color: #0056b3; 
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
<table>
    <thead>
        <tr>
            <th id="reservas" colspan="9">Reservas</th>
        </tr>
        <tr>
            <th>ID do Associado</th>
            <th>Nome do Associado</th>
            <th>Email do Associado</th>
            <th>ID do Livro</th>
            <th>Título do Livro</th>
            <th>Disponiveis p/ empréstimo</th>
            <th>Data da Reserva</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['associado_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['livro_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($row['disp_emprest']); ?></td>
                    <td><?php echo htmlspecialchars($row['data']); ?></td>
                    <td>
                        <form action="excluir_reserva.php" method="POST">
                            <input type="hidden" name="id_reserva" value="<?php echo $row['id_reserva']; ?>">
                            <button type="submit" class="excluir">Excluir</button>
                        </form>
                    </td>
                    <td>
                        <form action="enviar_email.php" method="POST">
                            <input type="hidden" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">
                            <input type="hidden" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>">
                            <input type="hidden" name="titulo" value="<?php echo htmlspecialchars($row['titulo']); ?>">
                            <button type="submit" class="notificar">Notificar Disponibilidade</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php
$conexao->close();
?>
</body>
</html>