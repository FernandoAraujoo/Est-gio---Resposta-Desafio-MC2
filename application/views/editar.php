<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando a atividade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/calendar.css') ?>">
</head>

<body>
    <h1>Editando a atividade</h1>
    <hr>

    <form class="row g-3 needs-validation" method="POST" id="finalizou" action="<?php echo site_url('pagina/atualizar/' . $id); ?>">
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Nome da atividade</label>
            <input type="text" class="form-control" id="validationCustom01" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
            <div class="valid-feedback">
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationCustom03" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="validationCustom03" name="descricao" value="<?php echo htmlspecialchars($descricao); ?>" required>
        </div>
        <div class="col-md-3">
            <label for="validationCustom04" class="form-label">Status</label>
            <select class="form-select" id="validationCustom04" name="status" required>
                <option value="pendente" <?php echo ($status == 'pendente') ? 'selected' : ''; ?>>Pendente</option>
                <option value="concluida" <?php echo ($status == 'concluida') ? 'selected' : ''; ?>>Concluída</option>
                <option value="cancelada" <?php echo ($status == 'cancelada') ? 'selected' : ''; ?>>Cancelada</option>
            </select>
        </div>
        <div class="calendar-container">
            <div class="col-md-1">
                Data de início: <input type="text" id="data_inicio" name="data_inicio" value="<?php echo htmlspecialchars($data_inicio); ?>" required><br>
            </div>
            <div class="col-md-1">
                Data final: <input type="text" id="data_fim" name="data_fim" value="<?php echo htmlspecialchars($data_fim); ?>" required><br>
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Atualizar atividade</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

    <script>
        $(function() {
            $('#data_inicio').datetimepicker({
                format: 'Y-m-d H:i',
                step: 5
            });
            $('#data_fim').datetimepicker({
                format: 'Y-m-d H:i',
                step: 5
            });
        });
    </script>

    <script>
        var botao = document.getElementById('finalizou');
        botao.addEventListener('submit', function() {
            window.alert('Atividade alterada com sucesso.');
        });
    </script>
</body>

</html>
