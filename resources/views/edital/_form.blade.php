<div class="card mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para criar um novo Edital</h6>
</div>
<div class="card-body">
    @if( isset($edital) )
        <form action='{{ url("/editais/$edital->id") }}' method="POST" enctype="multipart/form-data">
            @method('PUT')
    @else
        <form action="{{ url('/editais') }}" method="POST" enctype="multipart/form-data">
    @endif
        @csrf
        <label for="titulo" class="font-weight-bold">Titulo:</label>
        <input type="text" name="titulo" class="form-control mb-3" placeholder="Título" value ="{{ isset($edital->titulo) ? $edital->titulo : old('titulo') }}" required/>

        <label for="tipo" class="font-weight-bold">Tipo:</label>
        <select name="tipo" class="form-control mb-3" required>
            <option value="">Selecione ... </option>
            <option value="EAD" {{ (isset($edital->tipo) && $edital->tipo == 'EAD') || old('tipo') == 'EAD' ? 'selected' : '' }}>EAD</option>
            <option value="PEX" {{ (isset($edital->tipo) && $edital->tipo == 'PEX') || old('tipo') == 'PEX' ? 'selected' : '' }}>PEX</option>
            <option value="PRP" {{ (isset($edital->tipo) && $edital->tipo == 'PRP') || old('tipo') == 'PRP' ? 'selected' : '' }}>PRP</option>
            <option value="PRG" {{ (isset($edital->tipo) && $edital->tipo == 'PRG') || old('tipo') == 'PRG' ? 'selected' : '' }}>PRG</option>
        </select>

        <label for="resumo" class="font-weight-bold">Resumo:</label>
        <textarea name="resumo" class="form-control mb-3" rows="6" required>{{ isset($edital->resumo) ? $edital->resumo : old('resumo') }}</textarea>

        <label for="total_recurso" class="font-weight-bold">Valor Total do Recurso:</label>
        <input type="text" name="total_recurso" class="form-control mb-3" placeholder="R$ 0" value ="{{ isset($edital->total_recurso) ? $edital->total_recurso : old('total_recurso') }}" required />

        <label for="valor_max_inscricao" class="font-weight-bold">Valor Máximo por Inscrição:</label>
        <input type="text" name="valor_max_inscricao" class="form-control mb-3" placeholder="R$ 0" value ="{{ isset($edital->valor_max_inscricao) ? $edital->valor_max_inscricao : old('valor_max_inscricao') }}" required />

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
                        </div>
                    </div>
                    </div>
                    <div class="dropzone-wrapper">
                        <div class="dropzone-desc">
                            <i class="glyphicon glyphicon-download-alt"></i>
                            <p class="font-weight-bold">Arraste o arquivo aqui ou clique para selecionar.</p>
                        </div>
                        <input type="file" name="anexo_edital" class="dropzone" id="edital_arquivo" value="{{ old('anexo_edital') }}" required>
                        
                    </div>
                    <div id="alert-pdf-format"></div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label font-weight-bold text-success">Upload da Imgem do Edital</label>
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
            <button type="submit" class="btn btn-primary btn-user btn-verde font-weight-bold">
                {{ isset($edital) ? 'Atualizar' : 'Salvar' }}
            </button>
        </div>
        </form>
</div>
</div>