<?php include "cabecalho.php"; ?>


<div class="container py-3">
    <h1>Exercício 20 - Velocidade Média</h1>
    <form method="post">
        <div class="mb-3">
            <label for="d1" class="form-label">Distância</label>
            <input type="number" id="d1" name="d1" class="form-control" required="" wfd-id="id22">
        </div>
        <div class="mb-3">
            <label for="t1" class="form-label">Tempo</label>
            <input type="number" id="t1" name="t1" class="form-control" required="">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $d1 = $_POST["d1"];
        $t1 = $_POST["t1"];
        $calculo = ($d1 / $t1);
        echo "<p>O valor da velocidade média é: " . number_format($calculo, 2) . "</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
    }

    include "rodape.php";
    ?>