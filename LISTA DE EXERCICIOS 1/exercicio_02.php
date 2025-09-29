<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercício 02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include "cabecalho.php"; ?>

    <div class="container py-3">
        <h1>Exercício 02</h1>
        <form method="post">
            <div class="mb-3">
                <label for="n1" class="form-label">Número 1</label>
                <input type="number" id="n1" name="n1" class="form-control" required="" wfd-id="id37">
            </div>
            <div class="mb-3">
                <label for="n2" class="form-label">Número 2</label>
                <input type="number" id="n2" name="n2" class="form-control" required="" wfd-id="id38">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $n1 = $_POST["n1"];
                $n2 = $_POST["n2"];
                $subtracao = $n1 - $n2;
                echo "<p>Resultado da subtração: $subtracao</p>";
            }
            ?>

        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </div>

</body>

</html>