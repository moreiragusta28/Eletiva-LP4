<?php
    require("cabecalho.php");
    require("conexao.php");

    // Carrega funcionários
    try {
        $stmt = $pdo->query("SELECT funcionario_id, nome FROM funcionario ORDER BY nome");
        $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar funcionários: " . $e->getMessage() . "</p>";
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $funcionario_id = $_POST['funcionario_id'];
        $data           = $_POST['data'];
        $hora           = $_POST['hora'];
        $tipo           = $_POST['tipo'];

        // monta datetime
        $data_hora = $data . ' ' . $hora . ':00';

        try {
            $stmt = $pdo->prepare("
                INSERT INTO ponto (funcionario_id, data_hora, tipo)
                VALUES (?, ?, ?)
            ");

            if ($stmt->execute([$funcionario_id, $data_hora, $tipo])) {
                header('location: pontos.php?cadastro=true');
                exit;
            } else {
                header('location: pontos.php?cadastro=false');
                exit;
            }
        } catch (Exception $e) {
            echo "<p class='text-danger'>Erro ao registrar batida: " . $e->getMessage() . "</p>";
        }
    }
?>

<h1>Nova Batida de Ponto</h1>
<form method="post">
    <div class="mb-3">
        <label for="funcionario_id" class="form-label">Funcionário:</label>
        <select id="funcionario_id" name="funcionario_id" class="form-select" required>
            <option value="">Selecione...</option>
            <?php if (!empty($funcionarios)): ?>
                <?php foreach ($funcionarios as $f): ?>
                    <option value="<?= $f['funcionario_id'] ?>"><?= htmlspecialchars($f['nome']) ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="data" class="form-label">Data:</label>
        <input type="date" id="data" name="data" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="hora" class="form-label">Hora:</label>
        <input type="time" id="hora" name="hora" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo de batida:</label>
        <select id="tipo" name="tipo" class="form-select" required>
            <option value="ENTRADA">ENTRADA</option>
            <option value="SAIDA">SAÍDA</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Registrar</button>
</form>

<?php
    require("rodape.php");
?>
