<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : null;

include('conexao.php');

$sql_profissionais = "SELECT nome, especialidade, imagem FROM profissionais";
$stmt_profissionais = $pdo->query($sql_profissionais);
$profissionais = $stmt_profissionais->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Profissionais</title>
    <link href="ProfissionaisPG1.css" rel="stylesheet" type="text/css" />
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
            <div class="subtitulo">Conheça nossa equipe!</div>
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
        <p class="descricao1">
            Conheça a equipe talentosa do <strong>Pétalas de Beleza</strong>, composta por especialistas apaixonados por beleza e bem-estar. Cada membro é dedicado a oferecer serviços excepcionais, combinando criatividade, técnica e um toque de magia para realçar sua beleza única. Estamos aqui para tornar sua experiência no salão inesquecível, com profissionais comprometidos em superar suas expectativas. Confie em nossa equipe para cuidar de você e proporcionar resultados incríveis.
        </p>
        <div class="equipe">
            <?php
            foreach ($profissionais as $profissional) {
                echo '<div class="imagem-trabalhador" onclick="girarImagem(this)">
                        <img src=' . htmlspecialchars($profissional['imagem']) . ' alt="' . htmlspecialchars($profissional['nome']) . '">
                        <div class="descricao-trabalhador">
                            <p>' . htmlspecialchars($profissional['nome']) . ' - ' . htmlspecialchars($profissional['especialidade']) . '</p>
                        </div>
                      </div>';
            }
            ?>
        </div>
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
    <script src="ProfissionaisPG1.js"></script>
</body>

</html>

<?php
$pdo = null;
?>
