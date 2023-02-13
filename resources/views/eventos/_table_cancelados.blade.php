<table class="table table-bordered table-hover" id="dt-eventos-cancelados" style="width: 100%">
    <thead>
        <tr>
            <th>Período</th>
            <th>Local</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eventosCancelados as $evento)
            
            <tr>
                <td>
                    <div class="flex-1">
                        <small class="fw-500 text-muted">Data Início</small>
                        <br>
                        <span class="h4">{{ date('D. M, j H:i:s', strtotime($evento->data_inicio)) }}</span>
                    </div>
                    <div class="flex-1">
                        <small class="fw-500 text-muted">Data Fim</small>
                        <br>
                        <span class="h4">{{ date('D. M, j H:i:s', strtotime($evento->data_fim)) }}</span>
                    </div>
                    <small class="font-italic font-color-light">{{ $evento->local }}</span>
                </td>
                <td>
                    <small class="font-italic h4">{{ $evento->local }}</span>
                </td>
                <td><h3 class="fw-700 text-primary">{{ $evento->titulo }}</h3></td>
                <td><h6 class="text-secondary">{{ $evento->user->name}}</h6></td>
                <td>
                    <div class="d-flex flex-column">
                        <a href="{{ url('/eventos/' . $evento->id) }}" class="btn btn-primary btn-xs mb-1">
                            Ver Detalhes
                        </a>
                        <a href="{{ url('/eventos/' . $evento->id . '/editar') }}" class="btn btn-info btn-xs mb-1">
                            Editar
                        </a>
                        <a href="{{ url('evento/'. $evento->id .'/inscritos')}}" class="btn btn-success btn-xs mb-1">
                            Inscrições
                        </a>
                        <!-- <a href="" class="btn btn-warning btn-xs">
                            Enviar E-Mail
                        </a> -->
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>