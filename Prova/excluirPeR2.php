<?php
include 'menuPeR.html'; 
$id = $_POST["nPergunta"];
$arquivo = fopen("PerguntasErespostas.txt", "r") or die("Erro ao abrir o arquivo!");
$arquivo2 = fopen("PerguntasErespostas2.txt", "w") or die("Erro ao abrir o arquivo!");

while (!feof($arquivo)) {
    $linha = fgets($arquivo);
    $colunaDados = explode(";", $linha);
    if ($colunaDados[0] != $id) {
        fwrite($arquivo2, $linha); 
    }
}
fclose($arquivo);
fclose($arquivo2);
rename("PerguntasErespostas2.txt", "PerguntasErespostas.txt");
echo "Pergunta excluída com sucesso!";
?>
