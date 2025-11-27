<?php
    require("cabecalho.php");
    require("conexao.php");

    // períodos fixos para manter ordem e garantir que todos aparecem no gráfico
    $periodos = ['Manha', 'Tarde', 'Noite', 'Madrugada', 'Flexivel'];

    // inicializa arrays com zero
    $qtdePorPeriodo       = array_fill_keys($periodos, 0);
    $mediaSalPorPeriodo   = array_fill_keys($periodos, 0);

    try {
        // Quantidade de funcionários por período
        $stmt = $pdo->query("
            SELECT t.periodo, COUNT(f.funcionario_id) AS total
            FROM turno t
            LEFT JOIN funcionario f ON f.turno_id = t.turno_id
            GROUP BY t.periodo
        ");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $r) {
            $p = $r['periodo'];
            if (isset($qtdePorPeriodo[$p])) {
                $qtdePorPeriodo[$p] = (int) $r['total'];
            }
        }

        // Média salarial por período
        $stmt = $pdo->query("
            SELECT t.periodo, AVG(f.salario) AS media
            FROM funcionario f
            INNER JOIN turno t ON t.turno_id = f.turno_id
            GROUP BY t.periodo
        ");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $r) {
            $p = $r['periodo'];
            if (isset($mediaSalPorPeriodo[$p]) && $r['media'] !== null) {
                $mediaSalPorPeriodo[$p] = (float) $r['media'];
            }
        }
    } catch (Exception $e) {
        // se quiser, pode exibir um alert simples aqui
        // echo "<p class='text-danger'>Erro ao carregar dados dos gráficos: " . $e->getMessage() . "</p>";
    }

    // rótulos bonitos para exibir no gráfico
    $labelsLegiveis = [
        'Manha'      => 'Manhã',
        'Tarde'      => 'Tarde',
        'Noite'      => 'Noite',
        'Madrugada'  => 'Madrugada',
        'Flexivel'   => 'Flexível'
    ];
    $labels = [];
    foreach ($periodos as $p) {
        $labels[] = $labelsLegiveis[$p];
    }
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

<!-- Gráficos -->
<div class="row mt-4">
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Funcionários por período</h5>
                <p class="card-text">Distribuição da quantidade de funcionários em cada período de trabalho.</p>
                <canvas id="graficoQtdeFuncionarios"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">Média salarial por período</h5>
                <p class="card-text">Média de salário dos funcionários em cada período de trabalho.</p>
                <canvas id="graficoMediaSalarial"></canvas>
            </div>
        </div>
    </div>
</div>

<p class="mt-4">
    <a href="logout.php">Sair do sistema</a>
</p>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = <?= json_encode($labels); ?>;
    const dadosQtde = <?= json_encode(array_values($qtdePorPeriodo)); ?>;
    const dadosMedia = <?= json_encode(array_values($mediaSalPorPeriodo)); ?>;

    // Gráfico 1 - Quantidade de funcionários por período
    const ctx1 = document.getElementById('graficoQtdeFuncionarios').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Quantidade de funcionários',
                data: dadosQtde,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Gráfico 2 - Média salarial por período
    const ctx2 = document.getElementById('graficoMediaSalarial').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Média salarial (R$)',
                data: dadosMedia,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let valor = context.parsed.y || 0;
                            return 'R$ ' + valor.toFixed(2).replace('.', ',');
                        }
                    }
                }
            }
        }
    });
</script>

<?php
    require("rodape.php");
?>
