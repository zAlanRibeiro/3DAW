<?php
    $v1 = $_GET["a"];
    $v2 = $_GET["b"];
    $opper = $_GET["op"];
    $result = 0;

    switch ($opper) {
        case "Soma":
            $result = $v1 + $v2;
            break;
        case "Subtracao":
            $result = $v1 - $v2;
            break;
        case "Multiplicacao":
            $result = $v1 * $v2;
            break;
        case "Divisao":
            if($v2 != 0){
                $result = $v1 / $v2;
            }else{
                $result = "Erro: Divisao por zero!";
            }
            break;
    }

    echo "<h1>Resultado = $result </h1>";
    echo "<br><br><button onclick=\"window.location.href='ex03_calculadora.html'\">Ok</button>";
    ?>