<table class="table table-bordered table-striped table-hover" id="dt-propostas">
    <thead>
        <tr>
            <th>Inscrição</th>
            <th>Coordenador</th>
            <th>Status</th>
            <th>Pendentes</th>
            <th>Relatorio Final</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inscricoes as $inscricao)
            @if( strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_org_tematica', $inscricao->edital_id)))
            <tr>
                <td>{{ $inscricao->titulo }}</td>
                <td>{{ $inscricao->user->name}}</td>
                <td>{{ $inscricao->status }}</td>
                <td>
                    <a href='{{ url("storage/$inscricao->anexo_projeto") }}' target="_blank" class="btn btn-danger btn-sm m-1">Ver PDF</a>
                    @if($user->hasRole('analista|super') && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_org_tematica', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_org_tematica', $inscricao->edital_id)))
                        <a href='{{ url("inscricao/$inscricao->id/?analise=true") }}' class="btn btn-warning btn-sm m-1">Análise</a>
                    @endif
                    @if($user->hasRole('avaliador|super') && $inscricao->status == 'Deferido' && strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_pareceristas', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_pareceristas', $inscricao->edital_id)))
                        <a href='{{ url("inscricao/$inscricao->id/?avaliacao=true") }}' class="btn btn-success btn-sm m-1">Avaliar</a>
                    @endif
                </td>
                <td>
                    <!-- <div class="">
                        <a href="" class="btn btn-success btn-sm m-1">Parecer Final</a>
                        <a href="" class="btn btn-warning btn-sm m-1">Ver Relatório</a>
                        <a href="" class="btn btn-danger btn-sm m-1">Relatório em PDF</a>
                    </div> -->
                </td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>