<?php include "cabecalho.php"; ?>

<h1>Exercício 03 - Imprimir em ordem</h1>
<form method="post">
    <div class="mb-3">
        <label for="v1" class="form-label">Valor A</label>
        <input type="number" id="v1" name="v1" class="form-control" required="" wfd-id="id22">
    </div>
    <div class="mb-3">
        <label for="v2" class="form-label">Valor B</label>
        <input type="number" id="v2" name="v2" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $v1 = $_POST["v1"];
    $v2 = $_POST["v2"];

    if ($v1 == $v2) {
        echo "<p>Números iguais: $v1</p>";
    }
    else{
        if ($v1 < $v2)
            echo "<p>$v1 $v2</p>";
        else
            echo "<p>$v2 $v1</p>";
    }

}

include "rodape.php";
?>