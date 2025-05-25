<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $titulo = $_POST['titulo'];

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Exemplo: smtp.gmail.com
        $mail->SMTPAuth = true;
        $mail->Username = 'micorrearamos18@gmail.com';
        $mail->Password = 'iulktmsayzcapzlu';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurações do e-mail
        $mail->setFrom('micorrearamos18@gmail.com', 'Biblioteca');
        $mail->addAddress($email, $nome);
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(false);
        $mail->Subject = "O livro está disponível para empréstimo!";
        $mail->Body = "Olá, $nome!\n\nO livro \"$titulo\" que você reservou está agora disponível para empréstimo. Por favor, compareça à biblioteca para retirá-lo.\n\nAtenciosamente, \nEquipe da Biblioteca.";

        $mail->send();
        echo "E-mail enviado com sucesso para $email!";
        echo '<br><br>';
        echo '<button onclick="window.history.back()">Voltar</button>';
    } catch (Exception $e) {
        echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
}
?>