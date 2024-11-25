<?php
    include 'menuPeR.html';
   $arquivo = fopen("PerguntasErespostas.txt", "r");
   $arquivo2 = fopen("PerguntasErespostas2.txt", "w");
   $nOriginal = $_POST["nPerguntaOriginal"];
   $id = $_POST ["nPergunta"];
   $pergunta = $_POST ["pergunta"];
   $r1 = $_POST ["resposta1"];
   $r2 = $_POST ["resposta2"];
   $r3 = $_POST ["resposta3"];
   $r4 = $_POST ["resposta4"];
   $rC = $_POST ["respostaCorreta"];
   while (!feof ($arquivo)){
        $linha = fgets ($arquivo);
        $colunaDados = explode(";", $linha);
        if ($nOriginal == $colunaDados[0]){
            $linha = $id . ";" . $pergunta . ";" . $r1 . ";" . $r2 . ";" . $r3 . ";" . $r4 . ";" . $rC . "\n";
        }  
       fwrite($arquivo2, $linha);
   }
   fclose($arquivo);
   fclose($arquivo2);
   rename("PerguntasErespostas2.txt", "PerguntasErespostas.txt");
   echo "Perguntas e Respostas atualizadas com sucesso!";
?>