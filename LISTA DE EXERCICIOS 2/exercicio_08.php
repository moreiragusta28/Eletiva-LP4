<?php include "cabecalho.php"; ?>

<h1>Exercício 08 - Contagem regressiva com do-while</h1>
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

    do{
        echo "<p>$n1</p>";
        $n1 = $n1 - 1;
    }
    while($n1 >= 1);
}

include "rodape.php";
?>