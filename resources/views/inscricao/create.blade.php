@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Inscrição</h1>
        <!-- Begin Page Content -->
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
                
            @include('layouts._includes._status')

            @include('layouts._includes._validacao')

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
                                    Dados
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-2">
                                    Áreas
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-3">
                                    Linhas de Extensão
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-4">
                                    Questões
                                </a>
                            </li>
                        </ul>
                       
                        <div class="tab-content mt-3">
                            
                                <div id="step-1" class="tab-pane" role="tabpanel">
                                    <h3 class="text-success">Dados</h3>
                                    <p style="color: #999;">
                                        @foreach($edital->criterios as $criterio)
                                            {{ $criterio->descricao . '; '}} 
                                        @endforeach
                                    </p>

                                    <input type="hidden" name="edital_id" value="{{ $edital->id }}" />

                                    <label for="titulo" class="font-weight-bold">Título: </label>
                                    <input type="text" name="titulo" class="form-control w-75" placeholder="Título" required="true" value="@if(isset($inscricao->titulo)) {{ $inscricao->titulo }}  @else {{ old('titulo') }} @endif" required>
                                    <p style="color: #D0D3D4;">(máx. 100 caracteres)</p>

                                    <label for="tipo_extensao" class="font-weight-bold">Tipo de Extensão: </label>
                                    <select name="tipo_extensao" class="form-control w-25" required="true" value="{{ old('tipo_extensao') }}" required>
                                        <option value="">Selecione ... </option>
                                        <option value="Programa" @if(isset($inscricao->tipo) && $inscricao->tipo == 'Programa') selected @endif>Programa</option>
                                        <option value="Projeto" @if(isset($inscricao->tipo) && $inscricao->tipo == 'Projeto') selected @endif>Projeto</option>
                                    </select>

                                    <hr class="border-top border-bottom">

                                    <h4 class="text-success">Local do projeto</h4>
                                    <label for="estado" class="font-weight-bold">Estado: </label>
                                    <select name="estado" id="estado" class="form-control w-25 mb-4" required="true" value="{{ old('estado ') }}" required>
                                        <option value="">Selecione ...</option>
                                        @foreach($estados as $estado)
                                            <option value="{{ $estado->uf }}" @if(isset($inscricaoLocal) && $inscricaoLocal[0]->uf == $estado->uf) selected @endif>{{ $estado->uf }}</option>
                                        @endforeach
                                    </select>
                                    <label for="cidade" class="font-weight-bold">Cidade: </label>
                                    <select name="cidade" id="cidade" class="form-control w-50" required="true" value="{{ old('cidade') }}" required>
                                    @if( isset($inscricaoLocal) ) 
                                        <option value="{{ $inscricao->municipio_id }}">{{ $inscricaoLocal[0]->nome_municipio }}</option>
                                    @endif
                                    </select> 

                                    <hr class="border-top border-bottom">

                                    <h4 class="text-success">Há parcerias com outras instituições (públicas ou privadas) para o desenvolvimento do projeto?</h4>
                                    Sim <input type="radio" name="parceria" id="parcerias_sim"  value="Sim" @if(isset($inscricao->parceria) && $inscricao->parceria == 'Sim') checked @endif required="true">
                                    Não <input type="radio" name="parceria" id="parcerias_nao"  value="Não" @if(isset($inscricao->parceria) && $inscricao->parceria == 'Não') checked @endif required="true">
                                    <br>
                                    <div id="arquivo_parceria" class="@if(isset($inscricao->anexo_parceria)) d-block @else d-none @endif">
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
                                        <label for="link_lattes" class="font-weight-bold">Link Lattes</label>
                                        <input type="text" name="link_lattes" class="form-control w-75 mb-4" placeholder="https://seulattes.com" value="@if(isset($inscricao->link_lattes)) {{ $inscricao->link_lattes }} @else {{ old('link_lattes') }} @endif" required>

                                        <label for="link_projeto" class="font-weight-bold">Link Projeto</label>
                                        <input type="text" name="link_projeto" class="form-control w-75 mb-4" placeholder="https://seuprojeto.com" value="@if(isset($inscricao->link_projeto)) {{ $inscricao->link_projeto }} @else {{ old('link_projeto') }} @endif" required>

                                        <label for="resumo" class="font-weight-bold">Resumo</label>
                                        <textarea name="resumo" class="form-control mb-4" cols="30" rows="5" placeholder="Resumo do seu projeto" required>@if(isset($inscricao->resumo)) {{ $inscricao->resumo }} @else {{ old('resumo') }} @endif</textarea>

                                        <label for="palavras_chave" class="font-weight-bold">Palavras Chaves</label>
                                        <input type="text" name="palavras_chaves" data-role="tagsinput" value="@if(isset($inscricao->palavras_chaves)) {{ $inscricao->palavras_chaves }} @else {{ old('palavras_chaves') }} @endif" required />
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
                                    <p class="text-warning font-size-16">O projeto deve ter no mínimo 20 páginas e ser no formato PDF</p>
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel">
                                    <h3 class="text-success">Áreas Temáticas</h3>
                                    <h5>Pressione a tecla Ctrl para poder selecionar mais de uma opção</h5>
                                    <select name="areas_tematicas[]" class="form-control mb-3" style="height: 150px;" multiple required>
                                        <?php $j = 0; ?>
                                        @foreach($areas_tematicas as $area_tematica)
                                            <option value="{{ $area_tematica->id }}" @if(old('areas_tematicas') == '{{ $area_tematica->id }}' || (isset($inscricao->areas) && $inscricao->areas->contains($area_tematica->id))) selected @endif>{{ $area_tematica->nome }}</option>
                                            <?php $j++; ?>
                                        @endforeach
                                            <!-- <option value="2" @if(old('areas_tematicas') == '2') selected @endif>Cultura</option>
                                        <option value="3" @if(old('areas_tematicas') == '3') selected @endif>Direitos Humanos e Justiça</option>
                                        <option value="4" @if(old('areas_tematicas') == '4') selected @endif>Educação</option>
                                        <option value="5" @if(old('areas_tematicas') == '5') selected @endif>Meio Ambiente</option>
                                        <option value="6" @if(old('areas_tematicas') == '6') selected @endif>Saúde</option>
                                        <option value="7" @if(old('areas_tematicas') == '7') selected @endif>Tecnologia e Produção</option>
                                        <option value="8" @if(old('areas_tematicas') == '8') selected @endif>Trabalho</option> -->
                                    </select>

                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel">
                                    <h3 class="text-success">Linhas de Extensão</h3>
                                    <div class="col-sm-12 row">
                                        
                                            @foreach($linhas_extensao->chunk(2) as $chunked)
                                                <div class="col-md-6">
                                                    @foreach($chunked as $linha_extensao)
                                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{ $linha_extensao->descricao }}">
                                                        <input type="radio" name="linha_extensao" value="{{ $linha_extensao->id }}" data-bv-field="linha_extensao" @if( old('linha_extensao') == $linha_extensao->id || (isset($inscricao->linha_extensao_id) && $inscricao->linha_extensao_id == $linha_extensao->id) ) checked @endif required>{{ $linha_extensao->nome }}</label>
                                                        <br>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                           
                                    </div>  
                                </div>
                                <div id="step-4" class="tab-pane" role="tabpanel">
                                    <h3 class="text-success">Questões (Máx. 450 caracteres)</h3>
                                    <div>
                                        <?php $i = 0; ?>
                                        @foreach($edital->questoes as $questao)
                                            @if($questao->tipo == 'Proposta')
                                                <label for="questao-{{ $questao->id }}" class="text-secondary font-size-16">{{ ($i + 1)  . ' - ' . $questao->enunciado }}</label>
                                                <textarea class="form-control  mb-3" name="questao-{{ $questao->id }}" cols="30" rows="5" required>@if(isset($respostasQuestoes)) {{ $respostasQuestoes[$i]->resposta }}  @else {{ old("questao-$questao->id") }} @endif</textarea>
                                                <?php $i ++; ?>
                                            @endif
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

@endsection