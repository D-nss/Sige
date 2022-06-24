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
                <select class="form-control" id="tipo" name="tipo">
                    @if(isset($acao_extensao))
                            <option value="{{$acao_extensao->tipo}}">Implementar Switch {{$acao_extensao->tipo}}</option>
                    @else
                            <option value="">Selecione o Tipo da Ação</option>
                    @endif
                    <option value="1">Programa</option>
                    <option value="2">Projeto</option>
                    <option value="3">Curso</option>
                    <option value="4">Evento</option>
                    <option value="5">Prestação de Serviços</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="linha_extensao_id">Linha de Extensão <span class="text-danger">*</span></label>
                <select class="form-control" id="linha_extensao_id" name="linha_extensao_id">
                    <option value="">Selecione a Linha de Extensão</option>
                      @if (!empty($linhas))
                        @foreach ($linhas as $linha)
                          <option value="{{$linha->id}}">{{$linha->nome}}</option>
                        @endforeach
                      @endif
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="areas_tematicas">Áreas Temáticas <span class="text-danger">*</span> <i>(Escolha pelo menos um)</i></label>
                <select name="areas_tematicas[]" id="areas_tematicas" multiple="" class="form-control">
                    @if (!empty($areas))
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{$area->nome}}</option>
                        @endforeach
                    @endif
                </select>
            </div>


        </div>
        <div id="step-2" class="">
            <div class="form-group">
                <label class="form-label" for="titulo">Título da Ação <span class="text-danger">*</span></label>
                <input type="text" id="titulo" name="titulo" required class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label" for="descricao">Descrição <span class="text-danger">*</span></label>
                <textarea id="descricao" name="descricao" required class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="palavras_chaves">Palavras chaves </label>
                <input type="text" id="palavras_chaves" name="palavras_chaves" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label" for="url">Url (site) </label>
                <input type="text" id="url" name="url" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label" for="publico_alvo">Público alvo <span class="text-danger">*</span></label>
                <input type="text" id="publico_alvo" name="publico_alvo" class="form-control" required>
            </div>
        </div>
        <div id="step-3" class="">
            <div class="form-group">
                <label class="form-label" for="data_inicio">Data de Início <span class="text-danger">*</span></label>
                <input class="form-control col-md-3" type="date" id="data_inicio" name="data_inicio" placeholder="dd/mm/aaaa" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="data_fim">Data Fim </label>
                <input class="form-control col-md-3" type="date" id="data_fim" name="data_fim" placeholder="dd/mm/aaaa">
            </div>
            <div class="form-group">
                <label class="form-label" for="estado">Estado <span class="text-danger">*</span></label>
                <select class="form-control col-md-3" id="estado" name="estado">
                    <option value="1">Selecione o Estado</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="cidade">Cidade Principal <span class="text-danger">*</span></label>
                <select class="form-control col-md-3" id="cidade" name="cidade">
                    <option value="1">Selecione a Cidade</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="municipio">Situação da Ação <span class="text-danger">*</span></label>
                <select class="form-control col-md-3" id="situacao" name="situacao">
                    @if(isset($acao_extensao))
                            <option value="{{$acao_extensao->situacao}}">Implementar Switch {{$acao_extensao->tipo}}</option>
                    @else
                            <option value="">Selecione a Situação</option>
                    @endif
                    <option value="1">Desativado</option>
                    <option value="2">Em andamento</option>
                    <option value="3">Concluído</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="georreferenciacao">Georreferenciação <i>(*para o Mapa da Extensão)</i></label>
                <textarea id="georreferenciacao" name="georreferenciacao" class="form-control" rows="5" placeholder="Insira os locais com suas respectivas coordenadas onde a Ação é executada"></textarea>
            </div>
        </div>
        <div id="step-4" class="">
            <div class="form-group">
                <label class="form-label" for="unidade">Órgão/Unidade <span class="text-danger">*</span></label>
                <select class="form-control col-md-3" id="unidade" name="unidade">
                    <option value="1">Selecione a Unidade Responsável</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="nome_coordenador">Nome do Coordenador <span class="text-danger">*</span></label>
                <input type="text" id="nome_coordenador" name="nome_coordenador" required class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label" for="tipo_coordenador">Tipo do Coordenador <span class="text-danger">*</span></label>
                <select class="form-control col-md-3" id="tipo_coordenador" name="tipo_coordenador">
                    <option value="1">Selecione o Tipo</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="equipe">Equipe</label>
                <textarea id="equipe" name="equipe" class="form-control" rows="5" placeholder="Digite entre virgulas"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="qtd_graduacao">Quantidade de alunos de graduação envolvidos na ação</label>
                <input class="form-control col-md-3" id="qtd_graduacao" type="number" name="qtd_graduacao">
            </div>
            <div class="form-group">
                <label class="form-label" for="qtd_pos_graduacao">Quantidade de alunos de pós-graduação envolvidos na ação</label>
                <input class="form-control col-md-3" id="qtd_pos_graduacao" type="number" name="qtd_pos_graduacao">
            </div>
        </div>
        <div id="step-5" class="">
            <div class="form-group">
                <label class="form-label" for="parceiro">Parceiro(s)</label>
                <input type="text" id="parceiro" name="parceiro" required class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label" for="tipo_parceiro">Tipo do Principal Parceiro</label>
                <select class="form-control col-md-6" id="tipo_parceiro" name="tipo_parceiro">
                    <option value="1">Selecione o Tipo</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="impactos_universidade">Impactos para a universidade <span class="text-danger">*</span></label>
                <textarea id="impactos_universidade" name="impactos_universidade" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="impactos_sociedade">Impactos para a sociedade <span class="text-danger">*</span></label>
                <textarea id="impactos_sociedade" name="impactos_sociedade" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="grau_envolvimento_equipe">Tipo de envolvimento da equipe com a Comunidade <span class="text-danger">*</span></label>
                <select class="form-control col-md-6" id="grau_envolvimento_equipe" name="grau_envolvimento_equipe">
                    <option value="1">Selecione o tipo do envolvimento</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="investimento">Investimento total (em Reais, R$) <span class="text-danger">*</span></label>
                <input type="text" id="investimento" name="investimento" required class="form-control col-md-6">
            </div>
        </div>
    </div>
</div>
