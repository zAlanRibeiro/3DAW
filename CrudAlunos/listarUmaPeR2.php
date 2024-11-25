<!DOCTYPE html>
<html>
<head>
    <style>
        .tabela-container {
            margin-top: 20px;
        }
        .minha-tabela {
            border-collapse: collapse;
            width: 100%;
        }
        .minha-tabela th, .minha-tabela td {
            border: 1px solid black;
            padding: 8px; 
            text-align: left; 
        }
    </style>
</head>
<body>
    <?php include 'menuPeR.html'; ?>   
    <h1>Listar Pergunta e Resposta</h1>
    <div class="tabela-container">
        <table class="minha-tabela">
           <tr>
               <th>N da Pergunta</th>
               <th>Pergunta</th>
               <th>Resposta 1</th>
               <th>Resposta 2</th>
               <th>Resposta 3</th>
               <th>Resposta 4</th>
               <th>Resposta Correta</th>
           </tr>
        <?php 
            $arquivo = fopen("PerguntasErespostas.txt", "r");
            $id = $_POST["nPergunta"];
            while (!feof($arquivo)) {
                $linha = fgets($arquivo);
                $colunaDados = explode(";", $linha);
                if ($colunaDados[0] == $id) {
                    echo "<tr>";
                    echo "<td>{$colunaDados[0]}</td>";
                    echo "<td>{$colunaDados[1]}</td>";
                    echo "<td>{$colunaDados[2]}</td>";
                    echo "<td>{$colunaDados[3]}</td>";
                    echo "<td>{$colunaDados[4]}</td>";
                    echo "<td>{$colunaDados[5]}</td>";
                    echo "<td>{$colunaDados[6]}</td>";
                    echo "</tr>";
                }
            }
            fclose($arquivo);
        ?>
        </table>
    </div>
</body>
</html>