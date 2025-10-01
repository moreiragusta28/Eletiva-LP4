<?php include "cabecalho.php"; ?>

<div class="container py-3">
    <h1>Exercício 09 - Área de círculo</h1>
    <form method="post">
        <div class="mb-3">
            <label for="r1" class="form-label">Raio</label>
            <input type="number" id="r1" name="r1" class="form-control" required="" wfd-id="id22">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $r1 = $_POST["r1"];
        $area = ($r1 ** 2) * 3.14;
        echo "<p>A área do círculo é de: " . number_format($area, 2) . "</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
    }

    include "rodape.php";
    ?>