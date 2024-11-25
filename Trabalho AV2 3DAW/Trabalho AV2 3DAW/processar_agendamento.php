<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $servico_id = $_POST['servicos'];
    $profissional_id = $_POST['profissional'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    $sql_servico = "SELECT nome FROM servicos WHERE id = :id";
    $stmt_servico = $pdo->prepare($sql_servico);
    $stmt_servico->bindParam(':id', $servico_id);
    $stmt_servico->execute();
    $servico = $stmt_servico->fetch(PDO::FETCH_ASSOC);
    $servico_nome = $servico['nome'];

    $sql_profissional = "SELECT nome FROM profissionais WHERE id = :id";
    $stmt_profissional = $pdo->prepare($sql_profissional);
    $stmt_profissional->bindParam(':id', $profissional_id);
    $stmt_profissional->execute();
    $profissional = $stmt_profissional->fetch(PDO::FETCH_ASSOC);
    $profissional_nome = $profissional['nome'];

    $sql = "INSERT INTO agendamentos (email, telefone, servico, profissional, data, hora) 
            VALUES (:email, :telefone, :servico, :profissional, :data, :hora)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':servico', $servico_nome);
    $stmt->bindParam(':profissional', $profissional_nome);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':hora', $hora);

    if ($stmt->execute()) {
        header('Location: pagamento.html');
        exit();
    } else {
        echo "Erro ao agendar o serviço. Tente novamente.";
    }
} else {
    header('Location: Agendamento.php');
    exit();
}

$pdo = null;
?>
