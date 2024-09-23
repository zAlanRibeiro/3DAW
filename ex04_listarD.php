<!DOCTYPE html>
<html>
<head>
<?php include 'ex05_Menu.html'; ?>
</head>
<body>
<h1>Listar Disciplina</h1>
<table>
   <tr>
       <th>Nome</th>
       <th>Sigal</th>
       <th>Carga Horária</th>
   </tr>
   <?php
       $arquivo = fopen("disciplinas.txt","r") or die ("Erro ao abrir o arquivo!");
       $cont = 0;
       $linha = fgets($arquivo);
       while (!feof($arquivo)){
           $linha = fgets($arquivo);
           $colunaDados = explode(";",$linha);
           echo "<tr>";
           echo "<td>$colunaDados[0]</td>";
           echo "<td>$colunaDados[1]</td>";
           echo "<td>$colunaDados[2]</td>";
           echo "<tr>";
       }
       fclose($arquivo)
   ?>  
</table>
</body>
</html>

