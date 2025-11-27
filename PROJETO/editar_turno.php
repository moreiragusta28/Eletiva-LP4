<?php
    require("cabecalho.php");
    require("conexao.php");

    if (!isset($_GET['id'])) {
        echo "<p class='text-danger'>Turno não informado.</p>";
        require("rodape.php");
        exit;
    }

    $id = (int) $_GET['id'];

    // Carrega turno
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

    // Atualização
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nome        = $_POST['nome'];
        $periodo     = $_POST['periodo'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fim    = $_POST['hora_fim'];

        try {
            $stmt = $pdo->prepare("
                UPDATE turno
                   SET nome = ?, periodo = ?, hora_inicio = ?, hora_fim = ?
                 WHERE turno_id = ?
            ");
            if ($stmt->execute([$nome, $periodo, $hora_inicio, $hora_fim, $id])) {
                header('location: turnos.php?editar=true');
                exit;
            } else {
                header('location: turnos.php?editar=false');
                exit;
            }
        } catch (Exception $e) {
            echo "<p class='text-danger'>Erro ao editar turno: " . $e->getMessage() . "</p>";
        }
    }
?>

<h1>Editar Turno</h1>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do turno:</label>
        <input type="text" id="nome" name="nome" class="form-control" required
               value="<?= htmlspecialchars($turno['nome']) ?>">
    </div>
    <div class="mb-3">
        <label for="periodo" class="form-label">Período:</label>
        <select id="periodo" name="periodo" class="form-select" required>
            <option value="Manha"     <?= $turno['periodo'] === 'Manha'     ? 'selected' : '' ?>>Manhã</option>
            <option value="Tarde"     <?= $turno['periodo'] === 'Tarde'     ? 'selected' : '' ?>>Tarde</option>
            <option value="Noite"     <?= $turno['periodo'] === 'Noite'     ? 'selected' : '' ?>>Noite</option>
            <option value="Madrugada" <?= $turno['periodo'] === 'Madrugada' ? 'selected' : '' ?>>Madrugada</option>
            <option value="Flexivel"  <?= $turno['periodo'] === 'Flexivel'  ? 'selected' : '' ?>>Flexível</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="hora_inicio" class="form-label">Hora de início:</label>
        <input type="time" id="hora_inicio" name="hora_inicio" class="form-control" required
               value="<?= $turno['hora_inicio'] ?>">
    </div>
    <div class="mb-3">
        <label for="hora_fim" class="form-label">Hora de fim:</label>
        <input type="time" id="hora_fim" name="hora_fim" class="form-control" required
               value="<?= $turno['hora_fim'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<?php
    require("rodape.php");
?>
