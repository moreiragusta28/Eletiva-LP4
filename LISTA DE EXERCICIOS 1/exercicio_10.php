<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 10 - Perímetro de retângulo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "cabecalho.php"; ?>    

    <div class="container py-3">
        <h1>Exercício 10 - Perímetro de retângulo</h1>
        <form method="post">
            <div class="mb-3">
                <label for="a1" class="form-label">Altura - a</label>
                <input type="number" id="a1" name="a1" class="form-control" required="" wfd-id="id22">
            </div>
            <div class="mb-3">
                <label for="l1" class="form-label">Largura - l</label>
                <input type="number" id="l1" name="l1" class="form-control" required="">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $a1 = $_POST["a1"];
                $l1 = $_POST["l1"];
                $perimetro = ($a1 * 2) + ($l1 *2);
                echo "<p>O perímetro do retângulo é de: ".number_format($perimetro, 2)."</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
            }
            ?>

        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>
</body>

</html>