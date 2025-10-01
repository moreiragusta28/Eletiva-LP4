<?php include "cabecalho.php"; ?>

<h1>Exercício 07 - Somar usando while</h1>
<form method="post">
    <div class="mb-3">
        <label for="n1" class="form-label">Insira um número</label>
        <input type="number" id="n1" name="n1" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n1 = $_POST["n1"];

    $soma = 0;
    $i = 0;
    while($i <= $n1){
        $soma = $soma + $i;
        $i++;
    }

    echo "<p>O valor da soma é de: $soma</p>";
}

include "rodape.php";
?>