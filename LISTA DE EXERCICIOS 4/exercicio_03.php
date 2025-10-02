<?php include("cabecalho.php"); ?>

<h1>Exercício 3 - Produtos</h1>
<form method="post">
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <p>Dados do Produto <?= $i ?></p>
        <div class="row inline-row mb-3">
            <div class="col-md-4">
                <label for="codigo[]" class="form-label">Código</label>
                <input type="text" id="codigo[]" name="codigo[]" class="form-control" required="">
            </div>
            <div class="col-md-4">
                <label for="nome[]" class="form-label">Nome</label>
                <input type="text" id="nome[]" name="nome[]" class="form-control" required="">
            </div>
            <div class="col-md-4">
                <label for="preco[]" class="form-label">Preço</label>
                <input type="number" id="preco[]" name="preco[]" class="form-control" step="0.01" required="">
            </div>
        </div>
    <?php endfor; ?>
    <button type="submit" class="btn btn-primary mt-3">Enviar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigos = $_POST['codigo'];
    $nomes = $_POST['nome'];
    $precos = $_POST['preco'];

    $produtos = [];

    for ($i = 0; $i < 5; $i++) {
        $codigo = $codigos[$i];
        $nome = $nomes[$i];
        $preco = $precos[$i];

        if ($preco > 100) // aplica o desconto de 10% se o preço for acima de 100
            $preco_final = $preco - $preco * 0.10;
        else
            $preco_final = $preco;

        $detalhes = [
            'nome' => $nome,
            'preco' => $preco_final
        ];

        ksort($detalhes); //tem que usar o ksort aqui pra ele ordernar pelo nome, se não ele usaria o codigo como referencia
        $produtos[$codigo] = $detalhes;

    }

    asort($produtos); //ordena um array associativo pelos seus valores, mantendo a associação entre as chaves e os valores

    echo "Lista de Produtos";
    foreach ($produtos as $codigo => $detalhes) {
        $nome = $produtos[$codigo]['nome'];
        $preco = number_format($produtos[$codigo]['preco'], 2, ',', '.');
        echo "<p>Código: $codigo | Nome: $nome | Preço: R$ $preco</p>";
    }
}

include("rodape.php");
?>