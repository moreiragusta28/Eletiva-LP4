<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 14 - Conversor de quilômetros para milhas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "cabecalho.php"; ?>

    <div class="container py-3">
        <h1>Exercício 14 - Conversor de quilômetros para milhas</h1>
        <form method="post">
            <div class="mb-3">
                <label for="q1" class="form-label">Quilômetros</label>
                <input type="number" id="q1" name="q1" class="form-control" step = "any" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
            
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $q1 = $_POST["q1"];
                $conversao = $q1 / 1.6093;
                echo "<p>O valor da conversão de quilômetros para milhas é: ".number_format($conversao, 2)."</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
            }
            ?>
           
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>