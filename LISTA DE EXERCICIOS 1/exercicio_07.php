<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 07 - Fahrenheit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "cabecalho.php"; ?>


    <div class="container py-3">
        <h1>Exercício 07 - Fahrenheit</h1>
        <form method="post">
            <div class="mb-3">
                <label for="f1" class="form-label">Temperatura em Fahrenheit</label>
                <input type="number" id="f1" name="f1" class="form-control" required="" wfd-id="id22">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $f1 = $_POST["f1"];
                $conversao = ($f1 - 32) * 5 / 9;
                echo "<p>A temperatura em Celsius é de: ".number_format($conversao, 2)."</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
            }
            ?>            

        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>