<?php include "cabecalho.php"; ?>

<h1>Exercício 04 - Três valores em data formatada</h1>
<form method="post">
    <div class="row inline-row mb-3">
        <div class="col-md-4">
            <label for="dia" class="form-label">Informe o dia</label>
            <input type="number" id="dia" name="dia" class="form-control" required="" wfd-id="id37">
        </div>
        <div class="col-md-4">
            <label for="mes" class="form-label">Informe o mês</label>
            <input type="number" id="mes" name="mes" class="form-control" required="" wfd-id="id38">
        </div>
        <div class="col-md-4">
            <label for="ano" class="form-label">Informe o ano</label>
            <input type="number" id="ano" name="ano" class="form-control" required="">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dia = $_POST["dia"];
    $mes = $_POST["mes"];
    $ano = $_POST["ano"];

    function formatarData($dia, $mes, $ano)
    {
        $verificador = checkdate($mes, $dia, $ano);
        if ($verificador)
            echo "<p>A data informada é válida: $dia/$mes/$ano</p>";
        else
            echo "<p>A data informada é inválida</p>";

    }

    formatarData($dia, $mes, $ano);
}

include "rodape.php";
?>