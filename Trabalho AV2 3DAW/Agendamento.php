<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
$userName = $isLoggedIn ? $_SESSION['user_name'] : null;
include('conexao.php');

$sql_servicos = "SELECT id, nome FROM servicos";
$stmt_servicos = $pdo->query($sql_servicos);
$servicos = $stmt_servicos->fetchAll(PDO::FETCH_ASSOC);

$sql_profissionais = "SELECT id, nome FROM profissionais";
$stmt_profissionais = $pdo->query($sql_profissionais);
$profissionais = $stmt_profissionais->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Agendamento - Pétalas de Beleza</title>
    <link href="Agendamento.css" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <script>
        function validarFormulario() {
            var email = document.getElementById("email").value;
            var telefone = document.getElementById("telefone").value;
            var servicos = document.getElementById("servicos").value;
            var profissional = document.getElementById("profissional").value;
            var data = document.getElementById("data").value;
            var hora = document.getElementById("hora").value;

            if (email == "" || telefone == "" || servicos == "" || profissional == "" || data == "" || hora == "") {
                alert("Todos os campos devem ser preenchidos.");
                return false;
            }

            var emailPadrao = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPadrao.test(email)) {
                alert("Insira um e-mail válido.");
                return false;
            }

            var telefonePadrao = /^\d{2}?\d{4,5}\d{4}$/;
            if (!telefonePadrao.test(telefone)) {
                alert("Insira um número de telefone válido: (XX) XXXXX-XXXX.");
                return false;
            }

            var dataAtual = new Date();
            var dataSelecionada = new Date(data);

            if (dataSelecionada < dataAtual) {
                alert("A data do agendamento não pode ser anterior à data atual.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <header>
        <img src="ImagensPetala/petalaBeleza.png" alt="Logo Empresa" width="125" class="logo">
        <h1>
            <div class="titulo">Pétalas de Beleza</div>
        </h1>
    </header>

    <nav>
        <ul class="menu menu-left">
            <li><a href="SobreNosPG1.php">Sobre nós</a></li>
            <li><a href="CentralDeAjudaPG1.php">Central de Ajuda</a></li>
            <li><a href="ProfissionaisPG1.php">Profissionais</a></li>
            <li><a href="servicosPG1.php">Serviços</a></li>
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
        <h2 class="subtitulo">Agende seu horário</h2>
        <form class="form-agendamento animated-transition" action="processar_agendamento.php" method="POST" onsubmit="return validarFormulario()">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" required>
            </div>
            <div class="form-group">
                <label for="servicos">Selecione o Serviço:</label>
                <select id="servicos" name="servicos" required>
                    <option value="" disabled selected>Escolha um servico</option>
                    <?php
                        foreach ($servicos as $servico) {
                            echo '<option value="' . htmlspecialchars($servico['id']) . '">' . htmlspecialchars($servico['nome']) . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="profissional">Selecione o Profissional:</label>
                <select id="profissional" name="profissional" required>
                    <option value="" disabled selected>Escolha um profissional</option>
                    <?php
                        foreach ($profissionais as $profissional) {
                        echo '<option value="' . htmlspecialchars($profissional['id']) . '">' . htmlspecialchars($profissional['nome']) . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="data">Data do Agendamento:</label>
                <input type="date" id="data" name="data" required>
            </div>
            <div class="form-group">
                <label for="hora">Horário:</label>
                <input type="time" id="hora" name="hora" required>
            </div>
            <button type="submit" class="btn-agendar">Agendar</button>
        </form>
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

<?php
    $pdo = null;
?>
