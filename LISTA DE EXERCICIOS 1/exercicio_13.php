<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 13 - Conversor de metros para centímetros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "cabecalho.php"; ?>

    <div class="container py-3">
        <h1>Exercício 13 - Conversor de metros para centímetros</h1>
        <form method="post">
            <div class="mb-3">
                <label for="m1" class="form-label">Metros</label>
                <input type="number" id="m1" name="m1" class="form-control" step = "any" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
            
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $m1 = $_POST["m1"];
                $conversao = $m1 * 100;
                echo "<p>O valor da conversão de metros para centímetros é: ".number_format($conversao, 2)."</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
            }
            ?>
           
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>