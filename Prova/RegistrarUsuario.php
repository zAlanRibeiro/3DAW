<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    
    if (!file_exists("usuario.txt")) {
        $arquivo = fopen("usuario.txt","w") or die("erro ao criar arquivo");
        $linha = "nome;email;senha;\n";
        fwrite($arquivo,$linha);
        fclose($arquivo);
    }
    
    $arquivo = fopen("usuario.txt","a") or die("erro ao abrir arquivo");
    
    $linha = $nome . ";" . $email . ";" . $senha . "\n";
    fwrite($arquivo,$linha);
    fclose($arquivo);
    
    $msg = "Usuário Registrado!";
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php include 'menuPeR.html'; ?>   
    <h1>Registro de Usário</h1>
    <form action="RegistrarUsuario.php" method="POST">
        Nome: <input type="text" name="nome">
        <br><br>
        Email: <input type="text" name="email" placeholder="exemplo@gmail.com">
        <br><br>
        Senha: <input type="text" name="senha">
        <br><br>
        <input type="submit" value="Registrar!">
    </form>
    <p><?php echo $msg ?></p>
    <br>
</body>
</html>
