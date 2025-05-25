<?php
session_start();

// Verifica se a sessão do usuário foi feita
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php?msg=Você precisa fazer login para visualizar seus dados de associação.');
    exit;
}

include_once('config.php');

$id_usuario = $_SESSION['id_usuario'];

$sql = "SELECT * FROM associacao WHERE id_associado = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$associado = $result->fetch_assoc();

if (!$associado) {
    echo "Associado não encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $usuario = $_POST['usuario'];
    $novasenha = $_POST['nova_senha'];
    $confirmasenha = $_POST['confirma_senha'];

    if ($novasenha !== $confirmasenha) {
        echo "A nova senha e a confirmação de senha não coincidem.";
        exit;
    }

    if (!empty($novasenha)) {
        $nova_senha_hashed = password_hash($novasenha, PASSWORD_DEFAULT);
    } else {
        $nova_senha_hashed = $associado['senha'];
    }

    $sql_update = "UPDATE associacao SET nome = ?, cpf = ?, email = ?, telefone = ?, cep = ?, usuario = ?, senha = ? WHERE id_associado = ?";
    $stmt_update = $conexao->prepare($sql_update);
    $stmt_update->bind_param("sssssssi", $nome, $cpf, $email, $telefone, $cep, $usuario, $nova_senha_hashed, $id_usuario);

    if ($stmt_update->execute()) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar os dados: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Minha associação</title>
    <link rel="stylesheet" type="text/css" href="minhassociacao.css">
    <script>
        /*elemento p/ opção mostrar senha */
        function togglePasswordVisibility() {
            var novaSenha = document.getElementById("nova_senha");
            var confirmaSenha = document.getElementById("confirma_senha");
            if (novaSenha.type === "password") {
                novaSenha.type = "text";
                confirmaSenha.type = "text";
            } else {
                novaSenha.type = "password";
                confirmaSenha.type = "password";
            }
        }
    </script>
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
            <button type="submit" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="25" fill="red" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                </svg>
            </button>
        </form>
    </header>
    
    <br>
    <h2>Olá, <?php echo htmlspecialchars($associado['nome']); ?>!</h2>
    <br>
    <div id="formulário">
        <form method="POST" action="minhassociacao.php">
            <label for="nome">Nome Completo:</label><br>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($associado['nome']); ?>" required><br>

            <label for="cpf">CPF:</label><br>
            <input type="text" name="cpf" value="<?php echo htmlspecialchars($associado['cpf']); ?>" required><br>

            <label for="email">E-mail:</label><br>
            <input type="text" name="email" value="<?php echo htmlspecialchars($associado['email']); ?>" required><br>

            <label for="telefone">Telefone:</label><br>
            <input type="text" name="telefone" value="<?php echo htmlspecialchars($associado['telefone']); ?>" required><br>

            <label for="cep">CEP:</label><br>
            <input type="text" name="cep" value="<?php echo htmlspecialchars($associado['cep']); ?>" required><br>

            <label for="usuario">Nome de Usuário:</label><br>
            <input type="text" name="usuario" value="<?php echo htmlspecialchars($associado['usuario']); ?>" required><br>

            <label for="nova_senha">Nova Senha: (deixar em branco se não for alterar)</label><br>
            <input type="password" name="nova_senha" id="nova_senha"><br>

            <label for="confirma_senha">Confirme a Nova Senha:</label><br>
            <input type="password" name="confirma_senha" id="confirma_senha"><br><br>

            <input type="checkbox" id="mostrarSenha" onclick="togglePasswordVisibility()">Mostrar Senha<br><br>

            <input type="submit" value="Alterar" id="submit">
        </form>
    </div>
</body>
</html>