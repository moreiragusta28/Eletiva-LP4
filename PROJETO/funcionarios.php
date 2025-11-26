<?php
    require("cabecalho.php");
    require("conexao.php");

    // Exclusão de funcionário (se vier ?excluir=ID)
    if (isset($_GET['excluir'])) {
        $id = (int) $_GET['excluir'];
        try {
            $stmt = $pdo->prepare("DELETE FROM funcionario WHERE funcionario_id = ?");
            if ($stmt->execute([$id])) {
                header('location: funcionarios.php?excluir=true');
                exit;
            } else {
                header('location: funcionarios.php?excluir=false');
                exit;
            }
        } catch (Exception $e) {
            echo "<p class='text-danger'>Erro ao excluir funcionário: " . $e->getMessage() . "</p>";
        }
    }

    // Listagem de funcionários com cargo e turno
    try {
        $stmt = $pdo->query("
            SELECT f.funcionario_id, f.nome, f.salario,
                   c.nome AS cargo,
                   t.nome AS turno, t.periodo, t.hora_inicio, t.hora_fim
            FROM funcionario f
            INNER JOIN cargo c ON c.cargo_id = f.cargo_id
            INNER JOIN turno t ON t.turno_id = f.turno_id
        ");
        $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar funcionários: " . $e->getMessage() . "</p>";
    }

    if (isset($_GET['cadastro'])) {
        if ($_GET['cadastro'] == 'true') {
            echo "<p class='text-success'>Funcionário cadastrado com sucesso!</p>";
        } else {
            echo "<p class='text-danger'>Erro ao cadastrar funcionário!</p>";
        }
    }

    if (isset($_GET['editar'])) {
        if ($_GET['editar'] == 'true') {
            echo "<p class='text-success'>Funcionário editado com sucesso!</p>";
        } else {
            echo "<p class='text-danger'>Erro ao editar funcionário!</p>";
        }
    }

    if (isset($_GET['excluir'])) {
        if ($_GET['excluir'] == 'true') {
            echo "<p class='text-success'>Funcionário excluído com sucesso!</p>";
        } else if ($_GET['excluir'] == 'false') {
            echo "<p class='text-danger'>Erro ao excluir funcionário!</p>";
        }
    }
?>

<h1>Funcionários</h1>
<a href="novo_funcionario.php" class="btn btn-primary mb-3">Novo Funcionário</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Salário</th>
            <th>Cargo</th>
            <th>Turno</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($funcionarios)): ?>
            <?php foreach ($funcionarios as $f): ?>
                <tr>
                    <td><?= $f['funcionario_id'] ?></td>
                    <td><?= htmlspecialchars($f['nome']) ?></td>
                    <td>R$ <?= number_format($f['salario'], 2, ',', '.') ?></td>
                    <td><?= htmlspecialchars($f['cargo']) ?></td>
                    <td>
                        <?= htmlspecialchars($f['turno']) ?> - <?= htmlspecialchars($f['periodo']) ?>
                        (<?= $f['hora_inicio'] ?> às <?= $f['hora_fim'] ?>)
                    </td>
                    <td class="d-flex gap-2">
                        <a href="consultar_funcionario.php?id=<?= $f['funcionario_id'] ?>" class="btn btn-sm btn-info">Consultar</a>
                        <a href="editar_funcionario.php?id=<?= $f['funcionario_id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="funcionarios.php?excluir=<?= $f['funcionario_id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Tem certeza que deseja excluir este funcionário?');">
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