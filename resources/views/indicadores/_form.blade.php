<ul class="nav nav-tabs step-anchor">
    <li class="nav-item done"><a href="#step-ano" class="nav-link">Ano Base</a></li>            
@foreach($indicadoresSerializado as $k => $indicadores)
    <li class="nav-item done"><a href="#step-{{ str_replace(".", "-", substr($k, 0, 4)) }}" class="nav-link">Item {{ substr($k, 0, 4) }}</a></li>
@endforeach
</ul>

<div class="p-3 sw-container tab-content">
    <div id="step-ano" class="tab-pane step-content" style="display:block;">
    <h3 style="color:#666">Ano Base</h3>
    <div class="mt-5">
            <div class="mb-3 form-group">
                <label for="" class="form-label" style="color: #333">Indique o ano base <i class="far fa-comment-circle" data-toggle="tooltip" data-placement="right" title="Ano em que se refere os indicadores"></i></label>
                <div class="row">
                    <div class="col-sm-3">
                        <select class="form-control" name="ano_base" placeholder="Selecione ..." required="required" pattern="[0-9]+$" >
                            @foreach($anos_base as $ano)
                                <option value="{{ $ano->ano_base }}" @if( old('ano_base') == $ano->ano_base) selected @endif>{{ $ano->ano_base }}</option>
                            @endforeach
                        </select>
                        @error( 'ano_base' )
                            <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
                        @enderror 
                    </div>
                </div>
            </div>
    </div>
    
    </div>
    @foreach($indicadoresSerializado as $k => $indicadores)
    <div id="step-{{ str_replace(".", "-", substr($k, 0, 4)) }}" class="tab-pane step-content" style="display:none;">
    <h3 style="color:#666">{{ $k }}</h3>
    <div class="mt-5">
        @foreach($indicadores as $j => $indicador)
            <div class="mb-3 form-group">
                <label for="" class="form-label" style="color: #333">{{ $indicador['indicador'] }} <i class="fal fa-comment-exclamation" data-toggle="tooltip" data-placement="right" title="{{ $indicador['descricao_indicador'] }}"></i></label>
                <div class="row">
                    <div class="col-sm-3">
                        <input type="number" class="form-control" name="indicador{{ $indicador['id'] }}" value="{{ isset($indicador['valor']) ? $indicador['valor'] : 0 }}" placeholder="Valor do Indicador" required="required" pattern="[0-9]+$">  
                        @error( 'indicador' .  $indicador['id'] )
                            <span class="text-danger font-weight-bold mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>       
            </div>
        @endforeach
    </div>
    
    </div>
    @endforeach
</div>  