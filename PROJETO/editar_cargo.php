<?php
    require("cabecalho.php");
    require("conexao.php");

    // Carrega o cargo
    if (!isset($_GET['id'])) {
        echo "<p class='text-danger'>Cargo não informado.</p>";
        require("rodape.php");
        exit;
    }

    $id = (int) $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM cargo WHERE cargo_id = ?");
        $stmt->execute([$id]);
        $cargo = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p class='text-danger'>Erro ao consultar cargo: " . $e->getMessage() . "</p>";
    }

    if (!$cargo) {
        echo "<p class='text-danger'>Cargo não encontrado.</p>";
        require("rodape.php");
        exit;
    }

    // Atualização
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nome = $_POST['nome'];

        try {
            $stmt = $pdo->prepare("UPDATE cargo SET nome = ? WHERE cargo_id = ?");
            if ($stmt->execute([$nome, $id])) {
                header('location: cargos.php?editar=true');
                exit;
            } else {
                header('location: cargos.php?editar=false');
                exit;
            }
        } catch (Exception $e) {
            echo "<p class='text-danger'>Erro ao editar cargo: " . $e->getMessage() . "</p>";
        }
    }
?>

<h1>Editar Cargo</h1>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do cargo:</label>
        <input type="text" id="nome" name="nome" class="form-control" required
               value="<?= htmlspecialchars($cargo['nome']) ?>">
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<?php
    require("rodape.php");
?>