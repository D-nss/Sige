

                    <div class="row g-3">
                        <div class="form-group col-md-7">
                            <label class="form-label" for="titulo">Nome da Ação <span class="text-danger">*</span></label>
                            <input type="text" id="titulo" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{isset($acao_extensao->titulo) ? $acao_extensao->titulo : old('titulo')}}" @if(isset($acao_extensao) && $acao_extensao->ocorrencia->count() > 0) disabled @endif>
                            @error('titulo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-5">
                            <label class="form-label" for="modalidade">Modalidade <a href="#modal-ajuda-modalidade-acao" data-toggle="modal"><span class="text-danger">*</span> <img class="ml-1" src="{{ asset('smartadmin-4.5.1/img/ajuda-icon.png') }}" alt=""></a> </label>
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
                                            <!-- <h4>III – CURSO</h4>
                                            <p>“Ação pedagógica, de caráter teórico e/ou prático, presencial ou a distância, planejada e organizada de modo sistemático, com carga horária mínima de 8 horas e critérios de avaliação definidos”.</p> -->
                                            <h4>III - EVENTO</h4>
                                            <p>“Ação que implica na apresentação e/ou exibição pública, livre ou com clientela
                                                específica, do conhecimento ou produto cultural, artístico, esportivo, científico
                                                e tecnológico desenvolvido, conservado ou reconhecido pela Universidade”.</p>
                                            <h5>IV – PRESTAÇÃO DE SERVIÇO</h5>
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
                            <select class="form-control @error('modalidade') is-invalid @enderror" id="modalidade" name="modalidade" @if(isset($acao_extensao) && $acao_extensao->ocorrencia->count() > 0) disabled @endif>
                                @if(isset($acao_extensao))
                                        @switch($acao_extensao->modalidade)
                                            @case(1)
                                                <option value="1">Programa</option>
                                                @break
                                            @case(2)
                                            <option value="2">Projeto</option>
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
                                <option value="1" @if( old('modalidade') == 1 ) selected @endif >Programa</option>
                                <option value="2" @if( old('modalidade') == 2 ) selected @endif >Projeto</option>
                                <!-- <option value="3" @if( old('modalidade') == 3 ) selected @endif >Curso</option> -->
                                <option value="4" @if( old('modalidade') == 4 ) selected @endif >Evento</option>
                                <option value="5" @if( old('modalidade') == 5 ) selected @endif >Prestação de Serviço</option>
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
                            <label class="form-label" for="ods">Objetivos Desenvolvimento Sustentavel <span class="text-danger">*</span><a href="#modal-ajuda-ods" data-toggle="modal"><img class="ml-1" src="{{ asset('smartadmin-4.5.1/img/ajuda-icon.png') }}" alt=""></a></label>
                            <p class="text-muted"><small>Seleção múltipla: Pressione [Ctrl] ao selecionar mais de um.</small></p>
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
                            <label class="form-label" for="areas_tematicas">Áreas Temáticas<span class="text-danger">*</span><a href="#modal-ajuda-areas" data-toggle="modal"><img class="ml-1" src="{{ asset('smartadmin-4.5.1/img/ajuda-icon.png') }}" alt=""></a></label>
                            <p class="text-muted"><small>Seleção múltipla é permitida.</small></p>
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
                            <label class="form-label" for="linha_extensao_id">Linha de Extensão <span class="text-danger">*</span><a href="#modal-ajuda-linhas" data-toggle="modal"><img class="ml-1" src="{{ asset('smartadmin-4.5.1/img/ajuda-icon.png') }}" alt=""></a></label>
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
                                        <option value="{{$linha_extensao->id}}" @if( old('linha_extensao_id') == $linha_extensao->id ) selected @endif >{{$linha_extensao->nome}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('linha_extensao_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mt-3">
                                <label class="form-label" for="">Se vinculo com programa indicar programa</label>
                                <select class="form-control" id="programa_id" name="programa_id">
                                    <option value=""> Selecione o programa</option>
                                    @foreach($programas as $programa)
                                        <option value="{{ $programa->id }}" @if( old('programa_id') == $programa->id || (isset($acao_extensao) && $acao_extensao->programa_id == $programa->id)) selected @endif >{{ $programa->titulo }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="descricao">Descrição (Resumo) da Ação de Extensão <span class="text-danger">*</span></label>
                        <textarea id="descricao" name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror" placeholder="Digite aqui a descrição. Limite de 10000 caracteres." rows="5" @if(isset($acao_extensao) && $acao_extensao->ocorrencia->count() > 0) disabled @endif>{{isset($acao_extensao->descricao) ? $acao_extensao->descricao : old('descricao')}}</textarea>
                        <small class="text-muted d-none" id="caracter-counter-descricao"></small>
                        @error('descricao')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="border-top border-bottom pt-3 pb-2">
                        <h2>Público-alvo  <span class="text-danger">*</span></h2>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-md-6 @error('publico_alvo') border border-danger rounded p-2 @enderror">
                            <label class="form-label" for="publico_alvo">Seleção Atual</label>
                            <select class="d-none" name="publico_alvo[]" id="publico_alvo" multiple>
                                <option value="UNICAMP (Docentes, Discentes e Técnico-Administrativos)">UNICAMP (Docentes, Discentes e Técnico-Administrativos)</option>
                                <option value="Instituições Públicas (Municipal, Estadual e Federal)">Instituições Públicas (Municipal, Estadual e Federal)</option>
                                <option value="Setor Privado (Comércio, Indústria e Serviço)">Setor Privado (Comércio, Indústria e Serviço)</option>
                                <option value="Escolas Públicas (Municipal, Estadual e Federal)">Escolas Públicas (Municipal, Estadual e Federal)</option>
                                <option value="Ensino Infantil">Ensino Infantil</option>
                                <option value="Ensino Fundamental I e II">Ensino Fundamental I e II</option>
                                <option value="Ensino Médio">Ensino Médio</option>
                                <option value="Ensino Técnico">Ensino Técnico</option>
                                <option value="Ensino Superior">Ensino Superior</option>
                                <option value="Comunidades Indígenas">Comunidades Indígenas</option>
                                <option value="Comunidades Quilombolas">Comunidades Quilombolas</option>
                                <option value="Assentamentos Rurais">Assentamentos Rurais</option>
                                <option value="Crianças">Crianças</option>
                                <option value="Adolescentes">Adolescentes</option>
                                <option value="Idosos">Idosos</option>
                                <option value="População em Vulnerabilidade Social">População em Vulnerabilidade Social</option>
                                <option value="Mulheres">Mulheres</option>
                                <option value="Homens">Homens</option>
                                <option value="Pessoas com Deficiência">Pessoas com Deficiência</option>
                                <option value="População Negra">População Negra</option>
                                <option value="LGBTQIA+">LGBTQIA+</option>
                            </select>
                            <div id="selecao_atual">
                                
                            </div>
                            <p class="text-muted">Favor escolher abaixo</p>
                            <label class="form-label">Adicione</label>
                            <div id="adicione">
                           
                            </div>
                            <!-- <input type="text" id="publico_alvo" name="publico_alvo" class="form-control @error('publico_alvo') is-invalid @enderror" value="{{isset($acao_extensao->publico_alvo) ? $acao_extensao->publico_alvo : old('publico_alvo')}}"> -->
                            @error('publico_alvo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-label" for="estimativa_publico">Estimativa de Público (do seu público-alvo)</label>
                            <input class="form-control" id="estimativa_publico" type="number" min=1 name="estimativa_publico" value="{{isset($acao_extensao->estimativa_publico) ? $acao_extensao->estimativa_publico : old('estimativa_publico')}}">
                        </div>
                    </div>
                    <div class="border-top border-bottom pt-3 pb-2">
                        <h2>Anotações e Comunicação</h2>
                    </div>
                    <div class="form-group mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Suas anotações (só ficarão visíveis para você)</label>
                                <textarea class="form-control" name="anotacoes" id="anotacoes" cols="30" rows="10" placeholder="Digite aqui suas anotações. Limite de 500 caracteres.">{{ isset($acao_extensao) ? $acao_extensao->anotacoes : old('anotacoes')}}</textarea>
                                <small class="text-muted d-none" id="caracter-counter-anotacoes"></small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mensagem inicial para a Comissão de Extensão da Unidade</label>
                                <textarea class="form-control" name="mensagem_extensao" id="mensagem_extensao" cols="30" rows="10" placeholder="Digite aqui sua mensagem inicial para a Coordenação de Extensão da Unidade. Ao rever sua proposta, a Comissão poderá visualizá-la. Limite de 500 caracteres.">{{ isset($acao_extensao) ? $acao_extensao->mensagem_extensao : old('mensagem_extensao')}}</textarea>
                                <small class="text-muted d-none" id="caracter-counter-mensagem_extensao"></small>
                            </div>
                        </div>
                    </div>
                    <div class="border-top border-bottom pt-3 pb-2">
                        <h2>Curricularização</h2>
                    </div>
                    <div class="form-group border-bottom pt-3 pb-2">
                        <div class="custom-control custom-switch mb-3">
                            <input class="custom-control-input" type="checkbox" id="curricularizar"
                                name="curricularizar" {{ old('curricularizar') || isset($acao_extensao->vagas_curricularizacao)  ? 'checked' : '' }} 
                                @if(is_null($comissao_graduacao))
                                    disabled
                                @endif>
                            <label class="custom-control-label" for="curricularizar">
                                A Ação estará disponível para curricularização.
                                <a href="#modal-ajuda-curricularizacao" data-toggle="modal"><img class="ml-1" src="{{ asset('smartadmin-4.5.1/img/ajuda-icon.png') }}" alt=""></a>
                            </label>
                        </div>

                        <div class="{{ old('curricularizar') || isset($acao_extensao->vagas_curricularizacao) ? 'd-block' : 'd-none' }}" id="acao_curricularizacao">
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label class="form-label" for="vagas_curricularizacao">Vagas Curricularização <span class="text-danger">*</span></label>
                                    <input class="form-control" id="vagas_curricularizacao" type="number" min=1 name="vagas_curricularizacao" value="{{isset($acao_extensao->vagas_curricularizacao) ? $acao_extensao->vagas_curricularizacao : old('vagas_curricularizacao')}}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="form-label" for="qtd_horas_curricularizacao">Horas Curricularização <span class="text-danger">*</span></label>
                                    
                                    <input class="form-control" id="qtd_horas_curricularizacao" type="number" min=1 name="qtd_horas_curricularizacao" value="{{isset($acao_extensao->qtd_horas_curricularizacao) ? $acao_extensao->qtd_horas_curricularizacao : old('qtd_horas_curricularizacao')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="motivo_curricularizacao">Motivo da Curricularização  <span class="text-danger">*</span></label>
                                    <textarea name="motivo_curricularizacao" id="motivo_curricularizacao" class="form-control" rows="5" placeholder="Digite aqui o motivo da curricularização. Ao rever sua proposta, a Comissão poderá visualizá-la. Limite de 500 caracteres.">{{ isset($acao_extensao) ? $acao_extensao->motivo_curricularizacao : old('motivo_curricularizacao') }}</textarea>
                                    <small class="text-muted d-none" id="caracter-counter-motivo_curricularizacao"></small>
                                </div>
                            </div>
                        </div>
                        <!-- Modal center -->
                        <div class="modal fade" id="modal-ajuda-curricularizacao" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Horas Curricularização:</h4>
                                        <p>Informe a quantidade de horas por vaga que o aluno terá na Curricularização nesta Ação de Extensão.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom pt-3">
                        <h2>Impactos</h2>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="impactos_universidade">Impactos para a universidade <span class="text-danger">*</span></label>
                            <textarea id="impactos_universidade" name="impactos_universidade" class="form-control @error('impactos_universidade') is-invalid @enderror" placeholder="Digite aqui. Limite de 10000 caracteres." rows="5" @if(isset($acao_extensao) && $acao_extensao->ocorrencia->count() > 0) disabled @endif>{{isset($acao_extensao->impactos_universidade) ? $acao_extensao->impactos_universidade : old('impactos_universidade')}}</textarea>
                            <small class="text-muted d-none" id="caracter-counter-impactos_universidade"></small>
                            @error('impactos_universidade')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="impactos_sociedade">Impactos para a sociedade <span class="text-danger">*</span></label>
                            <textarea id="impactos_sociedade" name="impactos_sociedade" class="form-control @error('impactos_sociedade') is-invalid @enderror" placeholder="Digite aqui. Limite de 10000 caracteres." rows="5" @if(isset($acao_extensao) && $acao_extensao->ocorrencia->count() > 0) disabled @endif>{{isset($acao_extensao->impactos_sociedade) ? $acao_extensao->impactos_sociedade : old('impactos_sociedade')}}</textarea>
                            <small class="text-muted d-none" id="caracter-counter-impactos_sociedade"></small>
                            @error('impactos_sociedade')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="form-group col-md-3">
                            <label class="form-label" for="palavras_chaves">Palavras chaves </label>
                            <input type="text" id="palavras_chaves" name="palavras_chaves" class="form-control" data-role="tagsinput" placeholder="Digite entre virgulas" value="{{isset($acao_extensao->palavras_chaves) ? $acao_extensao->palavras_chaves : old('palavras_chaves')}}">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="form-label" for="url">Url (site) </label>
                            <input type="text" id="url" name="url" class="form-control" placeholder="https://www.unicamp.br" value="{{isset($acao_extensao->url) ? $acao_extensao->url : old('url')}}">
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
                    </div>
                    <div class="row">
                        <div class="col-12 @if(isset($acao_extensao) && $acao_extensao->ocorrencia->count() > 0) disabled @endif">
                            <h4>Upload de Arquivo</h4>
                            <div class="preview-zone hidden">
                                <div class="box box-solid">
                                    <div class="box-header with-border">
                                    <div></div>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-secondary btn-xs remove-preview" @if(isset($acao_extensao) && $acao_extensao->ocorrencia->count() > 0) disabled @endif>
                                        Limpar
                                        </button>
                                    </div>
                                    </div>
                                    <div class="box-body" id="box-body">
                                    @if(isset($acao_extensao->arquivo))
                                        <a href='{{ url("storage/$acao_extensao->arquivo") }}' class="btn btn-link" target="_blank">
                                            <img src='{{ url("smartadmin-4.5.1/img/pdf-icon.png") }}' alt="{{ $acao_extensao->titulo}}" class="img-thumbnail mb-2" style="max-width: 75px;" />
                                            <br>
                                            Arquivo Projeto
                                        </a>
                                    @endif

                                    @if($errors->any())
                                        <span class="font-weight-bold text-danger" style="font-size: 16px">Por Favor Inclua o arquivo novamente.</span>
                                    @endif

                                    </div>
                                </div>
                            </div>
                            <div class="dropzone-wrapper ">
                                <div class="dropzone-desc">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                    <p class="font-weight-bold text-info">Clique e arraste o arquivo até aqui (formato PDF, até 5MB), ou clique dentro desta área para selecionar o arquivo.</p>

                                </div>
                                <input type="file" name="arquivo" class="dropzone" id="arquivo" {{ isset($acao_extensao->arquivo) ? '' : 'required' }} @if(isset($acao_extensao) && $acao_extensao->ocorrencia->count() > 0) disabled @endif>

                            </div>
                        </div>
                        
                    </div>
                    <div class="row mt-5 p-3">
                        <div class="col-md-12 form-group alert alert-warning">
                            <i class="far fa-exclamation-circle"></i>
                            <span class="fw-700">É altamente recomendável  envio do arquivo PDF do projeto.</span> Após o envio deste formulário não será possível anexar o arquivo a esta proposta, e será necessário reiniciar todo o processo de preenchimento e aprovação.
                        </div>
                    </div>







