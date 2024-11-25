<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : null;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Páginas com Estilo</title>
    <link href="CentralDeAjudaPG1.css" rel="stylesheet" type="text/css" />
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
        </ul>
        <div class="subtitulo">Central de Ajuda</div>
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
        <section class="faq">
            <h2>Perguntas Frequentes</h2>
            <div class="faq-item">
                <h3>Como posso fazer um agendamento?</h3>
                <p>Você pode agendar seu horário diretamente no nosso site, através da seção "Serviços".</p>
            </div>
            <div class="faq-item">
                <h3>Como funciona o cancelamento?</h3>
                <p>Cancelamento até um dia de antecedência ou o estorno é apenas de 50% do valor do agendamento.</p>
            </div>
        </section>

        <section class="artigos">
            <h2>Artigos e Tutoriais</h2>
            <ul>
                <li><a href="https://www.loreal-paris.com.br/50-dicas-de-cabelo-cuidados-com-tratamento-coloracao-e-corte-que-todo-mundo-deveria-saber">Como cuidar do seu cabelo após o corte</a></li>
                <li><a href="https://theonesalon.com.br/guia-completo-para-escolher-a-cor-de-cabelo-ideal-para-voce/">Guia para a escolha da cor de cabelo ideal</a></li>
            </ul>
        </section>

        <section class="suporte">
            <h2>Suporte ao Cliente</h2>
            <p>Se você não encontrou o que procurava, entre em contato com nossa equipe de suporte através do WhatsApp da loja: (XX) XXXXX-XXXX.</p>
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
</body>

</html>
