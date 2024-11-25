<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : null;
include('conexao.php');

$sql = "SELECT nome, descricao, preco, imagem FROM servicos";
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Serviços - Pétalas de Beleza</title>
    <link href="servicosPG1.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <img src="ImagensPetala/petalaBeleza.png" alt="Logo Empresa" width="125" class="logo">
        <h1><div class="titulo">Pétalas de Beleza</div></h1>
    </header>

    <nav>
        <ul class="menu">
            <li><a href="SobreNosPG1.php">Sobre nós</a></li>
            <li><a href="CentralDeAjudaPG1.php">Central de Ajuda</a></li>
            <li><a href="ProfissionaisPG1.php">Profissionais</a></li>
            <ul class="menu-right">
                <?php if ($isLoggedIn): ?>
                    <li class="bem-vindo"><span>Olá, <?php echo htmlspecialchars($userName); ?></span></li>
                    <li><a href="logout.php">Sair</a></li>
                <?php else: ?>
                    <li><a href="Login.html">Login</a></li>
                    <li><a href="CadastroPG1.html">Cadastre-se</a></li>
                <?php endif; ?>
            </ul>
        </ul>
    </nav>

    <main>
        <section class="servicos-intro">
            <h2>Conheça nossos serviços</h2>
            <p>Oferecemos serviços de alta qualidade para cuidar da sua beleza e bem-estar. Confira abaixo os serviços que temos para você!</p>
            <button class="botao" onclick="window.history.back();">Voltar</button>
        </section>

        <section class="servicos-lista">
            <?php
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="servico-item">';
                    echo '<img src=' . htmlspecialchars($row['imagem']) . ' alt="' . htmlspecialchars($row['nome']) . '" width="300" class="imagem-petala">';
                    echo '<h3>' . htmlspecialchars($row['nome']) . ' - ' . number_format($row['preco'], 2, ',', '.') . ' R$</h3>';
                    echo '<p>' . htmlspecialchars($row['descricao']) . '</p>';
                    echo '<a href="Agendamento.php" class="servico-agendar">Agendar</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>Não há serviços disponíveis no momento.</p>';
            }            
            ?>
        </section>
    </main>

    <footer>
        <div class="footer-info">
            <p>2024© instituto Pétalas de Beleza - Todos os direitos reservados</p>
            <p>Endereço: Rua XXXX N° XXX CNPJ XX.XXX.XXX/XXXX-XX Inscrição estadual XXXXXXXX</p>
            <p>CEP: XXXXX-XXX, Brasil</p>
        </div>
        <div class="pagamento-container">
            <p>Formas de pagamento aceitas: </p>
            <img src="ImagensPetala/PagamentosCabelo.png" alt="Formas Pagamento" width="300">
        </div>
    </footer>

    <script src="Servicos.js"></script>
</body>
</html>

<?php
    $pdo = null;
?>
