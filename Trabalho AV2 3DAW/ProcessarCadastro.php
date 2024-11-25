<?php
$host = 'localhost';
$dbname = 'petalas_de_beleza';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar-senha'];

    if ($senha !== $confirmar_senha) {
        $mensagem = "As senhas não coincidem.";
    } else {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha_hash);

        if ($stmt->execute()) {
            $mensagem = "Cadastro realizado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Pétalas de Beleza</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CadastroPG1.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Cadastro</h1>
            <button class="botao-voltar" onclick="window.history.back();">Voltar</button>
        </div>

        <form action="Cadastro.php" method="POST" class="form-cadastro">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Crie uma senha" required>
            </div>
            <div class="form-group">
                <label for="confirmar-senha">Confirmar Senha:</label>
                <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder="Confirme sua senha" required>
            </div>
            <button type="submit" class="botao">Cadastrar</button>
        </form>
        
        <?php if ($mensagem): ?>
            <div class="mensagem">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <p class="texto-link">
            Já possui cadastro? <a href="login.html">Faça login</a>
        </p>
    </div>
    <script>
        <?php if ($mensagem == "Cadastro realizado com sucesso!"): ?>
            setTimeout(function() {
                window.location.href = 'HomePG1.php';
            }, 8000);
        <?php endif; ?>
    </script>
</body>
</html>
