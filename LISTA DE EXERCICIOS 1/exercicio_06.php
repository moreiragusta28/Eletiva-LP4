    <?php include "cabecalho.php"; ?>


    <div class="container py-3">
        <h1>Exercício 06 - Celsius</h1>
        <form method="post">
            <div class="mb-3">
                <label for="c1" class="form-label">Temperatura em Celsius</label>
                <input type="number" id="c1" name="c1" class="form-control" required="" wfd-id="id22">
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $c1 = $_POST["c1"];
            $conversao = ($c1 * 1.8) + 32;
            echo "<p>A temperatura em Fahrenheit é de: " . number_format($conversao, 2) . "</p>"; //usando o .number_format(). para deixar com dois digitos depois da virgula
        }


        include "rodape.php";
        ?>