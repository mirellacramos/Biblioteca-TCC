<?php
session_start();

if (!isset($_SESSION['adm'])) {
    header('Location: login.php');
    exit;
}
?>

<?php
include_once('config.php');

// Variável para armazenar mensagens
$mensagem = "";

// Verificar se foi solicitado para excluir um livro
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);

    $sql = "DELETE FROM livro WHERE id_livro = ?";
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $mensagem = "Livro excluído com sucesso!";
        } else {
            $mensagem = "Erro ao excluir o livro: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $mensagem = "Erro: " . $conexao->error;
    }
}

// Verificar se foi solicitado para editar um livro
if (isset($_POST['editar'])) {
    $id = intval($_POST['id_livro']);
    $titulo = $_POST['titulo'];
    $autor = $_POST['autores'];
    $qtd = intval($_POST['disp_emprest']);

    $sql = "UPDATE livro SET titulo = ?, autores = ?, disp_emprest = ? WHERE id_livro = ?";
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssii", $titulo, $autor, $qtd, $id);
        if ($stmt->execute()) {
            $sucesso = "Livro atualizado com sucesso!";
        } else {
            $mensagem = "Erro ao atualizar o livro: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $mensagem = "Erro: " . $conexao->error;
    }
    echo "<script>alert('$sucesso');</script>";
}

// Selecionar todos os livros para exibição
$sql = "SELECT id_livro, titulo, autores, disp_emprest FROM livro";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar acervo</title>
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
 
.container {
        display: flex;
        justify-content: space-between; 
        align-items: flex-start; 
        margin-top: 20px;
        }

        /* Tabela de livros */
        table {
            border-collapse: collapse;
            width: 60%; /
            margin: 0 auto;
        }
        td a{
            text-decoration: none;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .button-container {
    display: flex;
    gap: 5px; /* Espaçamento entre os botões */
}
.btn {
    padding: 6px 10px;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    display: inline-block;
}
.btn-delete {
    background-color: #ff0000;
}
.btn-edit {
    background-color: #45a049;
}
.btn:hover {
    opacity: 0.8;
}
        /* Formulário de edição */
        .form-edicao {
            width: 35%; 
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
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

   <div style="text-align: left; margin-top: 15px;">
    <a href="acervo.php" style="color: black; text-decoration: none; font-size: 18px;">
        <p><b>&nbsp;Ir para o acervo</b></p>
    </a>
   </div>

    <!--mensagem de confirmação de atualização -->
    <?php if (!empty($mensagem)): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <div class="container">
    <table border="1">
        <thead>
            <tr>
                <th>Cód.</th>
                <th>Título</th>
                <th>Autores</th>
                <th>Disponíveis p/ empréstimo</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php while ($livro = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($livro['id_livro']); ?></td>
                    <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($livro['autores']); ?></td>
                    <td><?php echo htmlspecialchars($livro['disp_emprest']); ?></td>
                    <td>
    <!--botoes tabela-->
    <div class="button-container">
        <a href="editar_catalogo.php?excluir=<?php echo $livro['id_livro']; ?>" 
           class="btn btn-delete" 
           onclick="return confirm('Tem certeza que deseja excluir este livro?');">
           Excluir
        </a>
        <a href="editar_catalogo.php?editar=<?php echo $livro['id_livro']; ?>" 
           class="btn btn-edit">
           Editar
        </a>
    </div>
</td>
    </tr>
    <?php endwhile; ?>
    </tbody>
    </table>

    <!-- Formulário de edição de livro -->
    <?php if (isset($_GET['editar'])):
        $id_livro = intval($_GET['editar']);
        $sql = "SELECT titulo, autores, disp_emprest FROM livro WHERE id_livro = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id_livro);
        $stmt->execute();
        $result = $stmt->get_result();
        $livro = $result->fetch_assoc();
        $stmt->close();
    ?>

    <div class="form-edicao">
    <h2>Editar Livro</h2>
    <br>
    <form method="POST" action="editar_catalogo.php">
        <input type="hidden" name="id_livro" value="<?php echo $id_livro; ?>">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($livro['titulo']); ?>"><br><br>

        <label for="autores">Autores:</label><br>
        <input type="text" id="autores" name="autores" value="<?php echo htmlspecialchars($livro['autores']); ?>"><br><br>

        <label for="disp_emprest">Disponível p/ empréstimo:</label><br>
        <input type="number" id="disp_emprest" name="disp_emprest" value="<?php echo htmlspecialchars($livro['disp_emprest']); ?>"><br><br>

        <input type="submit" name="editar" value="Atualizar">
    </form>
    <?php endif; ?>
</body>
</html>