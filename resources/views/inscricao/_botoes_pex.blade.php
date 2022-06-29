<div class="">
    <a href='{{ url("inscricao/$inscricao->id") }}' class="btn btn-info btn-xs"><i class="far fa-eye"></i> Ver</a>
    <a href='{{ url("storage/$inscricao->anexo_projeto") }}' target="_blank" class="btn btn-danger btn-xs"><i class="far fa-pdf"></i> Ver PDF</a>
    
    @if($user->hasAnyRole('edital-analista','super','edital-administrador') && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_org_tematica', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_org_tematica', $inscricao->edital_id)))
        <a href='{{ url("inscricao/$inscricao->id/?analise=true") }}' class="btn btn-warning btn-xs">Análise</a>
        @if($inscricao->status == 'Deferido')
            <a href='{{ url("inscricao/$inscricao->id/avaliadores") }}' class="btn btn-info btn-xs">Avaliadores</a>
        @endif
    @endif
    @if($user->hasAnyRole('edital-avaliador','super','edital-administrador') && $inscricao->status == 'Deferido' && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_pareceristas', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_pareceristas', $inscricao->edital_id)))
        <a href='{{ url("inscricao/$inscricao->id/?avaliacao=true") }}' class="btn btn-success btn-xs">Avaliar</a>
    @endif
    @if($user->hasAnyRole('edital-administrador') && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_org_tematica', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_org_tematica', $inscricao->edital_id)))
        <a href='{{ url("inscricao/$inscricao->id/indicar-analista") }}' class="btn btn-secondary btn-xs">Indicar Analista</a>
    @endif
</div>