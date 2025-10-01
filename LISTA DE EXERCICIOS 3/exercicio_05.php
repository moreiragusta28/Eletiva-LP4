<?php include "cabecalho.php"; ?>

<h1>Exercício 05 - Raiz quadrada</h1>
<form method="post">
    <div class="mb-3">
        <label for="numero" class="form-label">Informe um número</label>
        <input type="number" id="numero" name="numero" class="form-control" step = "any" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST["numero"];

    function calcularRaiz($numero)
    {
        $raiz = sqrt($numero);
        echo "<p>A raiz quadrada de $numero é: ".number_format($raiz, 2, ",", "."). "</p>";

    }

    calcularRaiz($numero);
}

include "rodape.php";
?>