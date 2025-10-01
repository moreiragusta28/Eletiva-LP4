<?php include "cabecalho.php"; ?>

<div class="container py-3">
    <h1>Exercício 05 - Notas</h1>
    <form method="post">
        <div class="mb-3">
            <label for="n1" class="form-label">Nota 1</label>
            <input type="number" id="n1" name="n1" class="form-control" required="" wfd-id="id53">
        </div>
        <div class="mb-3">
            <label for="n2" class="form-label">Nota 2</label>
            <input type="number" id="n2" name="n2" class="form-control" required="" wfd-id="id54">
        </div>
        <div class="mb-3">
            <label for="n3" class="form-label">Nota 3</label>
            <input type="number" id="n3" name="n3" class="form-control" required="" wfd-id="id55">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $n1 = $_POST["n1"];
        $n2 = $_POST["n2"];
        $n3 = $_POST["n3"];
        $media = ($n1 + $n2 + $n3) / 3;
        echo "<p>Resultado da média das notas: " . number_format($media, 2, ',', '.') . "</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula e com virgula ao inves de ponto
    }


    include "rodape.php";
    ?>