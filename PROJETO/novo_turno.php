<?php
    require("cabecalho.php");
    require("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nome        = $_POST['nome'];
        $periodo     = $_POST['periodo'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fim    = $_POST['hora_fim'];

        try {
            $stmt = $pdo->prepare("
                INSERT INTO turno (nome, periodo, hora_inicio, hora_fim)
                VALUES (?, ?, ?, ?)
            ");

            if ($stmt->execute([$nome, $periodo, $hora_inicio, $hora_fim])) {
                header('location: turnos.php?cadastro=true');
                exit;
            } else {
                header('location: turnos.php?cadastro=false');
                exit;
            }
        } catch (Exception $e) {
            echo "<p class='text-danger'>Erro ao cadastrar turno: " . $e->getMessage() . "</p>";
        }
    }
?>

<h1>Novo Turno</h1>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do turno:</label>
        <input type="text" id="nome" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="periodo" class="form-label">Período:</label>
        <select id="periodo" name="periodo" class="form-select" required>
            <option value="">Selecione...</option>
            <option value="Manha">Manhã</option>
            <option value="Tarde">Tarde</option>
            <option value="Noite">Noite</option>
            <option value="Madrugada">Madrugada</option>
            <option value="Flexivel">Flexível</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="hora_inicio" class="form-label">Hora de início:</label>
        <input type="time" id="hora_inicio" name="hora_inicio" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="hora_fim" class="form-label">Hora de fim:</label>
        <input type="time" id="hora_fim" name="hora_fim" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<?php
    require("rodape.php");
?>