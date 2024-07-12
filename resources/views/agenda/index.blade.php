<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@extends('moonshine::layouts.app')

@section('content')
<div class="container">
    <h2>Agenda de citas</h2>
    <div class="row">
        <div class="col-md-4">
            <div id="small-calendar" class="mb-4"></div>
            <div id="citas-del-dia">
                <h4>Citas del Día</h4>
                <ul id="citas-lista" class="list-group">
                    <li class="list-group-item">Sin citas pendientes</li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div id="calendar" class="calendar"></div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function() {
        $('#small-calendar').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true
        }).on('changeDate', function(e) {
            mostrarCitasDelDia(e.format(0, 'yyyy-mm-dd'));
        });

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            events: [
                @foreach($citas as $cita)
                {
                    title: '{{ $cita->paciente->nombre }} - {{ $cita->hora }}',
                    start: '{{ $cita->fecha }}T{{ $cita->hora }}',
                    description: '{{ $cita->motivo }}'
                },
                @endforeach
            ],
            dayClick: function(date, jsEvent, view) {
                window.location.href = '{{ route("citas.create") }}?fecha=' + date.format('YYYY-MM-DD');
            },
            eventRender: function(event, element) {
                element.find('.fc-title').append("<br/><span class='fc-description'>" + event.description + "</span>");
            }
        });

        function mostrarCitasDelDia(fecha) {
            var citas = @json($citas);
            var citasDelDia = citas.filter(function(cita) {
                return cita.fecha === fecha;
            });

            var citasLista = $('#citas-lista');
            citasLista.empty();

            if (citasDelDia.length === 0) {
                citasLista.append('<li class="list-group-item">Sin citas pendientes</li>');
            } else {
                citasDelDia.forEach(function(cita) {
                    citasLista.append('<li class="list-group-item">' + cita.paciente.nombre + ' - ' + cita.hora + '</li>');
                });
            }
        }
    });
</script>
@endsection
