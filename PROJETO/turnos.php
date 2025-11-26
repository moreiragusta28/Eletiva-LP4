<?php
    require("cabecalho.php");
    require("conexao.php");

    // Exclusão de turno
    if (isset($_GET['excluir'])) {
        $id = (int) $_GET['excluir'];

        try {
            $stmt = $pdo->prepare("DELETE FROM turno WHERE turno_id = ?");
            if ($stmt->execute([$id])) {
                header('location: turnos.php?excluir=true');
                exit;
            } else {
                header('location: turnos.php?excluir=false');
                exit;
            }
        } catch (Exception $e) {
            echo "<p class='text-danger'>Erro ao excluir turno: " . $e->getMessage() . "</p>";
        }
    }

    // Listagem de turnos
    try {
        $stmt = $pdo->query("SELECT * FROM turno");
        $turnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar turnos: " . $e->getMessage() . "</p>";
    }

    if (isset($_GET['cadastro'])) {
        echo $_GET['cadastro'] == 'true'
            ? "<p class='text-success'>Turno cadastrado com sucesso!</p>"
            : "<p class='text-danger'>Erro ao cadastrar turno!</p>";
    }

    if (isset($_GET['editar'])) {
        echo $_GET['editar'] == 'true'
            ? "<p class='text-success'>Turno editado com sucesso!</p>"
            : "<p class='text-danger'>Erro ao editar turno!</p>";
    }

    if (isset($_GET['excluir'])) {
        echo $_GET['excluir'] == 'true'
            ? "<p class='text-success'>Turno excluído com sucesso!</p>"
            : "<p class='text-danger'>Erro ao excluir turno!</p>";
    }
?>

<h1>Turnos de Trabalho</h1>
<a href="novo_turno.php" class="btn btn-primary mb-3">Novo Turno</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Período</th>
            <th>Horário</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($turnos)): ?>
            <?php foreach ($turnos as $t): ?>
                <tr>
                    <td><?= $t['turno_id'] ?></td>
                    <td><?= htmlspecialchars($t['nome']) ?></td>
                    <td><?= htmlspecialchars($t['periodo']) ?></td>
                    <td><?= $t['hora_inicio'] ?> às <?= $t['hora_fim'] ?></td>
                    <td class="d-flex gap-2">
                        <a href="consultar_turno.php?id=<?= $t['turno_id'] ?>" class="btn btn-sm btn-info">Consultar</a>
                        <a href="editar_turno.php?id=<?= $t['turno_id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="turnos.php?excluir=<?= $t['turno_id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Tem certeza que deseja excluir este turno?');">
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