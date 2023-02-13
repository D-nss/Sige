<table class="table table-bordered table-hover" id="dt-eventos-encerrados" style="width: 100%">
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
        @foreach($eventosEncerrados as $evento)
            
            <tr>
                <td>
                    <div class="flex-1">
                        <span class="fw-200 text-muted">Data Início</span>
                        <br>
                        <span class="h4 text-secondary">{{ date('D. M, j, y H:i', strtotime($evento->data_inicio)) }}</span>
                    </div>
                    <div class="flex-1">
                        <span class="fw-200 text-muted">Data Fim</span>
                        <br>
                        <span class="h4 text-secondary">{{ date('D. M, j, y H:i', strtotime($evento->data_fim)) }}</span>
                    </div>
                </td>
                <td>
                    <small class="font-italic h4">{{ $evento->local }}</span>
                </td>
                <td><h4 class="fw-500 text-primary">{{ $evento->titulo }}</h4></td>
                <td><h6 class="text-secondary">{{ $evento->user->name}}</h6></td>
                <td>
                <div class="d-flex flex-column">
                        <a href="" class="btn btn-primary btn-xs mb-1">
                            Ver Detalhes
                        </a>
                        <a href="{{ url('evento/'. $evento->id .'/inscritos')}}" class="btn btn-success btn-xs mb-1">
                            Inscrições
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>