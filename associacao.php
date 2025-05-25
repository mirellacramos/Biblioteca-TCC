<?php
    if(isset($_POST['submit'])){
        include_once('config.php');
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $cep = $_POST['cep'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

        $result = mysqli_query($conexao, "INSERT INTO associacao(nome,cpf,email,telefone,cep,usuario,senha) 
        VALUES ('$nome','$cpf','$email','$telefone','$cep','$usuario','$senha')");
          if ($result) {
            echo "<script>
                    alert('Associação concluída com sucesso!');
                    document.querySelector('form').reset();
                  </script>";
        } else {
            echo "<script>alert('Erro ao concluir a associação. Tente novamente.');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="associacao.css">
    <title>Associação</title>
 
</head>
<body>
<header>
        <div class="logo">
            <a href="index.html">
            <img src="icon.png" alt="Logo da Biblioteca"></a>
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

    <div class="box">
        <form action="associacao.php" method="POST">
            <fieldset>
                <legend><b>Dados para associação</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome completo</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" required>
                    <label for="cpf" class="labelInput">CPF</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="cep" name="cep" id="cep" class="inputUser" required>
                    <label for="cep" class="labelInput">CEP</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="usuario" id="usuario" class="inputUser" required>
                    <label for="usuario" class="labelInput">Nome de Usuário</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>