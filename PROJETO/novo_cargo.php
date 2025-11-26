<?php
    require("cabecalho.php");
    require("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nome = $_POST['nome'];

        try {
            $stmt = $pdo->prepare("INSERT INTO cargo (nome) VALUES (?)");

            if ($stmt->execute([$nome])) {
                header('location: cargos.php?cadastro=true');
                exit;
            } else {
                header('location: cargos.php?cadastro=false');
                exit;
            }
        } catch (Exception $e) {
            echo "<p class='text-danger'>Erro: " . $e->getMessage() . "</p>";
        }
    }
?>

<h1>Novo Cargo</h1>
<form method="post">
    <div class="mb-3">
        <label for="nome" class="form-label">Nome do cargo:</label>
        <input type="text" id="nome" name="nome" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>

<?php
    require("rodape.php");
?>