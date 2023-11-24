<div class="card mb-4 p-3">
    <div class="card-body">
        <div class="edital">
            
            <h2>Edital</h2>
            
            @if( isset($edital) )
                <h3 class="text-secondary">{{ $edital->titulo }}</h3>
                <p style="color: #999;">{{ $edital->resumo }}</p>
                <p class="text-success font-size-16"><strong>Valor Recurso:</strong> R$ {{ number_format($edital->total_recurso, 2, ',', '.') }}</p>
                <p class="text-primary font-size-16"><strong>Valor por inscrição:</strong> R$ {{ number_format($edital->valor_max_inscricao, 2, ',', '.') }}</p>
                <p class="text-muted fs-sm"><strong>Valor Total Solicitado até o momento:</strong> R$ {{ number_format($val_proj_solic, 2, ',', '.') }}</p>
                @if(isset($edital->valor_max_programa) && $edital->valor_max_programa != null)
                    <p class="text-primary font-size-16"><strong>Valor por programa:</strong> R$ {{ number_format($edital->valor_max_programa, 2, ',', '.') }}</p>
                    <p class="text-muted fs-sm"><strong>Valor Total Solicitado até o momento:</strong> R$ {{ number_format($val_prog_solic, 2, ',', '.') }}</p>
                @endif
                <a href="{{ url('storage/' . $edital->anexo_edital) }}" class="btn btn-primary btn-pills waves-effect waves-themed" target="_blank"><i class="far fa-file-pdf"></i> Abrir PDF</a>
                <a href='{{ url("editais/$edital->id/editar") }}' class="btn btn-outline-primary btn-pills waves-effect waves-themed"><i class="far fa-edit"></i> Editar</a>
                <a href='{{ url("/editais/$edital->id/criterios") }}' class="btn btn-outline-primary btn-pills waves-effect waves-themed"><i class="far fa-list"></i> Critérios</a>
            @else
                <a href="{{ url('editais/novo') }}" class="btn btn-success btn-pills waves-effect waves-themed">
                    <i class="far fa-plus"></i>
                    Adicionar Edital
                </a>
                
            @endif

        </div>
        <hr class="border-top border-bottom">
        <div class="cronograma">
            <h2>Cronograma</h2>
            
            @if( isset($edital) && !empty($cronogramas) )
                <div class="row mb-3">
                    @foreach($cronogramas as $cronograma)
                    <div class="col-md-2 m-2 border border-secondary bg-secondary-50 rounded  d-flex justify-content-start alig-items-center">
                        <div class="bg-{{ $bg_array[rand(0,4)]}}" style="width: 4px; height: 100%;"></div>
                        <div class="d-flex flex-column justify-content-center alig-items-center p-2">
                            <small class="text-secondary fs-xs fw-200">{{ $cronograma['dt_label'] }}: </small>
                            <span class="text-muted fs-xl fw-700">{{ date('d/m/Y', strtotime($cronograma['data'])) }}</span>
                        </div>
                    </div>
                       
                    @endforeach
                </div>
                <div class="d-flex justify-content-start align-items-center">
                    <a href='{{ url("editais/$edital->id/cronograma") }}' class="btn btn-primary btn-pills waves-effect waves-themed"><i class="far fa-edit"></i> Editar</a>
                    <form action="{{ url('cronograma/prorrogar') }}" method="post">
                        @csrf
                        <input type="hidden" name="edital_id" value="{{$edital->id}}">
                        <input type="hidden" name="dias" value="5">
                        <button type="submit" class="btn btn-outline-primary btn-pills waves-effect waves-themed ml-1"><i class="far fa-plus"></i> 5</i></button>
                    </form>
                    <form action="{{ url('cronograma/prorrogar') }}" method="post">
                        @csrf
                        <input type="hidden" name="edital_id" value="{{$edital->id}}">
                        <input type="hidden" name="dias" value="10">
                        <button type="submit" class="btn btn-outline-primary  btn-pills waves-effect waves-themed ml-1"><i class="far fa-plus"></i> 10</button>
                    </form>
                    <form action="{{ url('cronograma/prorrogar') }}" method="post">
                        @csrf
                        <input type="hidden" name="edital_id" value="{{$edital->id}}">
                        <input type="hidden" name="dias" value="15">
                        <button type="submit" class="btn btn-outline-primary  btn-pills waves-effect waves-themed ml-1"><i class="far fa-plus"></i> 15</button>
                    </form>
                </div>
            @else
                <a href='{{ url("editais/$edital->id/cronograma") }}' class="btn btn-success btn-pills waves-effect waves-themed">
                    <i class="far fa-plus"></i> 
                    Adicionar Cronograma
                </a>
               
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

                <a href='{{ url("editais/$edital->id/questoes") }}' class="btn btn-primary  btn-pills waves-effect waves-themed"><i class="far fa-edit"></i> Editar</a>
            @else
                <a href='{{ url("editais/$edital->id/questoes") }}' class="btn btn-success btn-pills waves-effect waves-themed">
                    <i class="far fa-plus"></i>
                    Adicionar Questões
                </a>
               
            @endif
        </div>
        <hr class="border-top border-bottom">
        <div class="conselheiros">
            <h2>Comissão</h2>
            
            @if( isset($edital->comissoes) && !empty($edital->comissoes->toArray()) )
                <div class="pl-2">
                    <ul style="color: #999;">
                        @foreach($edital->comissoes as $comissao)
                            <li>
                                <div class="d-flex flex-column">
                                    <span class="font-size-14 fw-500 ">{{ $comissao->nome }}</span>
                                    <spanv class="font-italic font-color-light">{{ $comissao->atribuicao }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <a href='{{ url("/comissoes") }}' class="btn btn-primary btn-pills waves-effect waves-themed">
                    <i class="far fa-edit"></i>
                    Editar
                </a>
            @else
                <a href='{{ url("/comissoes") }}' class="btn btn-success btn-pills waves-effect waves-themed">
                    <i class="far fa-plus"></i>
                    Adicionar Comissão
                </a>
                
            @endif
        </div>

        <form action="{{ url('edital/'. $edital->id .'/divulgar') }}" method="post" id="form-divulgar">
            @csrf
            <button type="button" class="btn btn-outline-primary btn-lg btn-pills waves-effect waves-themed float-right loading">
                <i class="far fa-paper-plane"></i>
                <div class="spinner-border spinner-border-sm d-none spin" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <span class="spin-text">Divulgar</span>
            </button>
        </form>
        
    </div>
</div>