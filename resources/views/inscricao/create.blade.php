@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Inscrição</li>
    <li class="breadcrumb-item active">Nova Inscrição</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-plus'></i>Inscrição</span>
        <small>
            Cadastro de nova inscrição
        </small>
        <small>
            
        </small>
    </h1>
    <div class="subheader-block d-lg-flex align-items-center">
        <div class="d-inline-flex flex-column justify-content-center">
        
        </div>
    </div>
</div>
        <!-- Begin Page Content -->
        <div class="container">
          <div class="row">
            <div class="col-lg-12">

            <div class="card mb-4 p-3">
                <div class="card-body">
                    @if(isset($inscricao))
                        <form action='{{ url("inscricao/$inscricao->id") }}' id="form_proposta" method="post" enctype="multipart/form-data">
                        @method('PUT')
                    @else
                        <form action="{{ url('inscricao') }}" id="form_proposta" method="post" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div id="swproposta">
                        <ul class="nav d-flex justify-content-between">
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-1">
                                    Dados Iniciais
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-2">
                                    Detalhamento

                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-3">
                                    Áreas
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-4">
                                    Linhas Extensão
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">

                                <div id="step-1" class="tab-pane" role="tabpanel">
                                    <h4 class="text-secondary">Antes de iniciar sua inscrição leia os critérios necessários</h4>
                                    <ul style="color: #999;">
                                        @foreach($edital->criterios as $criterio)
                                            <li>{{ $criterio->descricao }}</li>
                                        @endforeach
                                    </ul>

                                    <h3 class="text-success">Dados</h3>

                                    <input type="hidden" name="edital_id" value="{{ $edital->id }}" />

                                    <label for="titulo" class="font-weight-bold">Título: </label>
                                    <input type="text" name="titulo" class="form-control w-75" placeholder="Título" required="true" value="@if(isset($inscricao->titulo)){{ $inscricao->titulo }}@else{{ old('titulo') }}@endif" required>
                                    <p style="color: #D0D3D4;">(máx. 255 caracteres)</p>

                                    <label for="tipo_extensao" class="font-weight-bold">Tipo de Extensão: </label>
                                    <select name="tipo_extensao" class="form-control w-25" required="true" required>
                                        <option value="">Selecione ... </option>
                                        <option value="Programa" @if((isset($inscricao->tipo) && $inscricao->tipo == 'Programa') || old('tipo_extensao') == 'Programa') selected @endif>Programa</option>
                                        <option value="Projeto" @if((isset($inscricao->tipo) && $inscricao->tipo == 'Projeto') || old('tipo_extensao') == 'Projeto') selected @endif>Projeto</option>
                                    </select>

                                    <hr class="border-top border-bottom">

                                    <h4 class="text-success">Local do projeto</h4>
                                    <label for="estado" class="font-weight-bold">Estado: </label>
                                    <select name="estado" id="estado" class="form-control w-25 mb-4" required="true" value="{{ old('estado ') }}" required>
                                        <option value="">Selecione ...</option>
                                        @foreach($estados as $estado)
                                            <option value="{{ $estado->uf }}" @if((isset($inscricaoLocal) && $inscricaoLocal[0]->uf == $estado->uf) || old('estado') == $estado->uf) selected @endif>{{ $estado->uf }}</option>
                                        @endforeach
                                    </select>
                                    <label for="cidade" class="font-weight-bold">Cidade: </label>
                                    <select name="cidade" id="cidade" class="form-control w-50" required="true" required>
                                    @if( isset($inscricaoLocal) )
                                        <option value="{{ $inscricao->municipio_id }}">{{ $inscricaoLocal[0]->nome_municipio }}</option>
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

                                    <hr class="border-top border-bottom">

                                    <h4 class="text-success">Há parcerias com outras instituições (públicas ou privadas) para o desenvolvimento do projeto?</h4>
                                    Sim <input type="radio" name="parceria" id="parceria_sim"  value="Sim" @if((isset($inscricao->parceria) && $inscricao->parceria == 'Sim') || old('parceria') == 'Sim') checked @endif required="true">
                                    Não <input type="radio" name="parceria" id="parceria_nao"  value="Não" @if((isset($inscricao->parceria) && $inscricao->parceria == 'Não') || old('parceria') == 'Não') checked @endif required="true">
                                    <br>
                                    <div id="arquivo_parceria" class="@if( (isset($inscricao->parceria) && $inscricao->parceria == 'Sim') || old('parceria') == 'Sim' ) d-block @else d-none @endif">
                                        <label for="comprovante_parceria" class="font-weight-bold">Caso deseje enviar o comprovante da parceria inclua o no campo abaixo: </label>
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
                                                <div class="box-body" id="comprovante-box-body">

                                                    @if(isset($inscricao->anexo_parceria))
                                                    <a href='{{ url("storage/$inscricao->anexo_parceria") }}' class="btn btn-link" target="_blank">
                                                        <img src='{{ url("smartadmin-4.5.1/img/pdf-icon.png") }}' alt="{{ $edital->titulo}}" class="img-thumbnail mb-2" style="max-width: 75px;" />
                                                        <br>
                                                        Arquivo Parceria
                                                    </a>
                                                    @endif

                                                    @if($errors->any())
                                                        <span class="font-weight-bold text-danger" style="font-size: 16px">Favor Inclua o arquivo novamente.</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropzone-wrapper">
                                            <div class="dropzone-desc">
                                                <i class="glyphicon glyphicon-download-alt"></i>
                                                <p class="font-weight-bold">Arraste o comprovante aqui ou clique para selecionar.</p>
                                            </div>
                                            <input type="file" name="comprovante_parceria" class="dropzone" id="comprovante_arquivo" value="{{ old('comprovante_parceria') }}">
                                        </div>
                                        <p class="text-warning font-size-16">O comprovante deve ser no formato PDF</p>
                                    </div>

                                    <hr class="border-top border-bottom">

                                    <h4 class="text-success">Informações do projeto: </h4>

                                    <div class="mb-3">
                                        <div class="mb-4">
                                            <label for="link_lattes" class="font-weight-bold">Link Lattes</label>
                                            <input type="text" name="link_lattes" class="form-control w-75" placeholder="https://seulattes.com" value="@if(isset($inscricao->url_lattes)){{ $inscricao->url_lattes }}@else{{ old('link_lattes') }}@endif" required>
                                            <p style="color: #D0D3D4;">(máx. 255 caracteres)</p>
                                        </div>

                                        <div class="mb-4">
                                            <label for="link_projeto" class="font-weight-bold">Link Projeto</label>
                                            <input type="text" name="link_projeto" class="form-control w-75" placeholder="https://seuprojeto.com" value="@if(isset($inscricao->url_projeto)){{ $inscricao->url_projeto }}@else{{ old('link_projeto') }}@endif" required>
                                            <p style="color: #D0D3D4;">(máx. 255 caracteres)</p>
                                        </div>

                                        <div class="mb-4">
                                            <label for="resumo" class="font-weight-bold">Resumo</label>
                                            <textarea name="resumo" id="resumo" class="form-control" cols="30" rows="5" placeholder="Resumo do seu projeto" maxlength="2500" required>@if(isset($inscricao->resumo)){{ $inscricao->resumo }}@else{{ old('resumo') }}@endif</textarea>
                                            <p style="color: #D0D3D4;">(máx. 2500 caracteres)<span class="caracteres-resumo"></span></p>
                                        </div>

                                        <label for="palavras_chave" class="font-weight-bold">Palavras Chaves</label>
                                        <input type="text" name="palavras_chaves" data-role="tagsinput" value="@if(isset($inscricao->palavras_chaves)){{ $inscricao->palavras_chaves }}@else{{ old('palavras_chaves') }}@endif" required />
                                        <p style="color: #D0D3D4;">Separar as palavras chaves usando vírgula<span class="caracteres-resumo"></span></p>
                                    </div>

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
                                            <div class="box-body" id="projeto-box-body">

                                                @if(isset($inscricao->anexo_projeto))
                                                <a href='{{ url("storage/$inscricao->anexo_projeto") }}' class="btn btn-link" target="_blank">
                                                    <img src='{{ url("smartadmin-4.5.1/img/pdf-icon.png") }}' alt="{{ $edital->titulo}}" class="img-thumbnail mb-2" style="max-width: 75px;" />
                                                    <br>
                                                    Arquivo Projeto
                                                </a>
                                                @endif

                                                @if($errors->any())
                                                    <span class="font-weight-bold text-danger" style="font-size: 16px">Favor Inclua o arquivo novamente.</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropzone-wrapper">
                                        <div class="dropzone-desc">
                                            <i class="glyphicon glyphicon-download-alt"></i>
                                            <p class="font-weight-bold">Arraste o pdf do projeto aqui ou clique para selecionar.</p>

                                        </div>
                                        <input type="file" name="pdf_projeto" class="dropzone" id="projeto_arquivo" value="" @if(isset($inscricao->anexo_projeto)) required="false" @else required="true" @endif value="{{ old('pdf_projeto') }}">

                                    </div>
                                    <p class="text-warning font-size-16">O projeto deve ter no máximo 20 páginas e ser no formato PDF</p>
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel">
                                    <h3 class="text-success">Detalhamento</h3>
                                        <?php $i = 0; ?>
                                        @foreach($edital->questoes as $questao)
                                            <div class="mb-4">
                                            @if($questao->tipo == 'Complementar')
                                                <label for="questao-{{ $questao->id }}" class="text-secondary font-size-16">{{ ($i + 1)  . ' - ' . $questao->enunciado }}</label>
                                                <textarea class="form-control" name="questao-{{ $questao->id }}" id="questao-{{ $questao->id }}" maxlength="10000" cols="30" rows="5" required oninput="contadorCaracteresFaltantes('questao-{{ $questao->id }}')">@if(isset($respostasQuestoes)) {{ $respostasQuestoes[$i]->resposta }}  @else {{ old("questao-$questao->id") }} @endif</textarea>
                                                <span style="color: #D0D3D4;">(máx. 10000 caracteres)<span class="caracteres-questao-{{ $questao->id }}"></span></span>

                                                <?php $i ++; ?>
                                            @endif
                                            </div>
                                        @endforeach
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel">
                                    <h3 class="text-success">Áreas Temáticas</h3>
                                    <h5>Pressione a tecla Ctrl para poder selecionar mais de uma opção</h5>
                                    <select name="areas_tematicas[]" id="areas_tematicas" class="form-control mb-3" style="height: 150px;" multiple required>
                                        @foreach($areas_tematicas as $key => $area_tematica)
                                            <option value="{{ $area_tematica->id }}" @if( (collect(old('areas_tematicas'))->contains($area_tematica->id)) || (isset($inscricao->areas) && $inscricao->areas->contains($area_tematica->id)) ) selected @endif>{{ $area_tematica->nome }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div id="step-4" class="tab-pane" role="tabpanel">
                                    <h3 class="text-success">Linhas de Extensão</h3>
                                    <div class="col-sm-12 row">
                                            <label class="radio-inline d-none" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="">
                                            <input type="radio" name="linha_extensao" value="" data-bv-field="linha_extensao" checked required></label>
                                            <br>
                                            @foreach($linhas_extensao->chunk(2) as $chunked)
                                                <div class="col-md-6">
                                                    @foreach($chunked as $linha_extensao)
                                                        <label class="radio-inline">
                                                            <input type="radio" name="linha_extensao" value="{{ $linha_extensao->id }}" data-bv-field="linha_extensao" @if( old('linha_extensao') == $linha_extensao->id || (isset($inscricao->linha_extensao_id) && $inscricao->linha_extensao_id == $linha_extensao->id) ) checked @endif required>{{ $linha_extensao->nome }}
                                                            <i class="fal fa-comment-alt-lines" data-toggle="tooltip" data-placement="right" title="{{ $linha_extensao->descricao }}" style="color: #2196F3;"></i>
                                                        </label>
                                                        <br>
                                                    @endforeach
                                                </div>
                                            @endforeach

                                    </div>
                                </div>


                        </div>

                    </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
        <!-- Modal center -->
        <div class="modal fade" id="aviso-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Aviso
                            <small class="m-0 text-muted">
                                Importante
                            </small>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Olá, Gostaríamos de te passar algumas dicas importantes para o preenchimento do formulário.</p>
                        <ul>
                            <li>Antes de iniciar o preenchimento prepare um arquivo com os textos que são muito longos, 
                                dessa forma durante o preenchimento você somente copia e cola esses textos, 
                                caso venha ocorrer algum erro você não terá que redigir novamente.</li> 
                            <li>Se você deseja iniciar o preenchimento do formulário e terminar posteriormente, no detalhamento insira um texto simples para cada pergunta e clique em <strong>Salvar</strong>.</li>
                            <li>Após o primeiro formulário você será redirecionado para a sessão do orçamento, caso não deseje preencher no momento clique em <strong>Salvar</strong>.</li>
                            <li>Você será redirecionado para um página exibindo sua inscrição salva, nessa página você encontrará os botões que lhe permitirá editar, alterar o orçamento e submeter.</li>
                            <li>A sua inscrição só será válida após a submissão</li>
                        </ul>                        

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
