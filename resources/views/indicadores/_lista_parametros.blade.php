<ul class="list-group w-100">
@foreach($indicadoresParametros as $ip)
    <li class="list-group-item">
        Ano Base: {{ $ip->ano_base }} <i class="fal fa-arrow-right mx-2"></i> Data Limite: {{ date('d/m/Y',  strtotime($ip->data_limite)) }}
        <form action="{{ url('indicadores-parametros/' . $ip->id) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-xs btn-secondary waves-effect waves-themed" type="submit" id="indicadores-parametros-remove-btn">Remover</button>
        </form>
    </li>
@endforeach
</ul>