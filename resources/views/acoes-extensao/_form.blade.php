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
                <label class="form-label" for="example-multiselect">Áreas Temáticas <span class="text-danger">*</span> <i>(Escolha pelo menos um)</i></label>
                <select id="example-multiselect" multiple="" class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>

        </div>
        <div id="step-2" class="">
            <div class="form-group">
                <label class="form-label" for="titulo">Título da Ação <span class="text-danger">*</span></label>
                <input type="text" id="titulo" name="titulo" required class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label" for="example-textarea">Descrição <span class="text-danger">*</span></label>
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
                <input type="text" id="publico_alvo" name="publico_alvo" class="form-control">
            </div>
        </div>
        <div id="step-3" class="">
            <div class="form-group">
                <label class="form-label" for="data_inicio">Data de Início <span class="text-danger">*</span></label>
                <input type="text" class="form-control" type="date" id="data_inicio" name="data_inicio" placeholder="dd/mm/aaaa">
            </div>
            <div class="form-group">
                <label class="form-label" for="data_fim">Data Fim </label>
                <input type="text" class="form-control" type="date" id="data_fim" name="data_fim" placeholder="dd/mm/aaaa">
            </div>
            <div class="form-group">
                <label class="form-label" for="situacao">Situação da Ação <span class="text-danger">*</span></label>
                <select class="form-control" id="situacao" name="situacao">
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


        </div>
        <div id="step-4" class="">
            Step Content
        </div>
        <div id="step-5" class="">
            Step Content
        </div>
    </div>
</div>
