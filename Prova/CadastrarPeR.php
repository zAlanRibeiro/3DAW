<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST')  {
    $id = $_POST["nPergunta"];
    $pergunta = $_POST["pergunta"];
    $r1 = $_POST["resposta1"];
    $r2 = $_POST["resposta2"];
    $r3 = $_POST["resposta3"];
    $r4 = $_POST["resposta4"];
    $rC = $_POST["respostaCorreta"];
    
    if (!file_exists("PerguntasErespostas.txt")) {
        $arquivo = fopen("PerguntasErespostas.txt","w") or die("erro ao criar arquivo");
        $linha = "nPergunta;pergunta;resposta1;resposta2;resposta3;resposta4;respostaCorreta\n";
        fwrite($arquivo,$linha);
        fclose($arquivo);
    }
    
    $arquivo = fopen("PerguntasErespostas.txt","a") or die("erro ao abrir arquivo");
    
    $linha = $id . ";" . $pergunta . ";" . $r1 . ";" . $r2 . ";" . $r3 . ";" . $r4 . ";". $rC . "\n";
    fwrite($arquivo,$linha);
    fclose($arquivo);
    
    $msg = "Pergunta Registrada!";
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include 'menuPeR.html'; ?>   
</head>
<body>
<h1>Registro de Questionário</h1>
<form action="CadastrarPeR.php" method="POST">
    Número da Pergunta: <input type="text" name="nPergunta">
    <br><br>
    Pergunta: <input type="text" name="pergunta">
    <br><br>
    Resposta 1: <input type="text" name="resposta1">
    <br><br>
    Resposta 2: <input type="text" name="resposta2">
    <br><br>
    Resposta 3: <input type="text" name="resposta3">
    <br><br>
    Resposta 4: <input type="text" name="resposta4">
    <br><br>
    Resposta Correta: <input type="text" name="respostaCorreta">
    <br><br>
    <input type="submit" value="Registrar Questionário!">
</form>
<p><?php echo $msg ?></p>
<br>
</body>
</html>
