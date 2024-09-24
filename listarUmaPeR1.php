<!DOCTYPE html>
<html>
   <head>    
   </head>
   <body>
       <?php include 'menuPeR.html'; ?>   
       <h1>Qual pergunta deseja visualizar?</h1>
       <form action="listarUmaPeR2.php" method="POST">
       Escreva o número da pergunta:
       <input type="text" name="nPergunta">
       <input type="submit" value="Ok" href="listarUmaPeR2.php">
   </body>
</html>