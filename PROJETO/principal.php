<?php
    require("cabecalho.php");
?>

<h1 class="mb-3">Sistema de Controle de Ponto</h1>
<p class="lead">
    Seja bem-vinda(o),
    <?= htmlspecialchars($_SESSION['nome'], ENT_QUOTES, 'UTF-8') ?>!
</p>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Cargos</h5>
                <p class="card-text">Cadastre e gerencie os cargos dos funcionários.</p>
                <a href="cargos.php" class="btn btn-primary mt-auto btn-sm">Acessar</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Turnos de Trabalho</h5>
                <p class="card-text">Defina períodos e horários de trabalho.</p>
                <a href="turnos.php" class="btn btn-primary mt-auto btn-sm">Acessar</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Funcionários</h5>
                <p class="card-text">Gerencie o cadastro dos funcionários e seus vínculos.</p>
                <a href="funcionarios.php" class="btn btn-primary mt-auto btn-sm">Acessar</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Registro de Ponto</h5>
                <p class="card-text">Registre e consulte as batidas de ponto dos funcionários.</p>
                <a href="pontos.php" class="btn btn-primary mt-auto btn-sm">Acessar</a>
            </div>
        </div>
    </div>
</div>

<p class="mt-4">
    <a href="logout.php">Sair do sistema</a>
</p>

<?php
    require("rodape.php");
?>
