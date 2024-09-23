<?php
   include 'MenuAlunos.html'; 
   $arquivo = fopen("alunos.txt", "r");
   $arquivo2 = fopen("alunos2.txt", "w");
   $matriculaOriginal = $_POST["matriculaOriginal"];
   $nome = $_POST ["nome"];
   $matricula = $_POST ["matricula"];
   $nascimento = $_POST ["nascimento"];
   $cpf = $_POST ["cpf"];
   $cont = 0;
   echo $materia;
   while (!feof ($arquivo)){
        $linha = fgets ($arquivo);
        $colunaDados = explode(";", $linha);
        if ($cont == 0){
            if ($matriculaOriginal == $colunaDados[1]){
                $linha = $nome . ";" . $matricula . ";" . $nascimento . ";" . $cpf . "\n";
                $cont =  1;
            }
        }       
       fwrite($arquivo2, $linha);
   }
   fclose($arquivo);
   fclose($arquivo2);
   rename("alunos2.txt", "alunos.txt");
   echo "Aluno(a) atualizado(a) com sucesso!";
?>