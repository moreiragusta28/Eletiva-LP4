<?php
include("cabecalho.php");
?>

<h1>Exercício 2 - Média de alunos</h1>
<form method="post">
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <p>Dados do Aluno <?= $i ?></p>
        <div class="row inline-row mb-3">
            <div class="col-md-12">
                <label for="nome[]" class="form-label">Nome</label>
                <input type="text" id="nome[]" name="nome[]" class="form-control" required="">
            </div>
        </div>
        <div class="row inline-row mb-3">
            <div class="col-md-4">
                <label for="nota1[]" class="form-label">Nota 1</label>
                <input type="number" id="nota1[]" name="nota1[]" class="form-control" step="0.1" required="">
            </div>
            <div class="col-md-4">
                <label for="nota2[]" class="form-label">Nota 2</label>
                <input type="number" id="nota2[]" name="nota2[]" class="form-control" step="0.1" required="">
            </div>
            <div class="col-md-4">
                <label for="nota[]" class="form-label">Nota 3</label>
                <input type="number" id="nota3[]" name="nota3[]" class="form-control" step="0.1" required="">
            </div>
        </div>
    <?php endfor; ?>
    <button type="submit" class="btn btn-primary mt-3">Enviar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomes = $_POST['nome'];
    $notas1 = $_POST['nota1'];
    $notas2 = $_POST['nota2'];
    $notas3 = $_POST['nota3'];

    $alunos = [];

    for ($i = 0; $i < 5; $i++) {
        $nome = $nomes[$i];
        $media = ($notas1[$i] + $notas2[$i] + $notas3[$i]) / 3;

        $alunos[$nome] = $media;
    }

    arsort($alunos); // ordena o mapa pelos valores da maior para a menor

    echo "<hr><h3>Lista de Alunos e Médias</h3>";
    foreach ($alunos as $nome => $media) {
        echo "$nome: Média ".number_format($media, 2, ',', '.')."</p>";
    }
}

include("rodape.php");
?>