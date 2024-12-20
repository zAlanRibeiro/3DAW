<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Pétalas de Beleza</title>
    <link href="HomePG1.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
</head>

<body>
    <?php session_start(); ?>
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
            <li><a href="servicosPG1.php">Serviços</a></li>
            <ul class="menu-right">
                <?php if (isset($_SESSION['user_name'])): ?>
                    <li><span class="bem-vindo">Bem-vindo, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span></li>
                    <li><a href="logout.php">Deslogar</a></li>
                    <?php if (isset($_SESSION['ADM']) && $_SESSION['ADM'] == 1): ?>
                        <li><a href="adm.php" class="admin-btn">Acessar Painel Administrativo</a></li>
                    <?php endif; ?>
                <?php else: ?>
                    <li><a href="Login.html">Login</a></li>
                    <li><a href="CadastroPG1.html">Cadastre-se</a></li>
                <?php endif; ?>
            </ul>
        </ul>
    </nav>

    <p class="subtitulo">Um salão não apenas para o seu corpo, mas também para a sua mente.</p>

    <main>
        <img id="imagem1" src="ImagensPetala/cabeloPetala.jpg" alt="Corte Cabelo" width="150" class="imagem-petala">
        <img id="imagem2" src="ImagensPetala/manicurePetala.jpg" alt="Manicure" width="150" class="imagem-petala">
    </main>
    <div class="promocoes-container">
        <a href="promocaoPG1.php" class="promocoes">Promoções %</a>
    </div>

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
    <script src="HomePG1.js"></script>
</body>

</html>
