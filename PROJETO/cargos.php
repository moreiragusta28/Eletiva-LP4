<?php
    require("cabecalho.php");
    require("conexao.php");

    // Exclusão de cargo (se vier ?excluir=ID)
    if (isset($_GET['excluir'])) {
        $id = (int) $_GET['excluir'];
        try {
            $stmt = $pdo->prepare("DELETE FROM cargo WHERE cargo_id = ?");
            if ($stmt->execute([$id])) {
                header('location: cargos.php?excluir=true');
                exit;
            } else {
                header('location: cargos.php?excluir=false');
                exit;
            }
        } catch (Exception $e) {
            // 23000 = violação de integridade (chave estrangeira, etc.)
            if ($e->getCode() == 23000) {
                header('location: cargos.php?erro_dependencia=1');
                exit;
            } else {
                header('location: cargos.php?excluir=false');
                exit;
            }
        }
    }

    // Listagem de cargos
    try {
        $stmt = $pdo->query("SELECT * FROM cargo");
        $cargos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar cargos: " . $e->getMessage() . "</p>";
    }

    if (isset($_GET['cadastro'])) {
        if ($_GET['cadastro'] == 'true') {
            echo "<p class='text-success'>Cargo cadastrado com sucesso!</p>";
        } else {
            echo "<p class='text-danger'>Erro ao cadastrar cargo!</p>";
        }
    }

    if (isset($_GET['editar'])) {
        if ($_GET['editar'] == 'true') {
            echo "<p class='text-success'>Cargo editado com sucesso!</p>";
        } else {
            echo "<p class='text-danger'>Erro ao editar cargo!</p>";
        }
    }

    if (isset($_GET['excluir'])) {
        if ($_GET['excluir'] == 'true') {
            echo "<p class='text-success'>Cargo excluído com sucesso!</p>";
        } else if ($_GET['excluir'] == 'false') {
            echo "<p class='text-danger'>Erro ao excluir cargo!</p>";
        }
    }

    if (isset($_GET['erro_dependencia']) && $_GET['erro_dependencia'] == '1') {
        echo "<p class='text-danger'>
                Não é possível excluir este cargo, pois existem funcionários vinculados a ele.
              </p>";
    }
?>

<h1>Cargos</h1>
<a href="novo_cargo.php" class="btn btn-primary mb-3">Novo Cargo</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome do Cargo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($cargos)): ?>
            <?php foreach ($cargos as $c): ?>
                <tr>
                    <td><?= $c['cargo_id'] ?></td>
                    <td><?= htmlspecialchars($c['nome']) ?></td>
                    <td class="d-flex gap-2">
                        <a href="consultar_cargo.php?id=<?= $c['cargo_id'] ?>" class="btn btn-sm btn-info">Consultar</a>
                        <a href="editar_cargo.php?id=<?= $c['cargo_id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="cargos.php?excluir=<?= $c['cargo_id'] ?>" class="btn btn-sm btn-danger"
                           onclick="return confirm('Tem certeza que deseja excluir este cargo?');">
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