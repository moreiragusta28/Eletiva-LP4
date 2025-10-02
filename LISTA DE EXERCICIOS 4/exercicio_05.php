<?php include("cabecalho.php"); ?>

<h1>Exercício 5 - Livros</h1>
<form method="post">
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <p>Dados do Livro <?= $i ?></p>
        <div class="row inline-row mb-3">
            <div class="col-md-6">
                <label for="nome[]" class="form-label">Nome</label>
                <input type="text" id="nome[]" name="nome[]" class="form-control" required="">
            </div>
            <div class="col-md-6">
                <label for="qtde[]" class="form-label">Quantidade em estoque</label>
                <input type="number" id="qtde[]" name="qtde[]" class="form-control" required="">
            </div>
        </div>
    <?php endfor; ?>
    <button type="submit" class="btn btn-primary mt-3">Enviar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomes = $_POST['nome'];
    $quantidades = $_POST['qtde'];

    $livros = [];

    for ($i = 0; $i < 5; $i++) {
        $nome = $nomes[$i];
        $qtde = $quantidades[$i];

        $livros[$nome] = $qtde;
    }

    ksort($livros);

    echo "<p>Lista de Livros</p>";
    foreach ($livros as $nome => $qtde) {
        if ($qtde < 5)
            echo "<p>Livro: $nome / Estoque: $qtde --- ATENÇÃO, ESTOQUE COM BAIXA QUANTIDADE</p>";
        else
            echo "<p>Livro: $nome / Estoque: $qtde</p>";

    }
}

include("rodape.php");
?>