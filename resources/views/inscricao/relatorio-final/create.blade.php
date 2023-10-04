@extends('layouts.app')

@section('title', 'Cadastrar Relatório Final')

@section('content')
<ol class="breadcrumb page-breadcrumb">
    <li class="breadcrumb-item"><a href="javascript:void(0);">EXTECULT</a></li>
    <li class="breadcrumb-item">Inscrição</li>
    <li class="breadcrumb-item active">Relatório Final</li>
    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
    <h1 class="subheader-title">
        <span class="text-success"><i class='subheader-icon fal fa-book'></i>Relatório Final</span>
        <small>
            Cadastro do relatório final
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
<div class="container-fluid">
    <div class="col-md-12">
        @if(
            isset($inscricao->arquivo_relatorio) 
            && 
            !is_null($inscricao->execucao_inicio) 
            && 
            !is_null($inscricao->execucao_fim) 
            && 
            $inscricao->participantes->count() > 0 
            && 
            isset($inscricao->total_orcamento_realizado) 
            && 
            isset($inscricao->justificativa_orcamento_realizado) 
            && 
            isset($inscricao->arquivo_prestacao_contas)
        )
        <div class="alert alert-warning d-flex justify-content-between align-items-center fs-lg">
            <span>
                Seu relatório final está com todas as fases preenchidas, certifique-se de que está tudo correto e envie para aprovação.
            </span>
            <form action="{{route('edital.relatorio-final.enviar_aprovacao', ['inscricao' => $inscricao])}}" method="post">
                @csrf
                <button type="submit" class="btn btn-warning">Enviar</button>
            </form>
        </div>
        @endif
        <div class="row mb-3">
            <div class="col-md-4 text-center">
                <div class="badge-pill 
                    @if(isset($inscricao->arquivo_relatorio)) 
                        badge-success 
                    @else 
                        badge-secondary
                    @endif 
                    p-2 fs-xl my-1" id="step1">
                    Dados 
                    @if(isset($inscricao->arquivo_relatorio))
                        <i class="far fa-check"></i>
                    @endif
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="badge-pill 
                    @if($inscricao->participantes->count() > 0)
                        badge-success 
                    @else 
                        badge-secondary
                    @endif 
                    p-2 fs-xl my-1 opacity-50" id="step2">
                    Participantes
                    @if($inscricao->participantes->count() > 0)
                        <i class="far fa-check"></i>
                    @endif
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="badge-pill
                    @if(isset($inscricao->total_orcamento_realizado) && isset($inscricao->justificativa_orcamento_realizado) && isset($inscricao->arquivo_prestacao_contas))
                        badge-success 
                    @else 
                        badge-secondary
                    @endif
                    p-2 fs-xl my-1 opacity-50" id="step3">
                    Orçamento
                    @if(isset($inscricao->total_orcamento_realizado) && isset($inscricao->justificativa_orcamento_realizado) && isset($inscricao->arquivo_prestacao_contas))
                        <i class="far fa-check"></i>
                    @endif
                </div>
            </div>
        </div>
        <div class="card row">
            <div class="card-body" id="div1">
                <label for="arquivo_relatorio" class="fw-500 fs-xl text-success">Dados Iniciais </label>
                <div class="row">
                    
                    <div class="col-sm-4">
                        <div class="col-12">
                            <div class="p-0">
                                <h5>
                                Título
                                    <small class="mt-0 mb-3 text-primary">
                                    {{ $inscricao->titulo }}
                                    </small>
                                </h5>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-0">
                                <h5>
                                Coordenador
                                    <small class="mt-0 mb-3">
                                    {{ $inscricao->user->name }}
                                    </small>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="col-12">
                            <div class="p-0">
                                <h5>
                                Período de Realização
                                    <form action="{{ route('edital.relatorio-final.execucao',['inscricao' => $inscricao])}}" method="post">
                                        @csrf
                                        <label for="execucao_inicio" class="fs-sm">Inicio Execução</label>
                                        <input type="date" class="form-control mb-2" name="execucao_inicio" id="execucao_inicio" @if(!is_null($inscricao->execucao_inicio)) value="{{$inscricao->execucao_inicio->format('Y-m-d')}}" @endif>
                                        <label for="execucao_fim" class="fs-sm">Fim Execução</label>
                                        <input type="date" class="form-control mb-2" name="execucao_fim" id="execucao_fim" @if(!is_null($inscricao->execucao_fim)) value="{{$inscricao->execucao_fim->format('Y-m-d')}}" @endif>
                                        <button id="btn-cad-execucao" class="btn btn-sm btn-success">Incluir</button>
                                    </form>
                                </h5>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-0">
                                <h5>
                                Estado
                                    <small class="mt-0 mb-3">
                                    {{ $inscricao->municipio->estado }}
                                    </small>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="row pt-3">
                    <div class="col-md-12">
                        <form action="{{ route('edital.relatorio-final.upload', ['inscricao' => $inscricao]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="arquivo_relatorio" class="fw-500 fs-xl text-success">Resultados e conclusão </label>
                            <p>Fazer o upload do arquivo dos resultados e da conclusão, o arquivo deve ter no máximo 20 páginas.</p>
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
                                    <div class="box-body" id="relatorio-box-body">
                                        @if(isset($inscricao->arquivo_relatorio))
                                            <a href='{{ url("storage/$inscricao->arquivo_relatorio") }}' class="btn btn-link" target="_blank">
                                                <img src='{{ url("smartadmin-4.5.1/img/pdf-icon.png") }}' alt="Resultados e Conclusões" class="img-thumbnail mb-2" style="max-width: 75px;" />
                                                <br>
                                                Resultados e Conclusões
                                            </a>
                                        @endif

                                        @if(old('arquivo_relatorio') )
                                            <span class="font-weight-bold text-danger" style="font-size: 16px">Favor Inclua o arquivo novamente.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="dropzone-wrapper">
                                <div class="dropzone-desc">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                    <p class="font-weight-bold">Arraste o comprovante aqui ou clique para selecionar.</p>
                                    <p id="alert-pdf-format"></p>
                                </div>
                                <input type="file" name="arquivo_relatorio" class="dropzone" id="arquivo_relatorio" value="{{ old('arquivo_relatorio') }}">
                            </div>
                            <p class="text-muted">O arquivo deve ser no formato PDF e ter 5MB de tamanho</p>
                            <button class="btn btn-success" type="submit">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body d-none" id="div2">
                <h3 class="fw-500 fs-xl text-success">Participantes</h3>
                <div class="col-md-2">
                    <button class="btn btn-success" type="button"  data-toggle="modal" data-target="#adicionar-participantes">Adicionar</button>
                </div>
                <!-- Modal Large -->
                <div class="modal fade" id="adicionar-participantes" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{ route('edital.relatorio-final.participantes',['inscricao' => $inscricao]) }}" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title">Adicionar Participante</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    <div class="col-md-8 mb-2">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" name="nome" placeholder="Digite o nome completo ...">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label for="categoria" class="form-label">Categoria</label>
                                        <input type="text" class="form-control" name="categoria" placeholder="Digite a categoria ...">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label for="ra" class="form-label">RA</label>
                                        <input type="text" class="form-control" name="ra" placeholder="Digite o ra ...">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label for="unidade" class="form-label">Unidade</label>
                                        <input type="text" class="form-control" name="unidade" placeholder="Digite a categoria ...">
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label for="instituicao" class="form-label">Instituição</label>
                                        <input type="text" class="form-control" name="instiruicao" placeholder="Digite a instituição ...">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label for="carga_semanal" class="form-label">Carga Semanal</label>
                                        <input type="number" class="form-control" name="carga_semanal" placeholder="0 ...">
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label for="carga_total" class="form-label">Carga Total</label>
                                        <input type="number" class="form-control" name="carga_total" placeholder="0 ...">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped mt-4">
                        <thead class="thead-light ">
                            <tr>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>RA</th>
                                <th>Unidade</th>
                                <th>Instituição</th>
                                <th>Carga Semanal</th>
                                <th>Carga Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inscricao->participantes as $participante)
                            <tr>
                                <td>{{ $participante->nome }}</td>
                                <td>{{ $participante->categoria }}</td>
                                <td>{{ $participante->ra }}</td>
                                <td>{{ $participante->unidade }}</td>
                                <td>{{ $participante->instituicao }}</td>
                                <td>{{ $participante->carga_semanal }}</td>
                                <td>{{ $participante->carga_total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-body d-none" id="div3">
                <h3 class="fw-500 fs-xl text-success">Orçamento</h3>
                <div class="col-12">
                    <div class="p-0">
                        <h5>
                        Total Orçado
                            <small class="mt-0 mb-3 text-primary">
                            R$ {{ number_format($inscricao->orcamento->sum('valor'), 2, ',', '.' )}}
                            </small>
                        </h5>
                    </div>
                </div>
                <form action="{{ route('edital.relatorio-final.despesas', ['inscricao' => $inscricao]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-4">
                        <label for="total_orcamento_realizado">Total Orçamento Realizado</label>
                        <input type="text" name="total_orcamento_realizado" id="total_orcamento_realizado" class="form-control" placeholder="00.000,00"  value="{{ isset($inscricao->total_orcamento_realizado) ? number_format($inscricao->total_orcamento_realizado, 2, ',', '.') : old('despesas_realizadas')}}">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="justificativa_orcamento_realizado">Justificativa do Orçamento realizado</label>
                        <textarea name="justificativa_orcamento_realizado" rows="6" class="form-control">{{ isset($inscricao->justificativa_orcamento_realizado) ? $inscricao->justificativa_orcamento_realizado : old('justificativa_orcamento_realizado') }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="arquivo_comprovante" class="fw-500 fs-xl text-success">Comprovante</label>
                        <p>Fazer o upload do arquivo da prestação de contas junto a funcamp.</p>
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
                                    @if(isset($inscricao->arquivo_prestacao_contas))
                                            <a href='{{ url("storage/$inscricao->arquivo_prestacao_contas") }}' class="btn btn-link" target="_blank">
                                                <img src='{{ url("smartadmin-4.5.1/img/pdf-icon.png") }}' alt="Comprovantes" class="img-thumbnail mb-2" style="max-width: 75px;" />
                                                <br>
                                                Comprovante
                                            </a>
                                        @endif

                                        @if(old('arquivo_comprovante') )
                                            <span class="font-weight-bold text-danger" style="font-size: 16px">Favor Inclua o arquivo novamente.</span>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="dropzone-wrapper">
                            <div class="dropzone-desc">
                                <i class="glyphicon glyphicon-download-alt"></i>
                                <p class="font-weight-bold">Arraste o comprovante aqui ou clique para selecionar.</p>
                                <p id="alert-pdf-format"></p>
                            </div>
                            <input type="file" name="arquivo_comprovante" class="dropzone" id="arquivo_comprovante" value="{{ old('arquivo_comprovante') }}">
                        </div>
                        <p class="text-muted">O arquivo deve ser no formato PDF e ter 5MB de tamanho</p>
                        <button class="btn btn-success" type="submit">Enviar</button>
                    </div>
                </form>
                <div class="mt-3" style="width: 160px">
                    <div class="p-0">
                        <h6 class="bg-warning-200 p-3">
                        Saldo
                            <small class="mt-0 mb-1 fs-xl">
                            R$ {{ number_format($inscricao->orcamento->sum('valor') - $inscricao->total_orcamento_realizado, 2, ',', '.') }}
                            </small>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center mb-2">
                    <button class="btn btn-info" id="btn-anterior"><i class="far fa-angle-left"></i> Anterior</button>
                    <button class="btn btn-info" id="btn-proximo">Próximo <i class="far fa-angle-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection