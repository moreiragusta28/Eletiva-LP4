<?php include "cabecalho.php"; ?>

<div class="container py-3">
    <h1>Exercício 04 - Divisão</h1>
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
        if ($n2 == 0) {
            echo "<p>Não é possível dividir por 0!<p>";
        } else {
            $multiplicacao = $n1 / $n2;
            echo "<p>Resultado da divisão: $multiplicacao</p>";
        }
    }

    include "rodape.php";
    ?>