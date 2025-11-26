<?php
    require("cabecalho.php");
    require("conexao.php");

    if (!isset($_GET['id'])) {
        echo "<p class='text-danger'>Funcionário não informado.</p>";
        require("rodape.php");
        exit;
    }

    $id = (int) $_GET['id'];

    try {
        $stmt = $pdo->prepare("
            SELECT f.funcionario_id, f.nome, f.salario,
                   c.nome AS cargo,
                   t.nome AS turno, t.periodo, t.hora_inicio, t.hora_fim
            FROM funcionario f
            INNER JOIN cargo c ON c.cargo_id = f.cargo_id
            INNER JOIN turno t ON t.turno_id = f.turno_id
            WHERE f.funcionario_id = ?
        ");
        $stmt->execute([$id]);
        $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar funcionário: " . $e->getMessage() . "</p>";
    }

    if (!$funcionario) {
        echo "<p class='text-danger'>Funcionário não encontrado.</p>";
        require("rodape.php");
        exit;
    }
?>

<h1>Consulta de Funcionário</h1>

<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?= $funcionario['funcionario_id'] ?></li>
    <li class="list-group-item"><strong>Nome:</strong> <?= htmlspecialchars($funcionario['nome']) ?></li>
    <li class="list-group-item"><strong>Salário:</strong> R$ <?= number_format($funcionario['salario'], 2, ',', '.') ?></li>
    <li class="list-group-item"><strong>Cargo:</strong> <?= htmlspecialchars($funcionario['cargo']) ?></li>
    <li class="list-group-item">
        <strong>Turno:</strong>
        <?= htmlspecialchars($funcionario['turno']) ?> - <?= htmlspecialchars($funcionario['periodo']) ?>
        (<?= $funcionario['hora_inicio'] ?> às <?= $funcionario['hora_fim'] ?>)
    </li>
</ul>

<a href="funcionarios.php" class="btn btn-secondary mt-3">Voltar</a>

<?php
    require("rodape.php");
?>