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
    <h1>Listar Perguntas e Respostas</h1>
    <div class="tabela-container">
        <table class="minha-tabela">
            <thead>
                <tr>
                    <th>N da Pergunta</th>
                    <th>Pergunta</th>
                    <th>Resposta 1</th>
                    <th>Resposta 2</th>
                    <th>Resposta 3</th>
                    <th>Resposta 4</th>
                    <th>Resposta Correta</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $arquivo = fopen("PerguntasErespostas.txt", "r") or die ("Erro ao abrir o arquivo!");
                    $primeiraLinha = true;
                    while (!feof($arquivo)) {
                        $linha = fgets($arquivo);
                        if ($primeiraLinha) {
                            $primeiraLinha = false; 
                            continue;
                        }
                            $colunaDados = explode(";", $linha);
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($colunaDados[0]) . "</td>";
                            echo "<td>" . htmlspecialchars($colunaDados[1]) . "</td>";
                            echo "<td>" . htmlspecialchars($colunaDados[2]) . "</td>";
                            echo "<td>" . htmlspecialchars($colunaDados[3]) . "</td>";
                            echo "<td>" . htmlspecialchars($colunaDados[4]) . "</td>";
                            echo "<td>" . htmlspecialchars($colunaDados[5]) . "</td>";
                            echo "<td>" . htmlspecialchars($colunaDados[6]) . "</td>";
                            echo "</tr>";   
                    }
                    fclose($arquivo);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
