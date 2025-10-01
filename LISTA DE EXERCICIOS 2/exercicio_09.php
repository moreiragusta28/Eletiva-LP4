<?php include "cabecalho.php"; ?>

<h1>Exercício 09 - Fatorial com for</h1>
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

    $fatorial = 1;
    for($i = 1; $i <= $n1; $i++){
        $fatorial = $fatorial * $i;
    }

    echo "<p>O valor do fatorial de $n1 é: $fatorial</p>";
}

include "rodape.php";
?>