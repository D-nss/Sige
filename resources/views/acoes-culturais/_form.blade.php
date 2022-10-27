        <div class="row g-3">
            <div class="form-group col-md-6">
                <label class="form-label" for="titulo">Título do Evento <span class="text-danger">*</span></label>
                <input type="text" id="titulo" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{isset($acao_cultural->titulo) ? $acao_cultural->titulo : old('titulo')}}">
                @error('titulo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label class="form-label" for="gratuito">Evento Gratuito? </label>
                <select class="form-control" id="gratuito" name="gratuito">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
                @error('gratuito')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label class="form-label" for="tipo_evento">Tipo de Evento</label>
                <select class="form-control" id="tipo_evento" name="tipo_evento">
                    <option value="presencial">Presencial</option>
                    <option value="hibrido">Híbrido</option>
                    <option value="online">Online</option>
                </select>
                @error('tipo_evento')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

        </div>
            <div class="form-group">
                <label class="form-label" for="resumo">Resumo <span class="text-danger">*</span></label>
                <textarea id="resumo" name="resumo" class="form-control @error('resumo') is-invalid @enderror" rows="5">{{isset($acao_cultural->resumo) ? $acao_cultural->resumo : old('resumo')}}</textarea>
                @error('resumo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        <div class="row g-2">
            <div class="form-group col-md-6">
                <label class="form-label" for="selecao_segmento">Segmento Cultural <span class="text-danger">*</span></label>
                <div class="input-group">
                    <select  multiple="" class="form-control col-md-6 @error('segmento_cultural') is-invalid @enderror" id="selecao_segmento" name="selecao_segmento[]" style="height: 200px;">
                        @if (!empty($lista_segmento_cultural))
                            @foreach ($lista_segmento_cultural as $segmento_cultural)
                            <option value="{{$segmento_cultural}}" @if( (collect(old('segmento_cultural'))->contains($segmento_cultural)) || (isset($acao_cultural->segmento_cultural) && $acao_cultural->segmento_cultural->contains($segmento_cultural)) ) selected @endif>{{$segmento_cultural}}</option>
                            @endforeach
                        @endif
                    </select>
                    <button class="btn btn-secondary" type="button" id="btn_limpar"><i class="fal fa-trash-alt"></i></button>
                    <div class="input-group-append col-md-6">
                        <input type="text" id="segmento_cultural" name="segmento_cultural" class="form-control" placeholder="*Ou Especifique outro"  value="{{isset($acao_cultural->segmento_cultural) ? $acao_cultural->seguimento_cultural : old('especifique')}}" >
                    </div>
                </div>
                @error('segmento_cultural')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group col-md-3">
                <label class="form-label" for="palavras_chaves">Palavras chaves </label>
                <input type="text" id="palavras_chaves" name="palavras_chaves" class="form-control" data-role="tagsinput" placeholder="Digite entre virgulas" value="{{isset($acao_cultural->palavras_chaves) ? $acao_cultural->palavras_chaves : old('palavras_chaves')}}">
            </div>
            <div class="form-group col-md-3">
                <label class="form-label" for="url">Url (site) </label>
                <input type="text" id="url" name="url" class="form-control" placeholder="https://www.unicamp.br" value="{{isset($acao_cultural->url) ? $acao_cultural->url : old('url')}}">
            </div>
        </div>
        <div class="row g-4">
            <div class="form-group col-md-3">
                <label class="form-label" for="ckvinculo">Evento possui vinculo com ensino, pesquisa ou extensão?</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="ckensino">
                    <label class="form-check-label" for="ckensino">
                        Ensino
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="ckpesquisa">
                    <label class="form-check-label" for="ckpesquisa">
                        Pesquisa
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="ckextensao">
                    <label class="form-check-label" for="ckextensao">
                        Extensão
                    </label>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label class="form-label text-muted" id="lbl_vinculo_ensino" for="titulo">Título do Projeto (Ensino)</label>
                <input type="text" id="vinculo_ensino" name="vinculo_ensino"  disabled="" class="form-control @error('vinculo_ensino') is-invalid @enderror" value="{{isset($acao_cultural->vinculo_ensino) ? $acao_cultural->vinculo_ensino : old('vinculo_ensino')}}">
                @error('vinculo_ensino')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label class="form-label text-muted" id="lbl_vinculo_pesquisa" for="titulo">Título do Projeto (Pesquisa)</label>
                <input type="text" id="vinculo_pesquisa" name="vinculo_pesquisa"  disabled="" class="form-control @error('vinculo_pesquisa') is-invalid @enderror" value="{{isset($acao_cultural->vinculo_pesquisa) ? $acao_cultural->vinculo_pesquisa : old('vinculo_pesquisa')}}">
                @error('vinculo_pesquisa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label class="form-label text-muted" id="lbl_vinculo_extensao" for="titulo">Título do Projeto (Extensão)</label>
                <input type="text" id="vinculo_extensao" name="vinculo_extensao"  disabled="" class="form-control @error('vinculo_extensao') is-invalid @enderror" value="{{isset($acao_cultural->vinculo_extensao) ? $acao_cultural->vinculo_extensao : old('vinculo_extensao')}}">
                @error('vinculo_extensao')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row g-3">
            <div class="form-group col-md-3">
                <label class="form-label" for="publico_alvo">Publico alvo <span class="text-danger">*</span></label>
                <select name="publico_alvo[]" id="publico_alvo" multiple="" class="form-control @error('publico_alvo') is-invalid @enderror" style="height: 100px;">
                    @if (!empty($lista_publico_alvo))
                        @foreach ($lista_publico_alvo as $publico_alvo)
                        <option value="{{$publico_alvo}}" @if( (collect(old('publico_alvo'))->contains($publico_alvo)) || (isset($acao_cultural->publico_alvo) && $acao_cultural->publico_alvo->contains($publico_alvo)) ) selected @endif>{{$publico_alvo}}</option>
                        @endforeach
                    @endif
                </select>
                @error('publico_alvo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label class="form-label" for="estimativa_publico">Estimativa de público</label>
                <input class="form-control" id="estimativa_publico" type="number" min=1 name="estimativa_publico" value="{{isset($acao_cultural->estimativa_publico) ? $acao_cultural->estimativa_publico : old('estimativa_publico')}}">
            </div>
            <div class="form-group col-md-3">
                <label class="form-label" for="financiamento">Há financiamento público?</label>
                <select class="form-control" id="financiamento" name="financiamento">
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
                @error('financiamento')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row g-3">
            <div class="form-group col-md-3">
                <label class="form-label" for="unidade_id">Órgão/Unidade Principal <span class="text-danger">*</span></label>
                <select class="form-control @error('unidade_id') is-invalid @enderror" id="unidade_id" name="unidade_id">
                    @if(isset($acao_cultural))
                        <option value="{{$acao_cultural->unidade->id}}">{{$acao_cultural->unidade->nome}}</option>
                    @else
                        <option value="">Selecione a Unidade Responsável</option>
                    @endif
                    @if (!empty($unidades))
                        @foreach ($unidades as $unidade)
                          <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                        @endforeach
                    @endif
                </select>
                @error('unidade_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label class="form-label" for="estado">Estado <span class="text-danger">*</span></label>
                <select class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado">
                    <option value="">Selecione o Estado</option>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->uf }}" @if((isset($acaoLocal) && $acaoLocal[0]->uf == $estado->uf) || old('estado') == $estado->uf) selected @endif>{{ $estado->uf }}</option>
                    @endforeach
                </select>
                @error('estado')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label class="form-label" for="cidade">Cidade Principal <span class="text-danger">*</span></label>
                <select class="form-control @error('cidade') is-invalid @enderror" id="cidade" name="cidade">
                    @if( isset($acaoLocal) )
                        <option value="{{ $acao_cultural->municipio_id }}">{{ $acaoLocal[0]->nome_municipio }}</option>
                    @endif

                    @if( old('cidade') )
                                        <script>
                                            function loadDoc() {
                                            const xhttp = new XMLHttpRequest();
                                            xhttp.onload = function() {
                                                var data = this.responseText;
                                                data = JSON.parse(data);
                                                var content = '';
                                                var cidade = document.getElementById('cidade');
                                                var old = '{{ old('cidade') }}';

                                                data.map(municipio => {
                                                    content += `<option value="${municipio.id}" ${old == municipio.id ? 'selected' : ''}>${municipio.nome_municipio}</option>`;
                                                });

                                                cidade.innerHTML = content;
                                            }
                                            xhttp.open("GET", "{{ url('get-municipios-by-uf') }}/?uf=" + document.getElementById('estado').value);
                                            xhttp.send();
                                            }

                                            loadDoc()
                                        </script>
                    @endif
                </select>
                @error('cidade')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
