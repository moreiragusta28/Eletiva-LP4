<?php
    require("cabecalho.php");
    require("conexao.php");

    // Exclusão de batida
    if (isset($_GET['excluir'])) {
        $id = (int) $_GET['excluir'];

        try {
            $stmt = $pdo->prepare("DELETE FROM ponto WHERE ponto_id = ?");
            if ($stmt->execute([$id])) {
                header('location: pontos.php?excluir=true');
                exit;
            } else {
                header('location: pontos.php?excluir=false');
                exit;
            }
        } catch (Exception $e) {
            echo "<p class='text-danger'>Erro ao excluir batida de ponto: " . $e->getMessage() . "</p>";
        }
    }

    // Listagem de pontos
    try {
        $stmt = $pdo->query("
            SELECT p.ponto_id, p.data_hora, p.tipo,
                   f.funcionario_id, f.nome AS funcionario
            FROM ponto p
            INNER JOIN funcionario f ON f.funcionario_id = p.funcionario_id
            ORDER BY p.data_hora DESC
        ");
        $pontos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar pontos: " . $e->getMessage() . "</p>";
    }

    if (isset($_GET['cadastro'])) {
        echo $_GET['cadastro'] == 'true'
            ? "<p class='text-success'>Batida registrada com sucesso!</p>"
            : "<p class='text-danger'>Erro ao registrar batida!</p>";
    }

    if (isset($_GET['editar'])) {
        echo $_GET['editar'] == 'true'
            ? "<p class='text-success'>Batida editada com sucesso!</p>"
            : "<p class='text-danger'>Erro ao editar batida!</p>";
    }

    if (isset($_GET['excluir'])) {
        echo $_GET['excluir'] == 'true'
            ? "<p class='text-success'>Batida excluída com sucesso!</p>"
            : "<p class='text-danger'>Erro ao excluir batida!</p>";
    }
?>

<h1>Registro de Ponto</h1>
<a href="novo_ponto.php" class="btn btn-primary mb-3">Nova Batida</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Funcionário</th>
            <th>Data e Hora</th>
            <th>Tipo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($pontos)): ?>
            <?php foreach ($pontos as $p): ?>
                <tr>
                    <td><?= $p['ponto_id'] ?></td>
                    <td><?= htmlspecialchars($p['funcionario']) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($p['data_hora'])) ?></td>
                    <td><?= $p['tipo'] ?></td>
                    <td class="d-flex gap-2">
                        <a href="consultar_ponto.php?id=<?= $p['ponto_id'] ?>" class="btn btn-sm btn-info">Consultar</a>
                        <a href="editar_ponto.php?id=<?= $p['ponto_id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="pontos.php?excluir=<?= $p['ponto_id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Tem certeza que deseja excluir esta batida?');">
                           Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php
    require("rodape.php");
?>
