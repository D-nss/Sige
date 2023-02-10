<table class="table table-bordered table-hover" id="dt-eventos-encerrados" style="width: 100%">
    <thead>
        <tr>
            <th>Período</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($eventosEncerrados as $evento)
            
            <tr>
                <td>
                    <h4 class="fw-400 text-secondary">
                        {{ date('d/m/Y H:i:s', strtotime($evento->data_inicio)) }}
                         
                        à 
                        {{ date('d/m/Y H:i:s', strtotime($evento->data_fim)) }}
                        <small class="font-italic font-color-light">{{ $evento->local }}</span>
                    </h4>
                </td>
                <td><h3 class="fw-700 text-primary">{{ $evento->titulo }}</h3></td>
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