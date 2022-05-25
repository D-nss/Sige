<div class="card mb-4 p-3">
    <div class="card-body">
        <div class="edital">
            
            <h2>Edital</h2>
            
            @if( isset($edital) )
                <h3 class="text-secondary">{{ $edital->titulo }}</h3>
                <p style="color: #999;">{{ $edital->resumo }}</p>
                <p class="text-success font-size-16"><strong>Valor Recurso:</strong> R$ {{ number_format($edital->total_recurso, 2, ',', '.') }}</p>
                <p class="text-primary font-size-16"><strong>Valor por proposta:</strong> R$ {{ number_format($edital->valor_max_inscricao, 2, ',', '.') }}</p>
                @if(isset($edital->valor_max_programa) && $edital->valor_max_programa != null)
                    <p class="text-primary font-size-16"><strong>Valor por proposta:</strong> R$ {{ number_format($edital->valor_max_programa, 2, ',', '.') }}</p>
                @endif
                <a href="{{ url('storage/' . $edital->anexo_edital) }}" class="btn btn-danger btn-lg btn-icon rounded-circle" target="_blank"><i class="far fa-file-pdf"></i></a>
                <a href='{{ url("editais/$edital->id/editar") }}' class="btn btn-info btn-lg btn-icon rounded-circle"><i class="far fa-edit"></i></a>
                <a href='{{ url("/editais/$edital->id/criterios") }}' class="btn btn-primary rounded">Critérios <i class="far fa-list"></i></a>
            @else
                <a href="{{ url('editais/novo') }}" class="btn btn-success btn-lg btn-icon rounded-circle">
                    <i class="far fa-plus"></i>
                </a>
                Adicionar Edital
            @endif

        </div>
        <hr class="border-top border-bottom">
        <div class="cronograma">
            <h2>Cronograma</h2>
            
            @if( isset($edital) && !empty($edital->cronogramas->toArray()) )
                <ul>
                    @foreach($edital->cronogramas as $cronograma)
                    <li><strong class="text-secondary">{{ $cronograma->dt_input }}: </strong><span style="color: #999;">{{ date('d/m/Y', strtotime($cronograma->data)) }}</span></li>
                    @endforeach
                </ul>
                <div class="d-flex justify-content-start align-items-center">
                    <a href='{{ url("editais/$edital->id/cronograma") }}' class="btn btn-info btn-lg btn-icon rounded-circle"><i class="far fa-edit"></i></a>
                    <form action="{{ url('cronograma/prorrogar') }}" method="post">
                        @csrf
                        <input type="hidden" name="edital_id" value="{{$edital->id}}">
                        <input type="hidden" name="dias" value="5">
                        <button type="submit" class="btn btn-primary btn-lg btn-icon rounded-circle ml-1"><i class="far fa-plus"></i> 5</i></button>
                    </form>
                    <form action="{{ url('cronograma/prorrogar') }}" method="post">
                        @csrf
                        <input type="hidden" name="edital_id" value="{{$edital->id}}">
                        <input type="hidden" name="dias" value="10">
                        <button type="submit" class="btn btn-primary btn-lg btn-icon rounded-circle ml-1"><i class="far fa-plus"></i> 10</button>
                    </form>
                    <form action="{{ url('cronograma/prorrogar') }}" method="post">
                        @csrf
                        <input type="hidden" name="edital_id" value="{{$edital->id}}">
                        <input type="hidden" name="dias" value="15">
                        <button type="submit" class="btn btn-primary btn-lg btn-icon rounded-circle ml-1"><i class="far fa-plus"></i> 15</button>
                    </form>
                </div>
            @else
                <a href='{{ url("editais/$edital->id/cronograma") }}' class="btn btn-success btn-lg btn-icon rounded-circle">
                    <i class="far fa-plus"></i>
                </a>
                Adicionar Cronograma
            @endif
        </div>
        <hr class="border-top border-bottom">
        <div class="questoes-avaliativas" >
            <h2>Questões</h2>
            
            @if( isset($edital) && !empty($edital->questoes->toArray()) )
                <ul style="color: #999;">
                    <h4>Questões Complementares</h4>
                    @foreach($edital->questoes as $questao)
                        @if($questao->tipo == 'Complementar')
                            <li>{{ $questao->enunciado }}</li>
                        @endif
                    @endforeach
                </ul>

                <ul style="color: #999;">
                    <h4>Questões de Avaliação</h4>
                    @foreach($edital->questoes as $questao)
                        @if($questao->tipo == 'Avaliativa')
                            <li>{{ $questao->enunciado }}</li>
                        @endif
                    @endforeach
                </ul>

                <a href='{{ url("editais/$edital->id/questoes") }}' class="btn btn-info btn-lg btn-icon rounded-circle"><i class="far fa-edit"></i></a>
            @else
                <a href='{{ url("editais/$edital->id/questoes") }}' class="btn btn-success btn-lg btn-icon rounded-circle">
                    <i class="far fa-plus"></i>
                </a>
                Adicionar Questões
            @endif
        </div>
        <hr class="border-top border-bottom">
        <div class="conselheiros">
            <h2>Avaliadores</h2>
            
            @if( isset($avaliadores) && !empty($avaliadores->toArray()) )
                <div class="pl-2">
                    <ul style="color: #999;">
                        @foreach($avaliadores as $avaliador)
                            <li>{{ $avaliador->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <a href='{{ url("editais/$edital->id/avaliadores") }}' class="btn btn-info btn-lg btn-icon rounded-circle">
                    <i class="far fa-edit"></i>
                </a>
            @else
                <a href='{{ url("editais/$edital->id/avaliadores") }}' class="btn btn-success btn-lg btn-icon rounded-circle">
                    <i class="far fa-plus"></i>
                </a>
                Adicionar Avaliadores
            @endif
        </div>

        <form action="{{ url('edital/'. $edital->id .'/divulgar') }}" method="post" id="form-divulgar">
            @csrf
            <button type="button" class="btn btn-success float-right loading">
                <div class="spinner-border spinner-border-sm d-none spin" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <span class="spin-text">Divulgar</span>
            </button>
        </form>
        
    </div>
</div>