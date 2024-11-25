<?php
    session_start();

    if (!isset($_SESSION['ADM']) || $_SESSION['ADM'] == 0) {
        header("Location: HomePG1.php");
        exit();
    }

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

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $servico = $_POST['servico'];
        $profissional = $_POST['profissional'];
        $data = $_POST['data'];
        $hora = $_POST['hora'];

        $dataHora = $data . ' ' . $hora;

        $dataHoraInicio = date('Y-m-d H:i:s', strtotime($dataHora . ' -1 hour'));
        $dataHoraFim = date('Y-m-d H:i:s', strtotime($dataHora . ' +1 hour'));

        $sql = "SELECT * FROM agendamentos WHERE profissional = :profissional AND (
            (data = :data AND hora BETWEEN :horaInicio AND :horaFim)
        )";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':profissional', $profissional);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':horaInicio', $dataHoraInicio);
        $stmt->bindParam(':horaFim', $dataHoraFim);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Este profissional já está agendado para esse horário ou em um horário conflitante.');</script>";
        } else {
            $sql = "INSERT INTO agendamentos (email, telefone, servico, profissional, data, hora) 
                    VALUES (:email, :telefone, :servico, :profissional, :data, :hora)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':servico', $servico);
            $stmt->bindParam(':profissional', $profissional);
            $stmt->bindParam(':data', $data);
            $stmt->bindParam(':hora', $hora);
            $stmt->execute();

            header("Location: adm.php");
            exit();
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $sql = "DELETE FROM agendamentos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $_SESSION['msg'] = "Agendamento excluído com sucesso!";
        header("Location: adm.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $servico = $_POST['servico'];
        $profissional = $_POST['profissional'];
        $data = $_POST['data'];
        $hora = $_POST['hora'];

        $sql = "UPDATE agendamentos SET email = :email, telefone = :telefone, servico = :servico, 
                profissional = :profissional, data = :data, hora = :hora WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':servico', $servico);
        $stmt->bindParam(':profissional', $profissional);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: adm.php");
        exit();
    }

    if (isset($_GET['delete_service'])) {
        $id = $_GET['delete_service'];

        $sql = "SELECT imagem FROM servicos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $servico = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($servico && file_exists($servico['imagem'])) {
            unlink($servico['imagem']);
        }

        $sql = "DELETE FROM servicos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_service'])) {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];

        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
            $imagem = 'uploads/' . basename($_FILES['imagem']['name']);
            move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem);
        } else {
            $imagem = null; 
        }

        $sql = "INSERT INTO servicos (nome, descricao, preco, imagem) 
                VALUES (:nome, :descricao, :preco, :imagem)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':imagem', $imagem);
        $stmt->execute();

        $_SESSION['msg'] = "Serviço adicionado com sucesso!";
        header("Location: adm.php");
        exit();
    }

    $sql = "SELECT * FROM agendamentos";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM profissionais";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $profissionais = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_SESSION['msg'])) {
        echo "<p>{$_SESSION['msg']}</p>";
        unset($_SESSION['msg']);
    }

if (isset($_GET['delete_profissional'])) {
    $id = $_GET['delete_profissional'];

    $sql = "SELECT imagem FROM profissionais WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $profissional = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($profissional && file_exists($profissional['imagem'])) {
        unlink($profissional['imagem']);
    }

    $sql = "DELETE FROM profissionais WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $_SESSION['msg'] = "Profissional excluído com sucesso!";
    header("Location: adm.php");
    exit();
}

 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_profissional'])) {
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $especialidade = $_POST['especialidade'];

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagem = 'uploads/' . basename($_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem);
    } else {
        $imagem = null;
    }

    $sql = "INSERT INTO profissionais (nome, cargo, especialidade, imagem) 
            VALUES (:nome, :cargo, :especialidade, :imagem)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':cargo', $cargo);
    $stmt->bindParam(':especialidade', $especialidade);
    $stmt->bindParam(':imagem', $imagem);
    $stmt->execute();

    $_SESSION['msg'] = "Profissional adicionado com sucesso!";
    header("Location: adm.php");
    exit();
}
?>

    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="adm.css" rel="stylesheet" type="text/css" />
        <title>Painel Administrativo - Agendamentos</title>
    </head>
    <body>
        <button onclick="window.location.href='HomePG1.php';">Voltar para Página Principal</button>
        <h1>Painel Administrativo - Gerenciar Site</h1>

    <h2>Adicionar Novo Agendamento</h2>
    <form method="POST">
        <label for="email">Email do Cliente:</label>
        <input type="email" name="email" required><br>

        <label for="telefone">Telefone do Cliente:</label>
        <input type="tel" name="telefone" required><br>

        <label for="servico">Selecione o Serviço:</label>
        <select id="servico" name="servico" required>
            <option value="" disabled selected>----</option>
            <option value="Corte de Cabelo">Corte de Cabelo</option>
            <option value="Manicure">Manicure</option>
            <option value="Pedicure">Pedicure</option>
            <option value="Depilação">Depilação</option>
            <option value="Hidratação">Hidratação Facial</option>
        </select><br>

        <label for="profissional">Selecione o Profissional:</label>
        <select id="profissional" name="profissional" required>
            <option value="" disabled selected>----</option>
            <option value="Leila">Leila</option>
            <option value="Rick Samuel">Rick Samuel</option>
            <option value="Carol">Carol</option>
            <option value="Amanda">Amanda</option>
        </select><br>

        <label for="data">Data:</label>
        <input type="date" name="data" required><br>

        <label for="hora">Hora:</label>
        <input type="time" name="hora" required><br>

        <button type="submit" name="add">Adicionar Agendamento</button>
    </form>

    <h2>Adicionar Serviço</h2>
    <form method="POST" action="processa_servico.php" enctype="multipart/form-data">
    <label for="nome">Nome do Serviço:</label>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao" required></textarea><br><br>

    <label for="preco">Preço:</label>
    <input type="number" id="preco" name="preco" step="0.01" required><br><br>

    <label for="imagem">Imagem:</label>
    <input type="file" id="imagem" name="imagem"><br><br>

    <input type="submit" name="add_service" value="Adicionar Serviço">
