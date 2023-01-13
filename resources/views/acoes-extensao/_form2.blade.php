

                    <div class="row g-3">
                        <div class="form-group col-md-7">
                            <label class="form-label" for="titulo">Título da Ação <span class="text-danger">*</span></label>
                            <input type="text" id="titulo" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{isset($acao_extensao->titulo) ? $acao_extensao->titulo : old('titulo')}}">
                            @error('titulo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-5">
                            <label class="form-label" for="modalidade"><a href="#modal-ajuda-modalidade-acao" data-toggle="modal">Modalidade</a> <span class="text-danger">*</span></label>
                            <!-- Modal center -->
                            <div class="modal fade" id="modal-ajuda-modalidade-acao" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <select class="form-control @error('modalidade') is-invalid @enderror" id="modalidade" name="modalidade">
                                @if(isset($acao_extensao))
                                        @switch($acao_extensao->modalidade)
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
                                        <option value="">Selecione a Modalidade</option>
                                @endif
                                <option value="1">Programa</option>
                                <option value="2">Projeto</option>
                                <option value="3">Curso</option>
                                <option value="4">Evento</option>
                                <option value="5">Prestação de Serviço</option>
                            </select>
                            @error('modalidade')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="row g-3">
                        <div class="form-group col-md-4">
                            <label class="form-label" for="ods"><a href="#modal-ajuda-ods" data-toggle="modal">Objetivos Desenvolvimento Sustentavel</a> <span class="text-danger">*</span></label>
                            <!-- Modal center -->
                            <div class="modal fade" id="modal-ajuda-ods" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>FORPROEX:</h4>
                                            <p>"Objetivos Desenvolvimento Sustentável"</p>
                                            <br>
                                            <p>Pode escolher mais de um Objetivo. Para isso, é só manter o CTRL pressionado e selecionar outras áreas.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <select name="ods[]" id="ods" multiple="" class="form-control @error('ods') is-invalid @enderror" style="height: 300px;">
                                @if (!empty($ods))
                                    @foreach ($ods as $ods)
                                        <option value="{{ $ods->id }}" @if( (collect(old('ods'))->contains($ods->id)) || (isset($acao_extensao->objetivos_desenvolvimento_sustentavel) && $acao_extensao->objetivos_desenvolvimento_sustentavel->contains($ods->id)) ) selected @endif>{{$ods->nome}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('ods')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="areas_tematicas"><a href="#modal-ajuda-areas" data-toggle="modal">Áreas Temáticas</a> <span class="text-danger">*</span></label>
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
                            <select name="areas_tematicas[]" id="areas_tematicas" multiple="" class="form-control @error('areas_tematicas') is-invalid @enderror" style="height: 300px;">
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
                        <div class="form-group col-md-5">
                            <label class="form-label" for="linha_extensao_id"><a href="#modal-ajuda-linhas" data-toggle="modal">Linha de Extensão</a> <span class="text-danger">*</span></label>
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
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="descricao">Descrição (Resumo)<span class="text-danger">*</span></label>
                        <textarea id="descricao" name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="5">{{isset($acao_extensao->descricao) ? $acao_extensao->descricao : old('descricao')}}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row g-3">
                        <div class="form-group col-md-9">
                            <label class="form-label" for="publico_alvo">Público alvo <span class="text-danger">*</span></label>
                            <input type="text" id="publico_alvo" name="publico_alvo" class="form-control @error('publico_alvo') is-invalid @enderror" value="{{isset($acao_extensao->publico_alvo) ? $acao_extensao->publico_alvo : old('publico_alvo')}}">
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
                    <div class="row g-4">
                        <div class="form-group col-md-3">
                            <label class="form-label" for="data_inicio">Data inicial <span class="text-danger">*</span></label>
                            <input class="form-control @error('data_inicio') is-invalid @enderror" type="date" id="data_inicio" name="data_inicio" placeholder="dd/mm/aaaa" value="{{isset($acao_extensao->data_inicio) ? $acao_extensao->data_inicio->toDateString() : old('data_inicio')}}">
                            @error('data_inicio')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="data_fim">Data final </label>
                            <input class="form-control" type="date" id="data_fim" name="data_fim"  value="{{isset($acao_extensao->data_fim) ? $acao_extensao->data_fim->toDateString() : old('data_fim')}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="palavras_chaves">Palavras chaves </label>
                            <input type="text" id="palavras_chaves" name="palavras_chaves" class="form-control" data-role="tagsinput" placeholder="Digite entre virgulas" value="{{isset($acao_extensao->palavras_chaves) ? $acao_extensao->palavras_chaves : old('palavras_chaves')}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="url">Url (site) </label>
                            <input type="text" id="url" name="url" class="form-control" placeholder="https://www.unicamp.br" value="{{isset($acao_extensao->url) ? $acao_extensao->url : old('url')}}">
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="form-group col-md-3">
                            <label class="form-label" for="unidade_id">Órgão/Unidade <span class="text-danger">*</span></label>
                            <select class="form-control @error('unidade_id') is-invalid @enderror" id="unidade_id" name="unidade_id">
                                @if(isset($acao_extensao))
                                    <option value="{{$acao_extensao->unidade->id}}">{{$acao_extensao->unidade->nome}}</option>
                                @else
                                    <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
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
                        <div class="form-group col-md-3">
                            <label class="form-label" for="investimento">Investimento total (em Reais, R$) <span class="text-danger">*</span></label>
                            <input type="text" id="investimento" name="investimento" class="form-control @error('investimento') is-invalid @enderror" value="{{isset($acao_extensao->investimento) ? number_format($acao_extensao->investimento, 2, ',', '.')  : old('investimento')}}">
                            @error('investimento')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>


