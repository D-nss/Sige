<div class="">
    @if($user->hasAnyRole('super','edital-administrador'))
        <a href='{{ url("inscricao/show-completo/$inscricao->id") }}' class="btn btn-info btn-xs m-1">
            <i class="far fa-eye"></i> 
            Visualização completa
        </a>
    @else
        <div class="d-flex">
            <a href='{{ url("inscricao/$inscricao->id") }}' class="btn btn-info btn-xs m-1"><i class="far fa-eye"></i> Ver</a>
            @if($inscricao->status == 'Relatório em Análise')
                <span class="fw-300 color-dark-500"><i class="fal fa-exclamation-circle"></i><i> Análise pendente! Acesse aqui.</i></span>
            @endif
        </div>
    @endif
    <a href='{{ url("storage/$inscricao->anexo_projeto") }}' target="_blank" class="btn btn-danger btn-xs m-1"><i class="far fa-pdf"></i> Ver PDF</a>
    
    @if( $user->hasAnyRole('super','edital-administrador') || $userNaComissao )
        @if($inscricao->status == 'Submetido')
            <a href='{{ url("inscricao/$inscricao->id/?tipo_avaliacao=subcomissao") }}' class="btn btn-warning btn-xs m-1">Análise</a>
        @endif
        @if($inscricao->status == 'Deferido')
            <a href='{{ url("inscricao/$inscricao->id/avaliadores") }}' class="btn btn-info btn-xs m-1">Pareceristas</a>
        @endif
    @endif
    @if( $avaliadorPorInscricao && $inscricao->respostas_avaliacoes->count() == 0)
        <a href='{{ url("inscricao/$inscricao->id/?tipo_avaliacao=parecerista") }}' class="btn btn-success btn-xs m-1">Parecer</a>
    @endif
    @if( $user->hasAnyRole('edital-administrador') && $inscricao->status == 'Avaliado' )
    <button type="button" class="btn btn-success btn-xs my-1" data-toggle="modal" data-target="#default-example-modal-sm-center"><i class="far fa-dollar-sign"></i> Contemplar</button>
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