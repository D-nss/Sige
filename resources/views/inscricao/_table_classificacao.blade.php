<table class="table table-bordered table-hover" id="dt-classificados" style="width: 100%">
    <thead>
        <tr>
            <th>Edital</th>
            <th>Inscrição</th>
            <th>Linha de Extenção</th>
            <th>Tipo</th>
            <th>Coordenador</th>
            <th>Unidade</th>
            <th>Sub-Comissão</th>
            <th>Nota Final</th>
            <th>Valor Solicitado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inscricoes as $inscricao)
            <tr>
            <td><h5 class="fw-400 text-secondary">{{ $inscricao->edital->titulo }}</h5></td>
                <td><h3 class="fw-700 text-primary">{{ $inscricao->titulo }}</h3></td>
                <td><small class="font-italic font-color-light">Linhas de Extensão: {{ $inscricao->linha_extensao->nome}}</small></td>
                <td><h6 class="text-secondary">{{ $inscricao->tipo}}</h6></td>
                <td><h6 class="text-secondary">{{ $inscricao->user->name}}</h6></td>
                <td><h6 class="font-italic font-color-light">{{ $inscricao->unidade->sigla}}</h6></td>
                <td><h6 class="font-italic font-color-light">{{ isset($inscricao->subcomissao[0]) ? $inscricao->subcomissao[0]->nome : '' }}</h6></td>
                <td><span class="badge badge-success badge-pill">{{ $inscricao->nota }}</span></td>
                <td>R$ {{ number_format($inscricao->orcamento->sum('valor'), 2, ',', '.') }}</td>
            </tr>
            
        @endforeach
    </tbody>
</table>