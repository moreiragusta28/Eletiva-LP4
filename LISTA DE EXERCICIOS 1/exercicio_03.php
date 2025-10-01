<?php include "cabecalho.php"; ?>

<div class="container py-3">
    <h1>Exercício 03 - Multiplicação</h1>
    <form method="post">
        <div class="mb-3">
            <label for="n1" class="form-label">Número 1</label>
            <input type="number" id="n1" name="n1" class="form-control" required="" wfd-id="id37">
        </div>
        <div class="mb-3">
            <label for="n2" class="form-label">Número 2</label>
            <input type="number" id="n2" name="n2" class="form-control" required="" wfd-id="id38">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $n1 = $_POST["n1"];
        $n2 = $_POST["n2"];
        $multiplicacao = $n1 * $n2;
        echo "<p>Resultado da multiplicação: $multiplicacao</p>";
    }

    include "rodape.php";
    ?>