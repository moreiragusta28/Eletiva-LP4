<?php
    require("cabecalho.php");
    require("conexao.php");

    if (!isset($_GET['id'])) {
        echo "<p class='text-danger'>Batida não informada.</p>";
        require("rodape.php");
        exit;
    }

    $id = (int) $_GET['id'];

    // Carrega batida
    try {
        $stmt = $pdo->prepare("
            SELECT * FROM ponto WHERE ponto_id = ?
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

    // Carrega funcionários
    try {
        $stmt = $pdo->query("SELECT funcionario_id, nome FROM funcionario ORDER BY nome");
        $funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar funcionários: " . $e->getMessage() . "</p>";
    }

    // Quebra data e hora para exibir no form
    $data_form = date('Y-m-d', strtotime($ponto['data_hora']));
    $hora_form = date('H:i', strtotime($ponto['data_hora']));

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $funcionario_id = $_POST['funcionario_id'];
        $data           = $_POST['data'];
        $hora           = $_POST['hora'];
        $tipo           = $_POST['tipo'];

        $data_hora = $data . ' ' . $hora . ':00';

        try {
            $stmt = $pdo->prepare("
                UPDATE ponto
                   SET funcionario_id = ?, data_hora = ?, tipo = ?
                 WHERE ponto_id = ?
            ");

            if ($stmt->execute([$funcionario_id, $data_hora, $tipo, $id])) {
                header('location: pontos.php?editar=true');
                exit;
            } else {
                header('location: pontos.php?editar=false');
                exit;
            }
        } catch (Exception $e) {
            echo "<p class='text-danger'>Erro ao editar batida: " . $e->getMessage() . "</p>";
        }
    }
?>

<h1>Editar Batida de Ponto</h1>
<form method="post">
    <div class="mb-3">
        <label for="funcionario_id" class="form-label">Funcionário:</label>
        <select id="funcionario_id" name="funcionario_id" class="form-select" required>
            <?php if (!empty($funcionarios)): ?>
                <?php foreach ($funcionarios as $f): ?>
                    <option value="<?= $f['funcionario_id'] ?>"
                        <?= $f['funcionario_id'] == $ponto['funcionario_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($f['nome']) ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="data" class="form-label">Data:</label>
        <input type="date" id="data" name="data" class="form-control" required
               value="<?= $data_form ?>">
    </div>
    <div class="mb-3">
        <label for="hora" class="form-label">Hora:</label>
        <input type="time" id="hora" name="hora" class="form-control" required
               value="<?= $hora_form ?>">
    </div>
    <div class="mb-3">
        <label for="tipo" class="form-label">Tipo de batida:</label>
        <select id="tipo" name="tipo" class="form-select" required>
            <option value="ENTRADA" <?= $ponto['tipo'] == 'ENTRADA' ? 'selected' : '' ?>>ENTRADA</option>
            <option value="SAIDA"   <?= $ponto['tipo'] == 'SAIDA'   ? 'selected' : '' ?>>SAÍDA</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<?php
    require("rodape.php");
?>
