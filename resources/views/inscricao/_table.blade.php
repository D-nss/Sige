<table class="table table-bordered table-hover" id="dt-propostas" style="width: 100%">
    <thead>
        <tr>
            <th>Edital</th>
            <th>Inscrição</th>
            <th>Coordenador</th>
            <th>Status</th>
            <th>Pendentes</th>
            <th>Relatorio Final</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inscricoes as $inscricao)
            @if( strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_org_tematica', $inscricao->edital_id)) )
            <tr>
                <td>{{ $inscricao->edital->titulo }}</td>
                <td>{{ $inscricao->titulo }}</td>
                <td>{{ $inscricao->user->name}}</td>
                <td>{{ $inscricao->status }}</td>
                <td>
                    @if($inscricao->edital->tipo === 'PEX')
                        @include('inscricao._botoes_pex')
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