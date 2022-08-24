<div class="">
    <a href='{{ url("inscricao/$inscricao->id") }}' class="btn btn-info btn-xs m-1"><i class="far fa-eye"></i> Ver</a>
    <a href='{{ url("storage/$inscricao->anexo_projeto") }}' target="_blank" class="btn btn-danger btn-xs m-1"><i class="far fa-pdf"></i> Ver PDF</a>
    {{ $inscricao->avaliadores->where('id', '==', $user->id)->count() }}
    @if($user->hasAnyRole('admin','super','edital-administrador') || ( $inscricao->atribuicao == 'Sub Comissão' && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_org_tematica', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_org_tematica', $inscricao->edital_id))))
        @if($inscricao->status == 'Submetido')
            <a href='{{ url("inscricao/$inscricao->id/?tipo_avaliacao=subcomissao") }}' class="btn btn-warning btn-xs m-1">Análise</a>
        @endif
        @if($inscricao->status == 'Deferido')
            <a href='{{ url("inscricao/$inscricao->id/avaliadores") }}' class="btn btn-info btn-xs m-1">Pareceristas</a>
        @endif
    @endif
    @if($user->hasAnyRole('admin','super','edital-administrador') || ( $inscricao->status == 'Deferido' && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_pareceristas', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_pareceristas', $inscricao->edital_id))))
        @if($inscricao->respostas_avaliacoes->where('id', '==', $user->id)->count() == 0 && $inscricao->status == 'Deferido')
            <a href='{{ url("inscricao/$inscricao->id/?tipo_avaliacao=parecerista") }}' class="btn btn-success btn-xs m-1">Parecer</a>

        @endif
    @endif
    @if($user->hasAnyRole('edital-administrador') && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_org_tematica', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_org_tematica', $inscricao->edital_id)))
        @if($inscricao->status == 'Submetido')    
            <a href='{{ url("inscricao/$inscricao->id/indicar-analista") }}' class="btn btn-secondary btn-xs m-1">Indicar Analista</a>
        @endif
    @endif
</div>
