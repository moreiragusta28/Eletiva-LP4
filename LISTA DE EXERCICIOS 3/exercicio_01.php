<?php include "cabecalho.php"; ?>


<h1>Exercício 01 - Quantidade de caracteres</h1>
<form method="post">
    <div class="mb-3">
        <label for="palavra" class="form-label">Insira uma palavra</label>
        <input type="text" id="palavra" name="palavra" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $palavra = $_POST["palavra"];

    function quantidadeCaracteres($palavra){
        echo "<p>A palavra contém ".strlen($palavra)." caracteres</p>";
    }

    quantidadeCaracteres($palavra);
}

include "rodape.php";
?>