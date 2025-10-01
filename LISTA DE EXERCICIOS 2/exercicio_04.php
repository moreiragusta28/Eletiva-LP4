<?php include "cabecalho.php"; ?>

<h1>Exercício 04 - Valor produto</h1>
<form method="post">
    <div class="mb-3">
        <label for="v1" class="form-label">Informe o valor do produdo</label>
        <input type="number" id="v1" name="v1" class="form-control" step = "any" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $v1 = $_POST["v1"];

    if ($v1 >= 100) {
        $calculo = $v1 - ($v1 * 0.15);
        echo "<p>Valor superior a R$ 100,00, novo valor com o desconto de 15% aplicado: R$ ". number_format($calculo, 2, ".", ",") ."</p>";
    }
    else{
        echo "<p>Valor menor que R$ 100,00</p>";
    }

}

include "rodape.php";
?>