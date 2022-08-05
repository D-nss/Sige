
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
                            <label class="form-label" for="tipo">Tipo da Ação </label>
                            <select class="form-control " id="tipo" name="tipo">
                                <option value="">Selecione o Tipo da Ação</option>
                                <option value="1">Programa</option>
                                <option value="2">Projeto</option>
                                <option value="3">Curso</option>
                                <option value="4">Evento</option>
                                <option value="5">Prestação de Serviços</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="area_tematica">Área Temática</label>
                            <select name="area_tematica_id" id="area_tematica_id" class="form-control">
                                <option value="">Selecione a Area</option>
                                @if (!empty($areas_tematicas))
                                    @foreach ($areas_tematicas as $area_tematica)
                                        <option value="{{ $area_tematica->id }}">{{$area_tematica->nome}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="form-group col-md-4">
                            <label class="form-label" for="linha_extensao_id">Linha de Extensão</label>
                            <select class="form-control" id="linha_extensao_id" name="linha_extensao_id">
                                <option value="">Selecione a Linha de Extensão</option>
                                @if (!empty($linhas_extensao))
                                    @foreach ($linhas_extensao as $linha_extensao)
                                        <option value="{{$linha_extensao->id}}">{{$linha_extensao->nome}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

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

