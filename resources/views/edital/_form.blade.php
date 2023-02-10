<div class="card mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para criar um novo Edital</h6>
</div>
<div class="card-body">
    @if( isset($edital) )
        <form action='{{ url("/editais/$edital->id") }}' method="POST" enctype="multipart/form-data" id="form-edital">
            @method('PUT')
    @else
        <form action="{{ url('/editais') }}" method="POST" enctype="multipart/form-data" id="form-edital">
    @endif
        @csrf
        <label for="titulo" class="font-weight-bold">Titulo:</label>
        <input type="text" name="titulo" class="form-control mb-3" placeholder="Título" value ="{{ isset($edital->titulo) ? $edital->titulo : old('titulo') }}" required/>

        <label for="tipo" class="font-weight-bold">Tipo:</label>
        <select name="tipo" id="tipo" class="form-control mb-3" required>
        <option value="">Selecione ... </option>
            <option value="Acoes Afirmativas" {{ (isset($edital->tipo) && $edital->tipo == 'Acoes Afirmativas') || old('tipo') == 'Acoes Afirmativas' ? 'selected' : '' }}>Ações Afirmativas</option>
            <option value="Colégios" {{ (isset($edital->tipo) && $edital->tipo == 'Colégios') || old('tipo') == 'Colégios' ? 'selected' : '' }}>Colégios</option>
            <option value="Inovação e Empreendedorismo" {{ (isset($edital->tipo) && $edital->tipo == 'Inovação e Empreendedorismo') || old('tipo') == 'Inovação e Empreendedorismo' ? 'selected' : '' }}>Inovação e Empreendedorismo</option>
            <option value="PEX" {{ (isset($edital->tipo) && $edital->tipo == 'PEX') || old('tipo') == 'PEX' ? 'selected' : '' }}>PEX</option>
            <option value="Saberes Indígenas" {{ (isset($edital->tipo) && $edital->tipo == 'Saberes Indígenas') || old('tipo') == 'Saberes Indígenas' ? 'selected' : '' }}>Saberes Indígenas</option>
        </select>

        <label for="resumo" class="font-weight-bold">Resumo:</label>
        <textarea name="resumo" class="form-control mb-3" rows="6" required>{{ isset($edital->resumo) ? $edital->resumo : old('resumo') }}</textarea>

        <label for="total_recurso" class="font-weight-bold">Valor Total do Recurso:</label>
        <input type="text" name="total_recurso" id="total_recurso" class="form-control mb-3" placeholder="R$ 0" value ="{{ isset($edital->total_recurso) ? number_format($edital->total_recurso, 2, ',', '') : old('total_recurso') }}" required />

        <label for="valor_max_inscricao" class="font-weight-bold">Valor Máximo por Inscrição:</label>
        <input type="text" name="valor_max_inscricao" id="valor_max_inscricao" class="form-control mb-3" placeholder="R$ 0" value ="{{ isset($edital->valor_max_inscricao) ? number_format($edital->valor_max_inscricao, 2, ',', '') : old('valor_max_inscricao') }}" required />

        <div class="{{ isset($edital->valor_max_programa) ? 'd-block' : 'd-none' }}" id="div_valor_programa">
            <label for="valor_max_programa" class="font-weight-bold">Valor Máximo por Programa:</label>
            <input type="text" name="valor_max_programa" id="valor_max_programa" class="form-control mb-3" placeholder="R$ 0" value ="{{ isset($edital->valor_max_programa) ? number_format($edital->valor_max_programa, 2, ',', '') : old('valor_max_programa') }}" />
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label font-weight-bold text-success">Upload do Edital em pdf</label>
                    <div class="preview-zone hidden">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                        <div></div>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-secondary btn-xs remove-preview">
                            Limpar
                            </button>
                        </div>
                        </div>
                        <div class="box-body" id="edital-box-body">
                            @if( isset($edital) )
                                <a href='{{ url("storage/$edital->anexo_edital") }}' target="_blank">
                                    <img src='{{ url("smartadmin-4.5.1/img/pdf-icon.png") }}' alt="{{ $edital->titulo}}" class="img-thumbnail mb-2" style="max-width: 75px;" />
                                </a>
                            @endif

                            @if($errors->any())
                                <span class="font-weight-bold text-danger" style="font-size: 16px">Favor Inclua o arquivo novamente.</span>
                            @endif
                        </div>
                    </div>
                    </div>
                    <div class="dropzone-wrapper">
                        <div class="dropzone-desc">
                            <i class="glyphicon glyphicon-download-alt"></i>
                            <p class="font-weight-bold">Arraste o arquivo aqui ou clique para selecionar.</p>
                        </div>
                        <input type="file" name="anexo_edital" class="dropzone" id="edital_arquivo" value="{{ old('anexo_edital') }}" @if( !isset($edital) ) required @endif>
                        
                    </div>
                    <div id="alert-pdf-format"></div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label font-weight-bold text-success">Upload da Imagem do Edital</label>
                    <div class="preview-zone hidden">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                        <div></div>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-secondary btn-xs remove-preview">
                            Limpar
                            </button>
                        </div>
                        </div>
                        <div class="box-body" id="imagem-box-body">
                            @if( isset($edital) && !!$edital->anexo_imagem )
                                <img src='{{ url("storage/$edital->anexo_imagem") }}' alt="{{ $edital->titulo}}" class="w-25 img-thumbnail mb-2" />
                            @endif
                        </div>
                    </div>
                    </div>
                    <div class="dropzone-wrapper">
                        <div class="dropzone-desc">
                            <i class="glyphicon glyphicon-download-alt"></i>
                            <p class="font-weight-bold">Arraste o arquivo aqui ou clique para selecionar.</p>
                        </div>
                        <input type="file" name="anexo_imagem" class="dropzone" id="edital_imagem" value="{{ old('anexo_imagem') }}">
                        
                    </div>
                    <div id="alert-pdf-format"></div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="#" onclick="history.back()" class="btn btn-secondary btn-user ">
                <span class="icon text-white-50">
                    <i class="fal fa-long-arrow-left"></i>
                </span>
                <span class="text">Voltar</span>
            </a>
            <button type="submit" class="btn btn-primary btn-user btn-verde font-weight-bold loading">
                <div class="spinner-border spinner-border-sm d-none spin" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <span class="spin-text">
                    {{ isset($edital) ? 'Atualizar' : 'Salvar' }}
                </span>
            </button>
        </div>
        </form>
</div>
</div>