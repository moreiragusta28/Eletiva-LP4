<?php include "cabecalho.php"; ?>

<div class="container py-3">
    <h1>Exercício 17 - Juros Simples</h1>
    <form method="post">
        <div class="mb-3">
            <label for="c1" class="form-label">Capital</label>
            <input type="number" id="c1" name="c1" class="form-control" required="" wfd-id="id37">
        </div>
        <div class="mb-3">
            <label for="t1" class="form-label">Taxa</label>
            <input type="number" id="t1" name="t1" class="form-control" required="" wfd-id="id38">
        </div>
        <div class="mb-3">
            <label for="p1" class="form-label">Período</label>
            <input type="number" id="p1" name="p1" class="form-control" required="">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $c1 = $_POST["c1"];
        $t1 = $_POST["t1"];
        $p1 = $_POST["p1"];
        $calculo = ($c1 * ($t1 / 100) * $p1);
        echo "<p>O valor dos juros simples é: R$ " . number_format($calculo, 2) . "</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
    }


    include "rodape.php";
    ?>