<?php
   $id = $_POST["nPergunta"];
   $arquivo = fopen("PerguntasErespostas.txt", "r") or die("Erro ao abrir o arquivo!");
   $colunaDados = []; 
   while (!feof($arquivo)) {
       $linha = fgets($arquivo);
       $colunaDados = explode(";", $linha);
       if ($colunaDados[0] == $id) {
           break;
       }
   }
   fclose($arquivo);
?>

<!DOCTYPE html>
<html>
   <head>
   <?php include 'menuPeR.html'; ?>   
   </head>
   <body>
       <h1>Digite o que deseja editar:</h1>
       <form action="alterarPeR3.php" method="POST">
           <input type="hidden" name="nPerguntaOriginal" value="<?php echo $id; ?>">
           <input type="text" name="nPergunta" value="<?php echo $colunaDados[0]; ?>">
           <input type="text" name="pergunta" value="<?php echo $colunaDados[1]; ?>">
           <input type="text" name="resposta1" value="<?php echo $colunaDados[2]; ?>">
           <input type="text" name="resposta2" value="<?php echo $colunaDados[3]; ?>">
           <input type="text" name="resposta3" value="<?php echo $colunaDados[4]; ?>">
           <input type="text" name="resposta4" value="<?php echo $colunaDados[5]; ?>">
           <input type="text" name="respostaCorreta" value="<?php echo $colunaDados[6]; ?>">
           <input type="submit" value="Editar" href="alterarPeR3.php">
       </form>
   </body>
</html>
