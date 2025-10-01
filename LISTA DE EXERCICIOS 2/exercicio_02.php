<?php include "cabecalho.php"; ?>

<h1>Exercício 2 - Soma com condição</h1>
<form method="post">
    <div class="mb-3">
        <label for="v1" class="form-label">Primero valor</label>
        <input type="number" id="v1" name="v1" class="form-control" required="" wfd-id="id22">
    </div>
    <div class="mb-3">
        <label for="v2" class="form-label">Segundo valor</label>
        <input type="number" id="v2" name="v2" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $v1 = $_POST["v1"];
    $v2 = $_POST["v2"];

    if ($v1 == $v2) {
        $calculo = ($v1 + $v2) * 3;
        echo "<p>Valores de entrada iguais, o triplo da soma é de: $calculo</p>";
    }
    else{
        $calculo = $v1 + $v2;
        echo "<p>O valor da soma é de: $calculo</p>";
    }

}

include "rodape.php";
?>