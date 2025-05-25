<?php
include_once('config.php');

// Verifica se um ID foi passado pela URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM livro WHERE id_livro = $id";

    if ($conexao->query($sql) === TRUE) {
        echo "Livro excluído com sucesso.";
    } else {
        echo "Erro ao excluir o livro: " . $conexao->error;
    }
}

$conexao->close();

// Redireciona de volta para o edição do acervo
header("Location: editar_catalogo.php");
exit();
?>