</form>

<h2>Adicionar Novo Profissional</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="nome">Nome do Profissional:</label>
        <input type="text" name="nome" required><br>

        <label for="cargo">Cargo:</label>
        <input type="text" name="cargo" required><br>

        <label for="especialidade">Especialidade:</label>
        <input type="text" name="especialidade" required><br>

        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem"><br><br>

        <button type="submit" name="add_profissional">Adicionar Profissional</button>
    </form>

    <h2>Profissionais Existentes</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cargo</th>
                <th>Especialidade</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($profissionais as $profissional): ?>
            <tr>
                <td><?php echo $profissional['id']; ?></td>
                <td><?php echo htmlspecialchars($profissional['nome']); ?></td>
                <td><?php echo htmlspecialchars($profissional['cargo']); ?></td>
                <td><?php echo htmlspecialchars($profissional['especialidade']); ?></td>
                <td>
                    <?php if ($profissional['imagem']): ?>
                        <img src="<?php echo $profissional['imagem']; ?>" alt="Imagem do Profissional" width="100">
                    <?php else: ?>
                        <span>Sem Imagem</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="adm.php?edit_profissional=<?php echo $profissional['id']; ?>">Editar</a> |
                    <a href="adm.php?delete_profissional=<?php echo $profissional['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Serviços Existentes</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM servicos";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($servicos as $servico):
            ?>
                <tr>
                    <td><?php echo $servico['id']; ?></td>
                    <td><?php echo htmlspecialchars($servico['nome']); ?></td>
                    <td><?php echo htmlspecialchars($servico['descricao']); ?></td>
                    <td><?php echo number_format($servico['preco'], 2, ',', '.'); ?></td>
                    <td>
                        <?php if ($servico['imagem']): ?>
                            <img src="<?php echo $servico['imagem']; ?>" alt="Imagem do Serviço" width="100">
                        <?php else: ?>
                            <span>Sem Imagem</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="adm.php?edit_service=<?php echo $servico['id']; ?>">Editar</a> |
                        <a href="adm.php?delete_service=<?php echo $servico['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <h2>Agendamentos Existentes</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email do Cliente</th>
                <th>Telefone</th>
                <th>Serviço</th>
                <th>Profissional</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agendamentos as $agendamento): ?>
            <tr>
                <td><?php echo $agendamento['id']; ?></td>
                <td><?php echo htmlspecialchars($agendamento['email']); ?></td>
                <td><?php echo htmlspecialchars($agendamento['telefone']); ?></td>
                <td><?php echo htmlspecialchars($agendamento['servico']); ?></td>
                <td><?php echo htmlspecialchars($agendamento['profissional']); ?></td>
                <td><?php echo date('d/m/Y', strtotime($agendamento['data'])); ?></td>
                <td><?php echo date('H:i', strtotime($agendamento['hora'])); ?></td>
                <td>
                    <a href="adm.php?edit=<?php echo $agendamento['id']; ?>">Editar</a> |
                    <a href="adm.php?delete=<?php echo $agendamento['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "SELECT * FROM agendamentos WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $agendamento = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

        <h2>Editar Agendamento</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $agendamento['id']; ?>">

            <label for="email">Email do Cliente:</label>
            <input type="email" name="email" value="<?php echo $agendamento['email']; ?>" required><br>

            <label for="telefone">Telefone do Cliente:</label>
            <input type="tel" name="telefone" value="<?php echo $agendamento['telefone']; ?>" required><br>

            <label for="servico">Selecione o Serviço:</label>
            <select id="servico" name="servico" required>
                <option value="" disabled selected>----</option>
                <option value="corte">Corte de Cabelo</option>
                <option value="manicure">Manicure</option>
                <option value="spa">Pedicure</option>
                <option value="tratamento">Depilação</option>
                <option value="hidratacao">Hidratação Facial</option>
            </select><br>

            <label for="profissional">Selecione o Profissional:</label>
            <select id="profissional" name="profissional" required>
                <option value="" disabled selected>----</option>
                <option value="Leila">Leila</option>
                <option value="Rick Samuel">Rick Samuel</option>
                <option value="Carol">Carol</option>
                <option value="amanda">Amanda</option>
            </select><br>

            <label for="data">Data:</label>
            <input type="date" name="data" value="<?php echo $agendamento['data']; ?>" required><br>

            <label for="hora">Hora:</label>
            <input type="time" name="hora" value="<?php echo $agendamento['hora']; ?>" required><br>

            <button type="submit" name="edit">Atualizar Agendamento</button>
        </form>
    <?php } ?>

</body>
</html>
