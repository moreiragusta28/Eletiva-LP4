<?php include "cabecalho.php"; ?>


<div class="container py-3">
    <h1>Exercício 07 - Fahrenheit</h1>
    <form method="post">
        <div class="mb-3">
            <label for="f1" class="form-label">Temperatura em Fahrenheit</label>
            <input type="number" id="f1" name="f1" class="form-control" required="" wfd-id="id22">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $f1 = $_POST["f1"];
        $conversao = ($f1 - 32) * 5 / 9;
        echo "<p>A temperatura em Celsius é de: " . number_format($conversao, 2) . "</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
    }


    include "rodape.php";
    ?>