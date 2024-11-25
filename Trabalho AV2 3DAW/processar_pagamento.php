<link rel="stylesheet" href="processar_pagamento.css">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $cartao = trim($_POST['cartao'] ?? '');
    $cvv = trim($_POST['cvv'] ?? '');
    $dataValidade = trim($_POST['data-validade'] ?? '');

    $erros = [];

    if (empty($nome)) {
        $erros[] = 'O nome é obrigatório.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = 'E-mail inválido.';
    }

    if (!preg_match('/^\d{16}$/', $cartao)) {
        $erros[] = 'Número do cartão inválido. Deve conter 16 dígitos.';
    }

    if (!preg_match('/^\d{3}$/', $cvv)) {
        $erros[] = 'CVV inválido. Deve conter 3 dígitos.';
    }

    if (empty($dataValidade)) {
        $erros[] = 'A data de validade é obrigatória.';
    } else {
        $dataAtual = date('Y-m');
        if ($dataValidade < $dataAtual) {
            $erros[] = 'A data de validade não pode ser anterior à data atual.';
        }
    }

    echo '<div class="container">';
    if (!empty($erros)) {
        echo '<h1>Erros encontrados:</h1>';
        echo '<ul>';
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo '</ul>';
        echo '<a href="javascript:history.back()">Voltar</a>';
    } else {
        echo '<h1>Pagamento realizado com sucesso!</h1>';
        echo '<h1>Agendamento concluído!</h1>';
        echo '<p>Obrigado, ' . htmlspecialchars($nome) . '!</p>';
        echo '<a href="HomePG1.php">Voltar ao início</a>';
    }
    echo '</div>';
} else {
    header('Location: index.php');
    exit;
}
?>
