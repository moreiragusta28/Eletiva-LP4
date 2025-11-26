<?php
    require("cabecalho.php");
    require("conexao.php");

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

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nome     = $_POST['nome'];
        $salario  = $_POST['salario'];
        $cargo_id = $_POST['cargo_id'];
        $turno_id = $_POST['turno_id'];

        try {
            $stmt = $pdo->prepare("
                INSERT INTO funcionario (nome, salario, cargo_id, turno_id)
                VALUES (?, ?, ?, ?)
            ");

            if ($stmt->execute([$nome, $salario, $cargo_id, $turno_id])) {
                header('location: funcionarios.php?cadastro=true');
                exit;
            } else {
                header('location: funcionarios.php?cadastro=false');
                exit;
            }
        } catch (Exception $e) {
            echo "<p class='text-danger'>Erro ao cadastrar funcionário: " . $e->getMessage() . "</p>";
        }
    }
?>

<h1>Novo Funcionário</h1>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do funcionário:</label>
        <input type="text" id="nome" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="salario" class="form-label">Salário:</label>
        <input type="number" step="0.01" id="salario" name="salario" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="cargo_id" class="form-label">Cargo:</label>
        <select id="cargo_id" name="cargo_id" class="form-select" required>
            <option value="">Selecione...</option>
            <?php if (!empty($cargos)): ?>
                <?php foreach ($cargos as $c): ?>
                    <option value="<?= $c['cargo_id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="turno_id" class="form-label">Turno de trabalho:</label>
        <select id="turno_id" name="turno_id" class="form-select" required>
            <option value="">Selecione...</option>
            <?php if (!empty($turnos)): ?>
                <?php foreach ($turnos as $t): ?>
                    <option value="<?= $t['turno_id'] ?>">
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