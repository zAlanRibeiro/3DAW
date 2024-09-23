<?php
   include 'ex05_Menu.html';
   $arquivo = fopen("disciplinas.txt", "r");
   $arquivo2 = fopen("disciplinas2.txt", "w");
   $materia = $_POST["materia"];
   $nome = $_POST ["nome"];
   $sigla = $_POST ["sigla"];
   $carga = $_POST ["carga"];
   $cont = 0;
   echo $materia;
   while (!feof ($arquivo)){
        $linha = fgets ($arquivo);
        $colunaDados = explode(";", $linha);
        if ($cont == 0){
            if ($materia == $colunaDados[0]){
                $linha = $nome . ";" . $sigla . ";" . $carga . "\n";
                $cont =  1;
            }
        }       
       fwrite($arquivo2, $linha);
   }
   fclose($arquivo);
   fclose($arquivo2);
   rename("disciplinas2.txt", "disciplinas.txt");
   echo "Disciplina atualizada com sucesso!";
?>
