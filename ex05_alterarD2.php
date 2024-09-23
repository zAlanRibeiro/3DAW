<?php
   $materia = $_POST ["materia"];
   $arquivo = fopen("disciplinas.txt","r") or die ("Erro ao abrir o arquivo!");
   while(!feof($arquivo)){
       $linha = fgets($arquivo);
       $colunaDados = explode(";",$linha);
       if ($colunaDados[0] == $materia){
           break;
       }
   }
   fclose($arquivo);
?>


<!DOCTYPE html>
<html>
   <head>
   <?php include 'ex05_Menu.html'; ?>
   </head>
   <body>
       <h1>Digite o que deseja editar: </h1>
       <form action="ex05_alterarD3.php" method="POST">
       <input type="hidden" name="materia" value= "<?php echo $materia; ?>">
       <input type="text" name="nome" value = <?php echo $colunaDados[0]?>>
       <input type="text" name="sigla" value = <?php echo $colunaDados[1]?>>
       <input type="text" name="carga" value = <?php echo $colunaDados[2]?>>
       <input type="submit" value="Editar" href="ex05_alterarD3.php">
       </form>
   </body>
</html>