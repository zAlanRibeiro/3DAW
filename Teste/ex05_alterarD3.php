<?php
   $arquivo = fopen("disciplinas.txt", "r");
   $arquivo2 = fopen("disciplinas2.txt", "w");
   $nome = $_POST ("nome");
   $sigla = $_POST ("sigal");
   $carga = $_POST ("carga");
   $materia = $_POST ("materia");
   echo $materia;
   while (!feof ($arquivo)){
       $linha = fgets ($arquivo);
       if ($materia == $nome){
          
       }
   }
?>