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
            
            <tr>
                <td><h5 class="fw-400 text-secondary">{{ $inscricao->edital->titulo }}</h5></td>
                <td><h3 class="fw-700 text-primary">{{ $inscricao->titulo }}</h3><small class="font-italic font-color-light">Linhas de Extensão: {{ $inscricao->linha_extensao->nome}}</small></td>
                <td><h6 class="text-secondary">{{ $inscricao->user->name}}</h6><small class="font-italic font-color-light">Unidade: {{ $inscricao->unidade->sigla}}</small></td>
                <td><span class="badge badge-{{ $status[$inscricao->status] }} badge-pill">{{ $inscricao->status }}</span></td>
                <td>

                    @if($inscricao->edital->tipo === 'PEX')
                        @include('inscricao._botoes_pex')
                    @endif
                    @if($inscricao->edital->tipo === 'PRP')
                        @include('inscricao._botoes_prp')
                    @endif
                    @if($inscricao->recurso)
                        <a href='{{ url("recurso/$inscricao->id") }}' class="btn btn-warning btn-xs mt-1"><i class="far fa-list"></i> Recurso</a>
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
            
        @endforeach
    </tbody>
</table>