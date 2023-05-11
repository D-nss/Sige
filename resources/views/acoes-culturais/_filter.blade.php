
                    <div class="row g-3">
                        <div class="form-group col-md-3">
                            <label class="form-label" for="nome_coordenador">Nome do Coordenador</label>
                            <input type="text" id="nome_coordenador" name="nome_coordenador" class="form-control" value="{{old('nome_coordenador')}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="unidade_id">Órgão/Unidade</label>
                            <select class="form-control" id="unidade_id" name="unidade_id">
                                <option value="">Selecione a Unidade</option>
                                @if (!empty($unidades))
                                    @foreach ($unidades as $unidade)
                                      <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="tipo_evento">Tipo do Evento </label>
                            <select class="form-control " id="tipo_evento" name="tipo_evento">
                                <option value="">Selecione o Tipo Evento</option>
                                <option value="presencial">Presencial</option>
                                <option value="hibrido">Híbrido</option>
                                <option value="online">Online</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="segmento_cultural">Segmento Cultural</label>
                            <select class="form-control col-md-6" id="segmento_cultural" name="segmento_cultural">
                                @if (!empty($lista_segmento_cultural))
                                    <option value="">Selecione o Segmento</option>
                                    @foreach ($lista_segmento_cultural as $segmento_cultural)
                                    <option value="{{$segmento_cultural}}">{{$segmento_cultural}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="form-group col-md-2">
                            <label class="form-label" for="palavra_chave">Palavra Chave</label>
                            <input type="text" id="palavra_chave" name="palavra_chave" class="form-control" value="{{old('palavra_chave')}}">
                        </div>

                        <div class="form-group col-md-1">
                            <label class="form-label" for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="">UF</option>
                                @foreach($estados as $estado)
                                    <option value="{{ $estado->uf }}" @if(old('estado') == $estado->uf) selected @endif>{{ $estado->uf }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="form-label" for="cidade">Cidade</label>
                            <select class="form-control" id="cidade" name="cidade">
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
                        </div>
                        <div class="col-md-3 justify-content-md-end">
                            <button class="btn btn-primary" type="submit"><span class="fal fa-filter mr-1"></span>Filtrar</button>
                            <button class="btn btn-secondary" type="button"><span class="fal fa-trash mr-1"></span>Limpar</button>
                        </div>
                    </div>

