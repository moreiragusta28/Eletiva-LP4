<?php include "cabecalho.php"; ?>

<div class="container py-3">
    <h1>Exercício 13 - Conversor de metros para centímetros</h1>
    <form method="post">
        <div class="mb-3">
            <label for="m1" class="form-label">Metros</label>
            <input type="number" id="m1" name="m1" class="form-control" step="any" required="">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $m1 = $_POST["m1"];
        $conversao = $m1 * 100;
        echo "<p>O valor da conversão de metros para centímetros é: " . number_format($conversao, 2) . "</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
    }

    include "rodape.php";
    ?>