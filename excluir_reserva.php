<?php
include_once('config.php');

// Verifica se o ID da reserva foi enviado
if (isset($_POST['id_reserva'])) {
    $id_reserva = $_POST['id_reserva'];

    $sql = "DELETE FROM reservas WHERE id_reserva = ?";

    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param("i", $id_reserva);

        if ($stmt->execute()) {
            // Redireciona para a página de lista de reservas após a exclusão
            header("Location: restrito_reservas.php");
            exit();
        } else {
            echo "Erro ao excluir a reserva.";
        }
        $stmt->close();
    }
}
$conexao->close();
?>