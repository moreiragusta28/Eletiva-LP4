<?php include "cabecalho.php"; ?>

<div class="container py-3">
    <h1>Exercício 19 - Conversor de dias</h1>
    <form method="post">
        <div class="mb-3">
            <label for="d1" class="form-label">Dias</label>
            <input type="number" id="d1" name="d1" class="form-control" step="any" required="">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dias = $_POST["d1"];
        $segundos_totais = floor($dias * 24 * 60 * 60);

        $horas = floor($segundos_totais / 3600); // Calcula as horas, minutos e segundos a partir dos segundos totais
        $minutos = floor(($segundos_totais % 3600) / 60);
        $segundos = $segundos_totais % 60;

        $horas_formatadas = sprintf('%02d', $horas); // Formata os valores com zero à esquerda para ter 2 dígitos
        $minutos_formatados = sprintf('%02d', $minutos);
        $segundos_formatados = sprintf('%02d', $segundos);

        echo "<p>O valor de dias em hh:mm:ss é: {$horas_formatadas}:{$minutos_formatados}:{$segundos_formatados}</p>";
    }

    include "rodape.php";
    ?>