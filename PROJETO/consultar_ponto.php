<?php
    require("cabecalho.php");
    require("conexao.php");

    if (!isset($_GET['id'])) {
        echo "<p class='text-danger'>Batida não informada.</p>";
        require("rodape.php");
        exit;
    }

    $id = (int) $_GET['id'];

    try {
        $stmt = $pdo->prepare("
            SELECT p.ponto_id, p.data_hora, p.tipo,
                   f.funcionario_id, f.nome AS funcionario
            FROM ponto p
            INNER JOIN funcionario f ON f.funcionario_id = p.funcionario_id
            WHERE p.ponto_id = ?
        ");
        $stmt->execute([$id]);
        $ponto = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar batida: " . $e->getMessage() . "</p>";
    }

    if (!$ponto) {
        echo "<p class='text-danger'>Batida não encontrada.</p>";
        require("rodape.php");
        exit;
    }

    $data_formatada = date('d/m/Y H:i', strtotime($ponto['data_hora']));
?>

<h1>Consulta de Batida de Ponto</h1>

<ul class="list-group">
    <li class="list-group-item"><strong>ID:</strong> <?= $ponto['ponto_id'] ?></li>
    <li class="list-group-item"><strong>Funcionário:</strong> <?= htmlspecialchars($ponto['funcionario']) ?></li>
    <li class="list-group-item"><strong>Data e Hora:</strong> <?= $data_formatada ?></li>
    <li class="list-group-item"><strong>Tipo:</strong> <?= $ponto['tipo'] ?></li>
</ul>

<a href="pontos.php" class="btn btn-secondary mt-3">Voltar</a>

<?php
    require("rodape.php");
?>
