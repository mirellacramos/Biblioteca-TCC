<?php
session_start();

if (!isset($_SESSION['adm'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associações</title>
    <style>
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
    border: 2px solid white; /* Borda visível ao redor dos botões */
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}
nav ul li a:hover {
    background-color: skyblue;    
}
body {
    font-family: calibri;
    background-color: #f4f4f9;
    display: flex;
    flex-direction: column; 
    align-items: center;
    height: 100vh;
    margin: 0;
}
        .container {
            width: 80%;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: purple;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
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

    <div class="container">
        <h2>Associações</h2>
        <?php
        include_once('config.php');

        $sql = "SELECT * FROM associacao";
        $result = $conexao->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>CEP</th>
                        <th>Senha</th>
                        <th>Nome de Usuário</th>
                        <th>Email</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["nome"]) . "</td>
                        <td>" . htmlspecialchars($row["cpf"]) . "</td>
                        <td>" . htmlspecialchars($row["telefone"]) . "</td>
                        <td>" . htmlspecialchars($row["cep"]) . "</td>
                        <td>" . htmlspecialchars($row["senha"]) . "</td>
                        <td>" . htmlspecialchars($row["usuario"]) . "</td>
                        <td>" . htmlspecialchars($row["email"]) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Nenhum registro encontrado.</p>";
        }
        $conexao->close();
        ?>
    </div>
</body>
</html>