<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 19 - Conversor de dias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "cabecalho.php"; ?>

    <div class="container py-3">
        <h1>Exercício 19 - Conversor de dias</h1>
        <form method="post">
            <div class="mb-3">
                <label for="d1" class="form-label">Dias</label>
                <input type="number" id="d1" name="d1" class="form-control" step="any" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>

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
            ?>

            
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>