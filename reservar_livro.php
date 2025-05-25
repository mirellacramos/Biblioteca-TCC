<?php 
include_once('config.php');
session_start();

//se é feito o login, é possível realizar a reserva
if (isset($_SESSION['id_usuario'])) {
    $id_associado = $_SESSION['id_usuario'];
    $id_livro = intval($_GET['id']);
    
    $stmt = $conexao->prepare("SELECT disp_emprest FROM livro WHERE id_livro = ?");
    $stmt->bind_param("i", $id_livro);
    $stmt->execute();
    $stmt->bind_result($dispEmprest);
    $stmt->fetch();
    $stmt->close();
    
    if ($dispEmprest == 0) {
        $stmt = $conexao->prepare("INSERT INTO reservas (livro_id, associado_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $id_livro, $id_associado);

        if ($stmt->execute()) {
            // Armazena a mensagem na sessão
            $_SESSION['mensagem'] = "Reserva realizada com sucesso! Entraremos em contato quando a obra estiver disponível.";
        } else {
            $_SESSION['mensagem'] = "Erro ao realizar reserva: " . $stmt->error;
        }
    } else {
        $_SESSION['mensagem'] = "Esta obra está disponível no momento. Somente é possível reservar obras indisponíveis.";
    }
} else {
    $_SESSION['mensagem'] = "Você precisa estar logado para reservar.";
}

$conexao->close();

header("Location: acervo.php");
exit();
?>