<?php
    require("cabecalho.php");
    require("conexao.php");

    if (!isset($_GET['id'])) {
        echo "<p class='text-danger'>Funcionário não informado.</p>";
        require("rodape.php");
        exit;
    }

    $id = (int) $_GET['id'];

    // Carrega funcionário
    try {
        $stmt = $pdo->prepare("SELECT * FROM funcionario WHERE funcionario_id = ?");
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

    // Carrega cargos
    try {
        $stmt = $pdo->query("SELECT * FROM cargo");
        $cargos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar cargos: " . $e->getMessage() . "</p>";
    }

    // Carrega turnos
    try {
        $stmt = $pdo->query("SELECT * FROM turno");
        $turnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar turnos: " . $e->getMessage() . "</p>";
    }

    // Atualização
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nome     = $_POST['nome'];
        $salario  = $_POST['salario'];
        $cargo_id = $_POST['cargo_id'];
        $turno_id = $_POST['turno_id'];

        try {
            $stmt = $pdo->prepare("
                UPDATE funcionario
                   SET nome = ?, salario = ?, cargo_id = ?, turno_id = ?
                 WHERE funcionario_id = ?
            ");

            if ($stmt->execute([$nome, $salario, $cargo_id, $turno_id, $id])) {
                header('location: funcionarios.php?editar=true');
                exit;
            } else {
                header('location: funcionarios.php?editar=false');
                exit;
            }
        } catch (Exception $e) {
            echo "<p class='text-danger'>Erro ao editar funcionário: " . $e->getMessage() . "</p>";
        }
    }
?>

<h1>Editar Funcionário</h1>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do funcionário:</label>
        <input type="text" id="nome" name="nome" class="form-control" required
               value="<?= htmlspecialchars($funcionario['nome']) ?>">
    </div>
    <div class="mb-3">
        <label for="salario" class="form-label">Salário / Valor hora:</label>
        <input type="number" step="0.01" id="salario" name="salario" class="form-control" required
               value="<?= $funcionario['salario'] ?>">
    </div>
    <div class="mb-3">
        <label for="cargo_id" class="form-label">Cargo:</label>
        <select id="cargo_id" name="cargo_id" class="form-select" required>
            <?php if (!empty($cargos)): ?>
                <?php foreach ($cargos as $c): ?>
                    <option value="<?= $c['cargo_id'] ?>"
                        <?= $c['cargo_id'] == $funcionario['cargo_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['nome']) ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="turno_id" class="form-label">Turno de trabalho:</label>
        <select id="turno_id" name="turno_id" class="form-select" required>
            <?php if (!empty($turnos)): ?>
                <?php foreach ($turnos as $t): ?>
                    <option value="<?= $t['turno_id'] ?>"
                        <?= $t['turno_id'] == $funcionario['turno_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($t['nome']) ?> - <?= htmlspecialchars($t['periodo']) ?>
                        (<?= $t['hora_inicio'] ?> às <?= $t['hora_fim'] ?>)
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<?php
    require("rodape.php");
?>