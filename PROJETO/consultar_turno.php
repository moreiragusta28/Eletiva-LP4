<?php
    require("cabecalho.php");
    require("conexao.php");

    if (!isset($_GET['id'])) {
        echo "<p class='text-danger'>Turno não informado.</p>";
        require("rodape.php");
        exit;
    }

    $id = (int) $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM turno WHERE turno_id = ?");
        $stmt->execute([$id]);
        $turno = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar turno: " . $e->getMessage() . "</p>";
    }

    if (!$turno) {
        echo "<p class='text-danger'>Turno não encontrado.</p>";
        require("rodape.php");
        exit;
    }
?>

<h1>Consulta de Turno</h1>

<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?= $turno['turno_id'] ?></li>
    <li class="list-group-item"><strong>Nome:</strong> <?= htmlspecialchars($turno['nome']) ?></li>
    <li class="list-group-item"><strong>Período:</strong> <?= htmlspecialchars($turno['periodo']) ?></li>
    <li class="list-group-item">
        <strong>Horário:</strong> <?= $turno['hora_inicio'] ?> às <?= $turno['hora_fim'] ?>
    </li>
</ul>

<a href="turnos.php" class="btn btn-secondary mt-3">Voltar</a>

<?php
    require("rodape.php");
?>
