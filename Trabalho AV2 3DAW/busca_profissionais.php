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

function getProfissionaisPorCategoria($categoriaId) {
    global $pdo;
    $sql = "
        SELECT p.id, p.nome
        FROM profissionais p
        JOIN profissionais_categorias pc ON p.id = pc.id_profissional
        WHERE pc.id_categoria = :categoriaId
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':categoriaId', $categoriaId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_POST['servico'])) {
    $categoriaId = $_POST['servico'];
    $profissionais = getProfissionaisPorCategoria($categoriaId);
    
    foreach ($profissionais as $profissional) {
        echo "<option value='{$profissional['id']}'>{$profissional['nome']}</option>";
    }
}