<div class="">
    <a href='{{ url("inscricao/$inscricao->id") }}' class="btn btn-info btn-xs m-1"><i class="far fa-eye"></i> Ver</a>
    <a href='{{ url("storage/$inscricao->anexo_projeto") }}' target="_blank" class="btn btn-danger btn-xs m-1"><i class="far fa-pdf"></i> Ver PDF</a>
    
    @if($user->hasAnyRole('admin','super','edital-administrador') || ( $inscricao->atribuicao == 'Sub Comissão' && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_org_tematica', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_org_tematica', $inscricao->edital_id))))
        @if($inscricao->status == 'Submetido')
            <a href='{{ url("inscricao/$inscricao->id/?tipo_avaliacao=subcomissao") }}' class="btn btn-warning btn-xs m-1">Análise</a>
        @endif
        @if($inscricao->status == 'Deferido')
            <a href='{{ url("inscricao/$inscricao->id/avaliadores") }}' class="btn btn-info btn-xs m-1">Pareceristas</a>
        @endif
    @endif
    @if($user->hasAnyRole('admin','super','edital-administrador') || ( strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_pareceristas', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_pareceristas', $inscricao->edital_id))))
        
            <a href='{{ url("inscricao/$inscricao->id/?tipo_avaliacao=parecerista") }}' class="btn btn-success btn-xs m-1">Parecer</a>

    @endif
    @if( isset($inscricao->recurso->status) && $inscricao->recurso->status == 'Aceito' && ( strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_recurso', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_recurso', $inscricao->edital_id))) )
        
        <a href='{{ url("inscricao/$inscricao->id/?tipo_avaliacao=parecerista") }}' class="btn btn-success btn-xs m-1">Parecer</a>
       
    @endif
    @if($user->hasAnyRole('edital-administrador') && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_org_tematica', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_org_tematica', $inscricao->edital_id)))
        @if($inscricao->status == 'Submetido')    
            <a href='{{ url("inscricao/$inscricao->id/indicar-analista") }}' class="btn btn-secondary btn-xs m-1">Indicar Analista</a>
        @endif
    @endif
    @if($inscricao->recurso)
        <a href='{{ url("inscricao/$inscricao->id/recurso") }}' class="btn btn-secondary btn-xs m-1">
            Recurso
        </a>
    @endif
    @if( $inscricao->status == 'Contemplado' && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_fim_execucao', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_fim_relatorio', $inscricao->edital_id) )
        <a href='{{ url("inscricao/relatorio_final/$inscricao->id") }}' class="btn btn-outline-info btn-xs m-1">
            Relatório Final
        </a>
    @endif
    @if( $user->hasAnyRole('edital-administrador') && $inscricao->status == 'Avaliado' && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_termino_recurso', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_resultado', $inscricao->edital_id)) )
    <button type="button" class="btn btn-success  btn-xs my-1 my-1" data-toggle="modal" data-target="#default-example-modal-sm-center"><i class="far fa-dollar-sign"></i> Contemplar</button>
    <!-- Modal center Small -->
    <div class="modal fade" id="default-example-modal-sm-center" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contemplação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <form action='{{ url("inscricao/$inscricao->id/contemplar") }}' method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="panel-tag">
                            <span class="font-weight-bold">Inscrição: {{ $inscricao->titulo }}</span>
                            <br>
                            <small>Coordenador: {{ $inscricao->user->name }}</small>
                        </div>
                        <label class="form-label" for="contemplacao">Porcentagem da contenplação</label>
                        @if($inscricao->qtde_contemplacao)
                            {{ $inscricao->qtde_contemplacao }}
                        @else
                            <input type="text" class="form-control" name="contemplacao" id="contemplacao" required>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success my-1 font-weight-bold">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
