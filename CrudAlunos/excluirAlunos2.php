<?php
include 'MenuAlunos.html';
$matricula = $_POST["matricula"];
$arquivo = fopen("alunos.txt", "r") or die("Erro ao abrir o arquivo!");
$arquivo2 = fopen("alunos2.txt", "w") or die("Erro ao abrir o arquivo!");

while (!feof($arquivo)) {
    $linha = fgets($arquivo);
    $colunaDados = explode(";", $linha);
    if ($colunaDados[1] != $matricula) {
        fwrite($arquivo2, $linha); 
    }
}

fclose($arquivo);
fclose($arquivo2);
rename("alunos2.txt", "alunos.txt");
echo "Aluno(a) excluído(a) com sucesso!";
?>
