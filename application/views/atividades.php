<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel inicial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/calendar.css') ?>">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand">Painel de atividades</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav nav-underline">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('login') ?>">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <form class="row g-3 needs-validation" method="POST">
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Nome da atividade</label>
            <input type="text" class="form-control" id="validationCustom01" name="nome" required>
            <div class="valid-feedback">
            </div>
        </div>
        <div class="col-md-6">
            <label for="validationCustom03" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="validationCustom03" name="descricao" required>
        </div>
        <div class="col-md-3">
            <label for="validationCustom04" class="form-label">Status</label>
            <select class="form-select" id="validationCustom04" name="status" required>
                <option value="pendente">Pendente</option>
                <option value="concluida">Concluída</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>
        <div class="calendar-container">
            <div class="col-md-1">
                Data de início: <input type="text" id="data_inicio" name="data_inicio" required><br>
            </div>
            <div class="col-md-1">
                Data final: <input type="text" id="data_fim" name="data_fim" required><br>
            </div>
        </div>
        <div class="col-12">
            <br>
            <button type="submit" class="btn btn-primary">Adicionar Atividade</button>
        </div>
    </form>

    <br>
    <h2>Suas Atividades</h2>
    <br>

    <div id='calendar'></div>

    <!-- Modal -->
    <div class="modal fade" id="janela" tabindex="-1" aria-labelledby="janelaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="janelaLabel">Detalhes da Atividade</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nome:</strong> <span id="modalNome"></span></p>
                    <p><strong>Descrição:</strong> <span id="modalDescricao"></span></p>
                    <p><strong>Status:</strong> <span id="modalStatus"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="editarBtn">Editar</button>
                    <button type="button" class="btn btn-danger" id="deletarBtn">Deletar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="<?php echo base_url('assets/js/index.global.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets\js\bootstrap5\index.global.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/core/locales-all.global.min.js'); ?>"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                locale: 'pt-br',
                navLinks: true,
                selectable: true,
                selectMirror: true,
                editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: '<?php echo site_url('pagina/carregar'); ?>',
                eventClick: function(info) {
                    // Preenchendo as informações da atividade no modal
                    document.getElementById('modalNome').textContent = info.event.title;
                    document.getElementById('modalDescricao').textContent = info.event.extendedProps.description;
                    document.getElementById('modalStatus').textContent = info.event.extendedProps.status;

                    // Mostrando o modal
                    var modal = new bootstrap.Modal(document.getElementById('janela'));
                    modal.show();

                    // Adicionando funcionalidade aos botões de editar e deletar
                    document.getElementById('editarBtn').onclick = function() {
                        window.location.href = '<?php echo site_url('pagina/editar/'); ?>' + info.event.id;
                    };

                    document.getElementById('deletarBtn').onclick = function() {
                        window.location.href = '<?php echo site_url('pagina/deletar/'); ?>' + info.event.id;
                    };
                }
            });

            calendar.render();
        });
    </script>

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

</body>

</html>
s