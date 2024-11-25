<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : null;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Promoções - Pétalas de Beleza</title>
    <link href="promocaoPG1.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <img src="ImagensPetala/petalaBeleza.png" alt="Logo Empresa" width="125" class="logo">
        <h1>
            <div class="titulo">Pétalas de Beleza</div>
        </h1>
    </header>

    <nav>
        <ul class="menu">
            <li><a href="SobreNosPG1.php">Sobre nós</a></li>
            <li><a href="CentralDeAjudaPG1.php">Central de Ajuda</a></li>
            <li><a href="ProfissionaisPG1.php">Profissionais</a></li>
            <li><a href="ServicosPG1.php">Serviços</a></li>
            <ul class="menu-right">
                <?php if ($isLoggedIn): ?>
                    <li class="bem-vindo"><span>Olá, <?php echo htmlspecialchars($userName); ?></span></li>
                    <li><a href="logout.php">Sair</a></li>
                <?php else: ?>
                    <li><a href="Login.html">Login</a></li>
                    <li><a href="CadastroPG1.html">Cadastre-se</a></li>
                <?php endif; ?>
            </ul>
    </nav>

    <main>
        <section class="promocao-intro">
            <h2>Promoções Especiais</h2>
            <p>Descontos imperdíveis para cuidar de você com a qualidade e o carinho da Pétalas de Beleza!</p>
            <button class="botao" onclick="window.history.back();">Voltar</button>
        </section>

        <section class="promocoes-lista">
            <div class="promocao-item">
                <img src="ImagensDesconto/descontoCorte.jpg" alt="Desconto Corte de Cabelo" width="300" class="imagem-petala">
                <h3>Corte de Cabelo</h3>
                <p>Desconto de 20% em todos os cortes! Agende agora e transforme o seu visual.</p>
                <a href="Agendamento.php" class="promocoes">Agendar</a>
            </div>

            <div class="promocao-item">
                <img src="ImagensDesconto/PEeMAOdesconto.jpg" alt="Promoção Manicure" width="300" class="imagem-petala">
                <h3>Manicure e Pedicure</h3>
                <p>Aproveite 15% de desconto em serviços de manicure e pedicure. Fique com as unhas perfeitas!</p>
                <a href="Agendamento.php" class="promocoes">Agendar</a>
            </div>

            <div class="promocao-item">
                <img src="ImagensDesconto/hidratacaoDesconto.jpg" alt="Pacote Beleza Completa" width="300" class="imagem-petala">
                <h3>Pacote Beleza Completa</h3>
                <p>Pacote com 30% de desconto: corte de cabelo, manicure, e hidratação facial!</p>
                <a href="Agendamento.php" class="promocoes">Agendar</a>
            </div>
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
    <script src="Promoções.js"></script>
</body>

</html>
