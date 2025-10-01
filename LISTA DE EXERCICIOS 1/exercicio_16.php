<?php include "cabecalho.php"; ?>


<div class="container py-3">
    <h1>Exercício 16 - Desconto</h1>
    <form method="post">
        <div class="mb-3">
            <label for="p1" class="form-label">Preço</label>
            <input type="number" id="p1" name="p1" class="form-control" step="any" required="" wfd-id="id22">
        </div>
        <div class="mb-3">
            <label for="d1" class="form-label">Percentual de desconto</label>
            <input type="number" id="d1" name="d1" class="form-control" step="any" required="">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $p1 = $_POST["p1"];
        $d1 = $_POST["d1"];
        $calculo = ($p1 - ($p1 * $d1 / 100));
        echo "<p>O valor do preço com o desconto é: R$ " . number_format($calculo, 2) . "</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
    }


    include "rodape.php";
    ?>