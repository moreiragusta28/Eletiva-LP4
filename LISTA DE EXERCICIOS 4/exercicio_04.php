<?php include("cabecalho.php"); ?>

<h1>Exercício 4 - Preços com imposto</h1>
<form method="post">
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <p>Dados do Produto <?= $i ?></p>
        <div class="row inline-row mb-3">
            <div class="col-md-6">
                <label for="nome[]" class="form-label">Nome</label>
                <input type="text" id="nome[]" name="nome[]" class="form-control" required="">
            </div>
            <div class="col-md-6">
                <label for="preco[]" class="form-label">Preço</label>
                <input type="number" id="preco[]" name="preco[]" class="form-control" step="0.01" required="">
            </div>
        </div>
    <?php endfor; ?>
    <button type="submit" class="btn btn-primary mt-3">Enviar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomes = $_POST['nome'];
    $precos = $_POST['preco'];

    $produtos = [];

    for ($i = 0; $i < 5; $i++) {
        $nome = $nomes[$i];
        $preco = $precos[$i];
        $preco_final = $preco * 1.15;

        $produtos[$nome] = $preco_final;
    }

    asort($produtos);

    echo "<p>Lista de Produtos</p>";
    foreach ($produtos as $nome => $preco) {
        echo "<p>Nome: $nome / Preço: R$ " . number_format($preco, 2, ",", ".") ."</p>";
    }
}

include("rodape.php");
?>