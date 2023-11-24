<table class="table" id="dt-propostas" style="width: 100%">
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
            
            <tr>
                <td>
                    <div class="d-flex flex-column">
                        <span class="fw-700 text-primary fs-xl">
                            {{ $inscricao->titulo }} 
                        </span>
                        <span class="text-muted fw-200">Tipo: {{ $inscricao->tipo}}</span>
                        <small class="text-muted fw-200">Linhas de Extensão: {{ isset($inscricao->linha_extensao->nome) ? $inscricao->linha_extensao->nome : '' }}</small>
                    </div>
                </td>
                <td>
                    <div class="d-flex flex-column">
                        <span class="text-dark">{{ $inscricao->user->name}}</span>
                        <small class="text-muted fw-200">Unidade: {{ $inscricao->unidade->sigla}}</small>
                    </div>  
                </td>
                <td>
                    @if( strtotime(date('Y-m-d')) < strtotime($cronograma->getDate('dt_divulgacao_previa', $inscricao->edital_id)) && ($inscricao->status == 'Indeferido' || $inscricao->status == 'Deferido') )
                        <span class="badge badge-warning badge-pill p-2">
                            Em Análise
                        </span>
                    @else
                        <span class="badge badge-{{ $status[$inscricao->status] }} badge-pill p-2">
                            {{ $inscricao->status }}
                        </span>
                    @endif
                </td>
                <td>

                    @if($inscricao->edital->tipo === 'PEX')
                        @include('inscricao._botoes_pex')
                    @endif
                    @if($inscricao->edital->tipo === 'Saberes Indígenas')
                        @include('inscricao._botoes_pex')
                    @endif
                    @if($inscricao->edital->tipo === 'Fluxo Contínuo')
                        @include('inscricao._botoes_fc')
                    @endif
                    @if($inscricao->edital->tipo === 'Colégios')
                        @include('inscricao._botoes_pex')
                    @endif
                    @if($inscricao->edital->tipo === 'Cultura')
                        @include('inscricao._botoes_pex')
                    @endif
                    @if($inscricao->edital->tipo === 'EAD')
                        @include('inscricao._botoes_pex')
                    @endif
                    @if($inscricao->edital->tipo === 'Inovação e Empreendedorismo')
                        @include('inscricao._botoes_pex')
                    @endif
                    @if($inscricao->edital->tipo === 'Acoes Afirmativas')
                        @include('inscricao._botoes_af')
                    @endif
                    @if($inscricao->recurso)
                        <!-- <a href='{{ url("recurso/$inscricao->id") }}' class="btn btn-warning btn-xs mt-1"><i class="far fa-list"></i> Recurso</a> -->
                    @endif
                           
                </td>
                <td>
                    <!-- <div class="">
                        <a href="" class="btn btn-success btn-sm m-1">Parecer Final</a>
                        <a href="" class="btn btn-warning btn-sm m-1">Ver Relatório</a>
                        <a href="" class="btn btn-danger btn-sm m-1">Relatório em PDF</a>
                    </div> -->
                </td>
            
        @endforeach
    </tbody>
</table>