<?php
    require("cabecalho.php");
    require("conexao.php");

    if (!isset($_GET['id'])) {
        echo "<p class='text-danger'>Cargo não informado.</p>";
        require("rodape.php");
        exit;
    }

    $id = (int) $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM cargo WHERE cargo_id = ?");
        $stmt->execute([$id]);
        $cargo = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar cargo: " . $e->getMessage() . "</p>";
    }

    if (!$cargo) {
        echo "<p class='text-danger'>Cargo não encontrado.</p>";
        require("rodape.php");
        exit;
    }
?>

<h1>Consulta de Cargo</h1>

<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?= $cargo['cargo_id'] ?></li>
    <li class="list-group-item"><strong>Nome:</strong> <?= htmlspecialchars($cargo['nome']) ?></li>
</ul>

<a href="cargos.php" class="btn btn-secondary mt-3">Voltar</a>

<?php
    require("rodape.php");
?>
