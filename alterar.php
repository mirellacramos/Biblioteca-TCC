<?php
include_once('config.php');

// Inicializa a variável $livro como um array vazio
$livro = ['titulo' => '', 'autores' => '', 'disp_emprest' => ''];

// Verifica se um ID de livro foi passado
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Se o formulário foi submetido
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autores'];
        $qtd = intval($_POST['disp_emprest']);

        $sql = "UPDATE livro SET titulo = ?, autores = ?, disp_emprest = ? WHERE id_livro = ?";
        $stmt = $conexao->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssii", $titulo, $autor, $qtd, $id);

            if ($stmt->execute()) {
                echo "Livro atualizado com sucesso.";
            } else {
                echo "Erro ao atualizar o livro: " . $stmt->error;
            }
            $stmt->close();
             } else {
            echo "Erro: " . $conexao->error;
        }
    }
    // Pega os dados atuais do livro para preencher o formulário
    $sql = "SELECT titulo, autores, disp_emprest FROM livro WHERE id_livro = ?";
    $stmt = $conexao->prepare($sql);

    if ($stmt) {
        // Liga o parâmetro de ID
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Obtém o resultado
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $livro = $result->fetch_assoc();
        } else {
            echo "Livro não encontrado.";
            exit();
        }
        $stmt->close();
    } else {
        echo "Erro: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar obra</title>
</head>
<body>
    <h1>Editar Livro</h1>
    <form method="POST" action="alterar.php?id=<?php echo $id; ?>">
        <label for="titulo">Título:</label><br>
        <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($livro['titulo']); ?>"><br><br>

        <label for="autores">Autores:</label><br>
        <input type="text" id="autores" name="autores" value="<?php echo htmlspecialchars($livro['autores']); ?>"><br><br>

        <label for="disp_emprest">Disponíveis p/ empréstimo:</label><br>
        <input type="number" id="disp_emprest" name="disp_emprest" value="<?php echo htmlspecialchars($livro['disp_emprest']); ?>"><br><br>

        <input type="submit" value="Atualizar">
    </form>
</body>
</html>