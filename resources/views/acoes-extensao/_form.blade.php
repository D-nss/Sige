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
            <div class="form-group text-center">
                <h4><b>CARACTERIZAÇÃO DA AÇÃO</b></h4>
            </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipo">Tipo da Ação<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" id="tipo" name="tipo">
                    @if(isset($acao_extensao))
                            <option value="{{$acao_extensao->tipo}}">Implementar Switch {{$acao_extensao->tipo}}</option>
                    @else
                            <option value="">Tipo da Ação</option>
                    @endif
                    <option value="1">Programa</option>
                    <option value="2">Projeto</option>
                    <option value="3">Curso</option>
                    <option value="4">Evento</option>
                    <option value="5">Prestação de Serviços</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="linha">Linha de Extensão<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" id="linha_extensao_id" name="linha_extensao_id">
                    <option value="">Selecione Linha de Extensão</option>
                      @if (!empty($linhas))
                        @foreach ($linhas as $linha)
                          <option value="{{$linha->id}}">{{$linha->nome}}</option>
                        @endforeach
                      @endif
                  </select>
                </div>
              </div>

        </div>
        <div id="step-2" class="">
            <div class="form-group text-center">
                <h4><b>DADOS GERAIS DA AÇÃO</b></h4>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo">Título da Ação<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="titulo" name="titulo" required="required" class="form-control col-md-7 col-xs-12" >
                </div>
              </div>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="descricao">Descrição<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="descricao" name="descricao" required="required" class="form-control col-md-7 col-xs-12"></textarea>
                </div>
              </div>
              <div class="item form-group">
                <div class="control-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Palavras chaves<span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="palavras_chaves" type="text" required="required" name="palavras_chaves" class="tags form-control"/>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="url">Url (site)<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="url" name="url" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="publico_alvo">Público alvo<span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="publico_alvo" required="required" name="publico_alvo" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
        </div>
        <div id="step-3" class="">
            Step Content
        </div>
        <div id="step-4" class="">
            Step Content
        </div>
        <div id="step-5" class="">
            Step Content
        </div>
    </div>
</div>
