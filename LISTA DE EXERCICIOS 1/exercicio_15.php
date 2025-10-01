<?php include "cabecalho.php"; ?>


<div class="container py-3">
    <h1>Exercício 15 - IMC</h1>
    <form method="post">
        <div class="mb-3">
            <label for="p1" class="form-label">Peso (kg)</label>
            <input type="number" id="p1" name="p1" class="form-control" step="any" required="" wfd-id="id22">
        </div>
        <div class="mb-3">
            <label for="a1" class="form-label">Altura (metros)</label>
            <input type="number" id="a1" name="a1" class="form-control" step="any" required="">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $p1 = $_POST["p1"];
        $a1 = $_POST["a1"];
        $calculo = ($p1 / ($a1 ** 2));
        echo "<p>O valor do IMC é: " . number_format($calculo, 2) . "</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
    }


    include "rodape.php";
    ?>