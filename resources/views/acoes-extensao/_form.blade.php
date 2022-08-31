<div id="sw_acao_extensao">
    <ul>
        <li><a href="#step-1">Caracterização<br><small>Definição da Ação de Extensão</small></a></li>
        <li><a href="#step-2">Dados Gerais<br><small>Dados da Ação</small></a></li>
        <li><a href="#step-3">Datas e Locais<br><small>Locais da Ação</small></a></li>
        <li><a href="#step-4">Equipe<br><small>Coordenador e Equipe</small></a></li>
        <li><a href="#step-5">Parceiros e Comunidade<br><small>Parcerias e Comunidade</small></a></li>
    </ul>
    <div class="p-3">
        <div id="step-1" class="">
            <div class="form-group">
                <label class="form-label" for="tipo">Tipo da Ação <span class="text-danger">*</span></label>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-xs btn-info waves-effect waves-themed" data-toggle="modal" data-target="#modal-ajuda-tipo-acao">
                    <span class="fal fa-info-circle mr-1"></span>Informação
                </button>
                <!-- Modal center -->
                <div class="modal fade" id="modal-ajuda-tipo-acao" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    <small class="m-0 text-muted">
                                        Definições segundo a FORPROEX:
                                    </small>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4>I – PROGRAMA</h4>
                                <p>“Conjunto articulado de projetos e outras ações de extensão (cursos, eventos,
                                    prestação de serviços), preferencialmente integrando as ações de extensão, pesquisa e ensino. Tem caráter orgânico-institucional, clareza de diretrizes e orientação para um objetivo comum, sendo executado a médio e longo prazo”.</p>
                                <h4>II - PROJETO</h4>
                                <p>“Ação processual e contínua de caráter educativo, social, cultural, científico ou tecnológico, com objetivo específico e prazo determinado”.</p>
                                <h4>III – CURSO</h4>
                                <p>“Ação pedagógica, de caráter teórico e/ou prático, presencial ou a distância, planejada e organizada de modo sistemático, com carga horária mínima de 8 horas e critérios de avaliação definidos”.</p>
                                <h4>IV - EVENTO</h4>
                                <p>“Ação que implica na apresentação e/ou exibição pública, livre ou com clientela
                                    específica, do conhecimento ou produto cultural, artístico, esportivo, científico
                                    e tecnológico desenvolvido, conservado ou reconhecido pela Universidade”.</p>
                                <h5>V – PRESTAÇÃO DE SERVIÇO</h5>
                                <p>“Realização de trabalho oferecido pela Instituição de Educação Superior ou contratado por terceiros (comunidade, empresa, órgão público, etc.); a prestação de
                                    serviços se caracteriza por intangibilidade, inseparabilidade processo/produto e não
                                    resulta na posse de um bem”.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <select class="form-control @error('tipo') is-invalid @enderror" id="tipo" name="tipo">
                    @if(isset($acao_extensao))
                            @switch($acao_extensao->tipo)
                                @case(1)
                                    <option value="1">Programa</option>
                                    @break
                                @case(2)
                                <option value="2">Projeto</option>
                                    @break
                                @case(3)
                                <option value="3">Curso</option>
                                    @break
                                @case(4)
                                <option value="4">Evento</option>
                                    @break
                                @case(5)
                                <option value="5">Prestação de Serviço</option>
                                    @break
                                @default

                            @endswitch
                    @else
                            <option value="">Selecione o Tipo da Ação</option>
                    @endif
                    <option value="1">Programa</option>
                    <option value="2">Projeto</option>
                    <option value="3">Curso</option>
                    <option value="4">Evento</option>
                    <option value="5">Prestação de Serviço</option>
                </select>
                @error('tipo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="linha_extensao_id">Linha de Extensão <span class="text-danger">*</span></label>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-xs btn-info waves-effect waves-themed" data-toggle="modal" data-target="#modal-ajuda-linhas">
                    <span class="fal fa-info-circle mr-1"></span>Informação
                </button>
                <!-- Modal center -->
                <div class="modal fade" id="modal-ajuda-linhas" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4>O que são Linhas de Extensão:</h4>
                                <p>Classificação e definição pelo FORPROEX.
                                    As linhas de extensão não são, necessariamente, ligadas a
                                    uma área temática, em especial. Por exemplo, ações relativas à
                                    linha de extensão “Inovação Tecnológica” podem ser
                                    registradas na área temática Saúde, ou Educação, ou Trabalho,
                                    ou mesmo Tecnologia, dependendo do tema em questão.</p>
                                <p>Para informação das descrições das 53 linhas, consulte o portal RENEX.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <select class="form-control @error('linha_extensao_id') is-invalid @enderror" id="linha_extensao_id" name="linha_extensao_id">
                    @if(isset($acao_extensao))
                        <option value="{{$acao_extensao->linha_extensao->id}}">{{$acao_extensao->linha_extensao->nome}}</option>
                    @else
                        <option value="">Selecione a Linha de Extensão</option>
                    @endif
                    @if (!empty($linhas_extensao))
                        @foreach ($linhas_extensao as $linha_extensao)
                            <option value="{{$linha_extensao->id}}">{{$linha_extensao->nome}}</option>
                        @endforeach
                    @endif
                </select>
                @error('linha_extensao_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="areas_tematicas">Áreas Temáticas <span class="text-danger">*</span></label>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-xs btn-info waves-effect waves-themed" data-toggle="modal" data-target="#modal-ajuda-areas">
                    <span class="fal fa-info-circle mr-1"></span>Informação
                </button>
                <!-- Modal center -->
                <div class="modal fade" id="modal-ajuda-areas" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4>FORPROEX:</h4>
                                <p>"A <b>classificação por área</b> deve observar o objeto ou assunto que é enfocado na
                                    ação. Mesmo que não se encontre no conjunto das áreas uma correspondência
                                    absoluta com o objeto da ação, a mais aproximada, tematicamente, deverá ser
                                    a escolhida."</p>
                                <br>
                                <p>Pode escolher mais de uma Área Temática. Para isso, é só manter o CTRL pressionado e selecionar outras áreas.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <select name="areas_tematicas[]" id="areas_tematicas" multiple="" class="form-control @error('areas_tematicas') is-invalid @enderror" style="height: 150px;">
                    @if (!empty($areas_tematicas))
                        @foreach ($areas_tematicas as $area_tematica)
                            <option value="{{ $area_tematica->id }}" @if( (collect(old('areas_tematicas'))->contains($area_tematica->id)) || (isset($acao_extensao->areas_tematicas) && $acao_extensao->areas_tematicas->contains($area_tematica->id)) ) selected @endif>{{$area_tematica->nome}}</option>
                        @endforeach
                    @endif
                </select>
                @error('areas_tematicas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="step-2" class="">
            <div class="form-group">
                <label class="form-label" for="titulo">Título da Ação <span class="text-danger">*</span></label>
                <input type="text" id="titulo" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{isset($acao_extensao->titulo) ? $acao_extensao->titulo : old('titulo')}}">
                @error('titulo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="descricao">Descrição <span class="text-danger">*</span></label>
                <textarea id="descricao" name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="5">{{isset($acao_extensao->descricao) ? $acao_extensao->descricao : old('descricao')}}</textarea>
                @error('descricao')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="palavras_chaves">Palavras chaves </label>
                <input type="text" id="palavras_chaves" name="palavras_chaves" class="form-control" data-role="tagsinput" placeholder="Digite entre virgulas" value="{{isset($acao_extensao->palavras_chaves) ? $acao_extensao->palavras_chaves : old('palavras_chaves')}}">
            </div>
            <div class="form-group">
                <label class="form-label" for="url">Url (site) </label>
                <input type="text" id="url" name="url" class="form-control" placeholder="https://www.unicamp.br" value="{{isset($acao_extensao->url) ? $acao_extensao->url : old('url')}}">
            </div>
            <div class="form-group">
                <label class="form-label" for="publico_alvo">Público alvo <span class="text-danger">*</span></label>
                <input type="text" id="publico_alvo" name="publico_alvo" class="form-control @error('publico_alvo') is-invalid @enderror" value="{{isset($acao_extensao->publico_alvo) ? $acao_extensao->publico_alvo : old('publico_alvo')}}">
                @error('publico_alvo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div id="step-3" class="">
            <div class="form-group">
                <label class="form-label" for="data_inicio">Data de Início <span class="text-danger">*</span></label>
                <input class="form-control col-md-3 @error('data_inicio') is-invalid @enderror" type="date" id="data_inicio" name="data_inicio" placeholder="dd/mm/aaaa" value="{{isset($acao_extensao->data_inicio) ? $acao_extensao->data_inicio->toDateString() : old('data_inicio')}}">
                @error('data_inicio')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="data_fim">Data Fim </label>
                <input class="form-control col-md-3" type="date" id="data_fim" name="data_fim"  value="{{isset($acao_extensao->data_fim) ? $acao_extensao->data_fim->toDateString() : old('data_fim')}}">
            </div>
            <div class="form-group">
                <label class="form-label" for="estado">Estado <span class="text-danger">*</span></label>
                <select class="form-control col-md-3 @error('estado') is-invalid @enderror" id="estado" name="estado">
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
            <div class="form-group">
                <label class="form-label" for="cidade">Cidade Principal <span class="text-danger">*</span></label>
                <select class="form-control col-md-3 @error('cidade') is-invalid @enderror" id="cidade" name="cidade">
                    @if( isset($acaoLocal) )
                        <option value="{{ $acao_extensao->municipio_id }}">{{ $acaoLocal[0]->nome_municipio }}</option>
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
            <div class="form-group">
                <label class="form-label" for="situacao">Situação da Ação <span class="text-danger">*</span></label>
                <select class="form-control col-md-3 @error('situacao') is-invalid @enderror" id="situacao" name="situacao">
                    @if(isset($acao_extensao))
                            @switch($acao_extensao->situacao)
                                @case(1)
                                    <option value="1">Desativado</option>
                                    @break
                                @case(2)
                                <option value="2">Em andamento</option>
                                    @break
                                @case(3)
                                <option value="3">Concluído</option>
                                    @break
                                @default
                            @endswitch
                    @else
                            <option value="">Selecione o Tipo da Ação</option>
                    @endif
                    <option value="1">Desativado</option>
                    <option value="2">Em andamento</option>
                    <option value="3">Concluído</option>
                </select>
                @error('situacao')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="georreferenciacao">Georreferenciação</label>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-xs btn-info waves-effect waves-themed" data-toggle="modal" data-target="#modal-ajuda-geo">
                    <span class="fal fa-info-circle mr-1"></span>
                    Ajuda
                </button>
                <!-- Modal center -->
                <div class="modal fade" id="modal-ajuda-geo" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                   Ajuda - Georreferenciação
                                    <small class="m-0 text-muted">
                                        Veja como é simples adicionar um local
                                    </small>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4>Siga os seguintes passos:</h4>
                                <p>&nbsp&nbsp1. Acesse este site, ou outro de sua preferência, para obter a <b>latitude e longitude</b> do local que deseja inserir: </p>
                                <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="https://www.mapsdirections.info/pt/coordenadas-gps.html" target="blank"> https://www.mapsdirections.info/pt/coordenadas-gps.html</a> </p>
                                <p>&nbsp&nbsp2. Após obter as coordenadas, agora volte a este sistema e no campo de Georreferenciamento: </p>
                                <p>&nbsp&nbsp3. Coloque o nome do Local/Espaço. Este nome é o que será visualizado pelos demais usuários.</p>
                                <p>&nbsp&nbsp4. Depois, o valor da <b>latitude e longitude</b> Em graus decimais!<br> Exemplo: -22.818177</p>
                                <p>&nbsp&nbsp5. Para colocar mais locais, repita os passos. Caso queira limpar os locais adicionados, clique em <b>'Limpar Georreferenciação'</b> </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal center -->
                <div class="modal fade" id="modal-inserir-local" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">
                                    Adicionar um local onde a Ação é executada
                                    <small class="m-0 text-muted">
                                        Insira as informações nos campos correspondentes
                                    </small>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row mb-3">
                                        <label for="info_local" class="col-sm-4 col-form-label">Nome do Local</label>
                                        <div class="col-sm-6">
                                          <input type="text" class="form-control" id="info_local">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="lat_local" class="col-sm-4 col-form-label">Latitude <br><span class="text-danger">Em graus decimais</span></label>
                                        <div class="col-sm-4">
                                          <input type="number" class="form-control" id="lat_local">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="long_local" class="col-sm-4 col-form-label">Longitude <br><span class="text-danger">Em graus decimais</span></label>
                                        <div class="col-sm-4">
                                          <input type="number" class="form-control" id="long_local">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button id="btn-limpar-geo" type="button" class="btn btn-danger" >
                                    <span class="fal fa-trash-alt mr-1"></span>
                                    Limpar Georreferenciação
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    <span class="fal fa-times mr-1"></span>
                                    Fechar
                                </button>
                                <button id="btn-inserir-local" type="button" class="btn btn-primary">
                                    <span class="fal fa-map-marker-plus mr-1"></span>
                                    Adicionar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <textarea id="georreferenciacao" readonly="readonly" name="georreferenciacao" class="form-control" rows="5" placeholder="Clique aqui para inserir os locais onde a Ação é executada">{{isset($acao_extensao->georreferenciacao) ? $acao_extensao->georreferenciacao : old('georreferenciacao')}}</textarea>
            </div>
        </div>
        <div id="step-4" class="">
            <div class="form-group">
                <label class="form-label" for="unidade_id">Órgão/Unidade <span class="text-danger">*</span></label>
                <select class="form-control col-md-3 @error('unidade_id') is-invalid @enderror" id="unidade_id" name="unidade_id">
                    @if(isset($acao_extensao))
                        <option value="{{$acao_extensao->unidade->id}}">{{$acao_extensao->unidade->nome}}</option>
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
            <div class="form-group">
                <label class="form-label" for="nome_coordenador">Nome do Coordenador <span class="text-danger">*</span></label>
                <input type="text" id="nome_coordenador" name="nome_coordenador" class="form-control @error('nome_coordenador') is-invalid @enderror" value="{{isset($acao_extensao->nome_coordenador) ? $acao_extensao->nome_coordenador : old('nome_coordenador')}}">
                @error('nome_coordenador')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="tipo_coordenador">Tipo do Coordenador <span class="text-danger">*</span></label>
                <select class="form-control col-md-3 @error('tipo_coordenador') is-invalid @enderror" id="tipo_coordenador" name="tipo_coordenador">
                    @if(isset($acao_extensao))
                            @switch($acao_extensao->tipo_coordenador)
                                @case(1)
                                    <option value="1">Docente</option>
                                    @break
                                @case(2)
                                <option value="2">Discente</option>
                                    @break
                                @case(3)
                                <option value="3">Técnico Administrativo</option>
                                    @break
                                @case(4)
                                <option value="4">Outro</option>
                                    @break
                                @default
                            @endswitch
                    @else
                            <option value="">Selecione o Tipo da Ação</option>
                    @endif
                            <option value="1">Docente</option>
                            <option value="2">Discente</option>
                            <option value="3">Técnico Administrativo</option>
                            <option value="4">Outro</option>
                </select>
                @error('tipo_coordenador')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="equipe">Equipe</label>
                <input id="equipe" name="equipe" class="form-control" data-role="tagsinput" placeholder="Digite entre virgulas" value="{{isset($acao_extensao->equipe) ? $acao_extensao->equipe : old('equipe')}}">
            </div>
            <div class="form-group">
                <label class="form-label" for="qtd_graduacao">Quantidade de alunos de graduação envolvidos na ação</label>
                <input class="form-control col-md-3" id="qtd_graduacao" type="number" name="qtd_graduacao" value="{{isset($acao_extensao->qtd_graduacao) ? $acao_extensao->qtd_graduacao : old('qtd_graduacao')}}">
            </div>
            <div class="form-group">
                <label class="form-label" for="qtd_pos_graduacao">Quantidade de alunos de pós-graduação envolvidos na ação</label>
                <input class="form-control col-md-3" id="qtd_pos_graduacao" type="number" name="qtd_pos_graduacao" value="{{isset($acao_extensao->qtd_pos_graduacao) ? $acao_extensao->qtd_pos_graduacao : old('qtd_pos_graduacao')}}">
            </div>
        </div>
        <div id="step-5" class="">
            <div class="form-group">
                <label class="form-label" for="parceiro">Parceiro(s)</label>
                <input type="text" id="parceiro" name="parceiro" data-role="tagsinput" placeholder="Digite entre virgulas" class="form-control" value="{{isset($acao_extensao->parceiro) ? $acao_extensao->parceiro : old('parceiro')}}">
            </div>
            <div class="form-group">
                <label class="form-label" for="tipo_parceiro_id">Tipo do Principal Parceiro</label>
                <select class="form-control col-md-6" id="tipo_parceiro_id" name="tipo_parceiro_id">
                    @if(isset($acao_extensao->tipo_parceiro))
                        <option value="{{$acao_extensao->tipo_parceiro->id}}">{{$acao_extensao->tipo_parceiro->descricao}}</option>
                    @else
                        <option value="">Selecione o Tipo</option>
                    @endif
                    @if (!empty($tipos_parceiro))
                        @foreach ($tipos_parceiro as $tipo_parceiro)
                          <option value="{{$tipo_parceiro->id}}">{{$tipo_parceiro->descricao}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="impactos_universidade">Impactos para a universidade <span class="text-danger">*</span></label>
                <textarea id="impactos_universidade" name="impactos_universidade" class="form-control @error('impactos_universidade') is-invalid @enderror" rows="5">{{isset($acao_extensao->impactos_universidade) ? $acao_extensao->impactos_universidade : old('impactos_universidade')}}</textarea>
                @error('impactos_universidade')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="impactos_sociedade">Impactos para a sociedade <span class="text-danger">*</span></label>
                <textarea id="impactos_sociedade" name="impactos_sociedade" class="form-control @error('impactos_sociedade') is-invalid @enderror" rows="5">{{isset($acao_extensao->impactos_sociedade) ? $acao_extensao->impactos_sociedade : old('impactos_sociedade')}}</textarea>
                @error('impactos_sociedade')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="grau_envolvimento_equipe_id">Tipo de envolvimento da equipe com a Comunidade <span class="text-danger">*</span></label>
                <select class="form-control col-md-6 @error('grau_envolvimento_equipe_id') is-invalid @enderror" id="grau_envolvimento_equipe_id" name="grau_envolvimento_equipe_id">
                    @if(isset($acao_extensao))
                        <option value="{{$acao_extensao->grau_envolvimento_equipe->id}}">{{$acao_extensao->grau_envolvimento_equipe->descricao}}</option>
                    @else
                        <option value="">Selecione o Tipo</option>
                    @endif
                    <option value="">Selecione o tipo do envolvimento</option>
                    @if (!empty($graus_envolvimento_equipe))
                        @foreach ($graus_envolvimento_equipe as $grau_envolvimento_equipe)
                          <option value="{{$grau_envolvimento_equipe->id}}">{{$grau_envolvimento_equipe->descricao}}</option>
                        @endforeach
                    @endif
                </select>
                @error('grau_envolvimento_equipe_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="investimento">Investimento total (em Reais, R$) <span class="text-danger">*</span></label>
                <input type="text" id="investimento" name="investimento" class="form-control col-md-6 @error('investimento') is-invalid @enderror" value="{{isset($acao_extensao->investimento) ? number_format($acao_extensao->investimento, 2, ',', '.')  : old('investimento')}}">
                @error('investimento')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
</div>
