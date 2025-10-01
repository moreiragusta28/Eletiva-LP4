<?php include "cabecalho.php"; ?>

<h1>Exercício 05 - Mês</h1>
<form method="post">
    <div class="mb-3">
        <label for="m1" class="form-label">Insira o número de referência</label>
        <input type="number" id="m1" name="m1" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $m1 = $_POST["m1"];

    switch ($m1) {
        case 1:
            echo "<p>Janeiro</p>";
            break;
        case 2:
            echo "<p>Fevereiro</p>";
            break;
        case 3:
            echo "<p>Março</p>";
            break;
        case 4:
            echo "<p>Abril</p>";
            break;
        case 5:
            echo "<p>Maio</p>";
            break;
        case 6:
            echo "<p>Junho</p>";
            break;
        case 7:
            echo "<p>Julho</p>";
            break;
        case 8:
            echo "<p>Agosto</p>";
            break;
        case 9:
            echo "<p>Setembro</p>";
            break;
        case 10:
            echo "<p>Outubro</p>";
            break;
        case 11:
            echo "<p>Novembro</p>";
            break;
        case 12:
            echo "<p>Dezembro</p>";
            break;
        default:
            echo "<p>Número inválido. Por favor, insira um número entre 1 e 12.</p>";
            break;
    }
}

include "rodape.php";
?>