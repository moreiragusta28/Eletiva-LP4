<?php include "cabecalho.php"; ?>

<h1>Exercício 03 - Palavra contida</h1>
<form method="post">
    <div class="mb-3">
        <label for="p1" class="form-label">Insira a primeira palavra</label>
        <input type="text" id="p1" name="p1" class="form-control" required="" wfd-id="id22">
    </div>
    <div class="mb-3">
        <label for="p2" class="form-label">Insira a segunda palavra</label>
        <input type="text" id="p2" name="p2" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $p1 = $_POST["p1"];
    $p2 = $_POST["p2"];

    function verificarContida($p1, $p2)
    {
        $verificardor = strpos($p1, $p2);
        if ($verificardor)
            echo "<p>A segunda palavra está contida na primeira</p>";
        else
            echo "<p>A segunda palavra NÃO está contida na primeira</p>";
    }

    verificarContida($p1, $p2);
}

include "rodape.php";
?>