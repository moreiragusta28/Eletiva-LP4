<?php include "cabecalho.php"; ?>

<h1>Exercício 06 - Arredondar número</h1>
<form method="post">
    <div class="mb-3">
        <label for="numero" class="form-label">Informe um número</label>
        <input type="number" id="numero" name="numero" class="form-control" step="any" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST["numero"];

    function arredondarNumero($numero)
    {
        $novo = round($numero);
        echo "<p>Numero arredondado: $novo</p>";
    }

    arredondarNumero($numero);
}

include "rodape.php";
?>