<?php include "cabecalho.php"; ?>

<div class="container py-3">
    <h1>Exercício 08 - Área de retângulo</h1>
    <form method="post">
        <div class="mb-3">
            <label for="a1" class="form-label">Altura - a</label>
            <input type="number" id="a1" name="a1" class="form-control" required="" wfd-id="id22">
        </div>
        <div class="mb-3">
            <label for="l1" class="form-label">Largura - l</label>
            <input type="number" id="l1" name="l1" class="form-control" required="">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a1 = $_POST["a1"];
        $l1 = $_POST["l1"];
        $area = ($a1 * $l1);
        echo "<p>A área do retângulo é de: " . number_format($area, 2) . "</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
    }


    include "rodape.php";
    ?>