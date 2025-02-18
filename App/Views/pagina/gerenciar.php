<?php
session_start();
require 'Libraries/Database.php';

// Verifica se o cliente está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$cli_id = $_SESSION['usuario_id'];

// Busca os dados do cliente
$stmt = $pdo->prepare("SELECT * FROM cliente WHERE cli_id = ?");
$stmt->execute([$cli_id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    die("Cliente não encontrado.");
}

// Processa o formulário de atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['atualizar'])) {
        $novo_nome = $_POST['nome'];
        $novo_endereco = $_POST['endereco'];
        $nova_senha = $_POST['senha'];

        // Atualiza os dados do cliente
        if (!empty($nova_senha)) {
            $senha_hash = password_hash($nova_senha, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("UPDATE cliente SET cli_nome = ?, cli_endereco = ?, cli_senha = ? WHERE cli_id = ?");
            $stmt->execute([$novo_nome, $novo_endereco, $senha_hash, $cli_id]);
        } else {
            $stmt = $pdo->prepare("UPDATE cliente SET cli_nome = ?, cli_endereco = ? WHERE cli_id = ?");
            $stmt->execute([$novo_nome, $novo_endereco, $cli_id]);
        }

        echo "<p>Dados atualizados com sucesso!</p>";
    } elseif (isset($_POST['excluir'])) {
        // Exclui a conta do cliente
        $stmt = $pdo->prepare("DELETE FROM cliente WHERE cli_id = ?");
        $stmt->execute([$cli_id]);

        session_destroy();
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?=URL?>/Public/css/gerenciar.css"/>
    <title>Gerenciar Conta</title>
</head>
<body>
    <div class="container">
        <h2>Gerenciar Conta</h2>
        <form method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($cliente['cli_nome']); ?>" required>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($cliente['cli_endereco']); ?>" required>

            <label for="senha">Nova Senha (deixe em branco para não alterar):</label>
            <input type="password" id="senha" name="senha">

            <button type="submit" name="atualizar">Atualizar Dados</button>
            <button type="submit" name="excluir" class="delete-btn" onclick="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');">Excluir Conta</button>
        </form>
    </div>
</body>
</html>