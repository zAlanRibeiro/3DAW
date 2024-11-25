<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); // Verifica se o usuário está logado
$userName = $isLoggedIn ? $_SESSION['user_name'] : null; // Pega o nome do usuário, se logado
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Sobre nós - Pétalas de Beleza</title>
    <link href="SobreNosPG1.css" rel="stylesheet" type="text/css" />
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
            <li><a href="HomePG1.php">Home</a></li>
            <div class="subtitulo">Sobre nós</div>
        </ul>
        <ul class="menu-right">
            <?php if ($isLoggedIn): ?>
                <li class="bem-vindo"><span>Olá, <?php echo htmlspecialchars($userName); ?></span></li>
                <li><a href="logout.php">Sair</a></li>
            <?php else: ?>
                <li><a href="Login.php">Login</a></li>
                <li><a href="CadastroPG1.html">Cadastre-se</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main>
        <section class="sobre-nos">
            <h2>Bem-vindo ao Pétalas de Beleza</h2>
            <p>
                O seu refúgio de elegância e cuidado pessoal. No coração de nosso salão de beleza, floresce a paixão pela transformação, onde cada cliente é uma pétala única que merece desabrochar em toda a sua beleza.
            </p>
            <p>
                Nós acreditamos que a verdadeira beleza reside na confiança e no bem-estar. Nossa equipe dedicada de especialistas em beleza está empenhada em proporcionar uma experiência única, onde cada visita é mais do que um simples tratamento estético, é um momento de renovação e autocuidado.
            </p>
            <p>
                Explore as infinitas possibilidades de beleza conosco. Estamos comprometidos em superar suas expectativas, oferecendo serviços excepcionais e uma atmosfera acolhedora. Deixe-nos ser o seu destino de confiança para aprimorar a sua beleza e cultivar uma sensação duradoura de bem-estar.
            </p>
        </section>

        <section class="informacoes">
            <hr class="linha-rosa">
            <h3>Venha nos visitar</h3>
            <p><strong>Funcionamento:</strong> Terça a Domingo - 8:00 às 19:00</p>
            <p><strong>Endereço:</strong> Rua XXXX N° XXX - Bairro, Cidade, Estado</p>
            <p><strong>Celular:</strong> (XX) XXXXX-XXXX</p>
        </section>
    </main>

    <footer>
        <div class="footer-info">
            <p>2024© Instituto Pétalas de Beleza - Todos os direitos reservados</p>
            <p>Endereço: Rua XXXX N° XXX CNPJ XX.XXX.XXX/XXXX-XX Inscrição estadual XXXXXXXX</p>
            <p>CEP: XXXXX-XXX, Brasil</p>
        </div>
        <div class="pagamento-container">
            <p>Formas de pagamento aceitas: </p>
            <img src="ImagensPetala/PagamentosCabelo.png" alt="Formas Pagamento" width="300">
        </div>
    </footer>
</body>

</html>
