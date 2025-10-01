<?php include "cabecalho.php"; ?>

<div class="container py-3">
    <h1>Exercício 12 - Base e Expoente</h1>
    <form method="post">
        <div class="mb-3">
            <label for="b1" class="form-label">Base</label>
            <input type="number" id="b1" name="b1" class="form-control" required="" wfd-id="id22">
        </div>
        <div class="mb-3">
            <label for="e1" class="form-label">Expoente</label>
            <input type="number" id="e1" name="e1" class="form-control" required="">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $b1 = $_POST["b1"];
        $e1 = $_POST["e1"];
        $resultado = $b1 ** $e1;
        echo "<p>O resultado da base elevada ao expoente é de: " . number_format($resultado, 2) . "</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
    }

    include "rodape.php";
    ?>