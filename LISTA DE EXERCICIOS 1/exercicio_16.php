<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 16 - Desconto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "cabecalho.php"; ?>


    <div class="container py-3">
        <h1>Exercício 16 - Desconto</h1>
        <form method="post">
            <div class="mb-3">
                <label for="p1" class="form-label">Preço</label>
                <input type="number" id="p1" name="p1" class="form-control" step = "any" required="" wfd-id="id22">
            </div>
            <div class="mb-3">
                <label for="d1" class="form-label">Percentual de desconto</label>
                <input type="number" id="d1" name="d1" class="form-control" step = "any" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $p1 = $_POST["p1"];
                $d1 = $_POST["d1"];
                $calculo = ($p1 - ($p1 * $d1 / 100));
                echo "<p>O valor do preço com o desconto é: R$ ".number_format($calculo, 2)."</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
            }
            ?>

        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>