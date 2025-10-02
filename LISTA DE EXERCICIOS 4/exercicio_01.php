<?php
include("cabecalho.php");
?>

<h1>Exercício 1 - Cadastro nome e telefone</h1>
<form method="post">
    <?php for ($i = 1; $i <= 5; $i++): ?>
        <p>Contato <?= $i ?></p>
        <div class="row inline-row mb-3">
            <div class="col-md-6">
                <label for="nome[]" class="form-label">Nome</label>
                <input type="text" id="nome[]" name="nome[]" class="form-control" required="" wfd-id="id22">
            </div>
            <div class="col-md-6">
                <label for="telefone[]" class="form-label">Telefone</label>
                <input type="number" id="telefone[]" name="telefone[]" class="form-control" required="">
            </div>
        </div>
    <?php endfor; ?>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomes = $_POST['nome'];
    $telefones = $_POST['telefone'];

    $contatos = []; //guardar os válidos

    for ($i = 0; $i < 5; $i++) {
        $nome = $nomes[$i];
        $telefone = $telefones[$i];

        if (array_key_exists($nome, $contatos)) { // verifica se o nome já foi usado, melhor que strpos()
            echo "Nome duplicado: $nome - Cadastro ignorado</p>";
        } else if (in_array($telefone, $contatos)) { // mesma coisa, mas pra inteiros
            echo "Telefone duplicado: $telefone - Cadastro ignorado</p>";
        } else {
            $contatos[$nome] = $telefone; //adiciona se estiver ok
        }
    }

    ksort($contatos);     // ordena o mapa pelos nomes

    foreach ($contatos as $nome => $telefone) {
        echo "<p>$nome | $telefone</p>";
    }
}

include("rodape.php");
?>