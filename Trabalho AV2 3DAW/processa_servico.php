<?php
include 'conexao.php';

if (isset($_POST['add_service'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $imagem = 'uploads/' . basename($_FILES['imagem']['name']);

        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem)) {
            echo "Imagem carregada com sucesso!";
        } else {
            echo "Erro ao carregar a imagem.";
            $imagem = null; 
        }
    } else {
        $imagem = null;
    }

    echo "Nome: $nome, Descrição: $descricao, Preço: $preco, Imagem: $imagem<br>";

    if ($nome && $descricao && $preco) {
        try {
            $sql = "INSERT INTO servicos (nome, descricao, preco, imagem) VALUES (:nome, :descricao, :preco, :imagem)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':imagem', $imagem);

            $stmt->execute();

            $_SESSION['msg'] = "Serviço adicionado com sucesso!";
            header("Location: adm.php");
            exit();
        } catch (PDOException $e) {
            echo "Erro ao inserir no banco de dados: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos corretamente!";
    }
}
?>
