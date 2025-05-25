
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
    background-color: plum;
    margin: 0;
    padding: 0;
    font-family: calibri; 
    font-size:17px;
}
header {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white; 
    padding: 55px; 
    position: relative;
}
.logo {
    position: absolute;
    left: 20px;
}
.logo img {
    height: 105px; 
    width: auto; 
}
nav ul {
    list-style-type: none;
    display: flex;
    gap: 30px; 
    margin: 0;
    padding: 0;
}
nav ul li {
    display: inline;
}
nav ul li a {
    text-decoration: none;
    color: purple; 
    font-size: 18px; 
    font-weight: normal;
}
nav ul li a:hover {
    color: #551a8b; 
}
.icon {
    position: absolute; 
    top: 20px; 
    right: 55px; 
    font-size: 27px; 
}
.btn{
    position: absolute; 
    top: 20px; 
    right: 10px; 
    font-size: 12px; 
    background-color: white;
    text-align: center;
    border: none;
    cursor: pointer;
}

/*login*/
        .box{
            color: white;
            position: absolute;
            top: 60%; 
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.5);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
        }
        fieldset{
            border: 3px solid rgb(210, 160, 221);
        }
        legend{
            border: 1px solid rgb(210, 160, 221);
            padding: 10px;
            text-align: center;
            background-color: rgb(210, 160, 221);
            border-radius: 8px;
            color: black
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: plum;
        }
        #submit{
            background-image: linear-gradient(to right,rgb(161, 0, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(89, 0, 172), rgb(19, 66, 195));
        }
        #togglePassword {
    cursor: pointer;
}
    </style>
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

<?php
// Obtém a mensagem da URL, se houver
if (isset($_GET['msg'])) {
    $mensagem = $_GET['msg'];
    echo "<p>$mensagem</p>";
}
?>

    <div class="box">
        <form action="testelogin.php" method="POST">
            <fieldset>
                <legend><b>Login</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="usuario" id="usuario" class="inputUser" required>
                    <label for="usuario" class="labelInput">Usuário</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br>
                <input type="submit" name="submit" id="submit" value="Entrar">
            </fieldset>
        </form>

        <?php
    // Exibe a mensagem de usuário ou senha incorretos se der erro
    if (isset($_SESSION['login_error'])) {
        echo '<p style="color:white;">' . $_SESSION['login_error'] . '</p>';
        unset($_SESSION['login_error']); // Limpa a mensagem após exibí-la
    }
    ?>
</div>
</body>
</html>