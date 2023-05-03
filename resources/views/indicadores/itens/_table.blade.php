<!-- datatable start -->
<table id="dt-indicadores" class="table table-bordered table-hover table-striped w-100">
    <thead>
        <tr>
            <th>Indicador</th>
            <th>Descrição</th>
            <th>Item Planes</th>
            <th>Ativo</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($indicadores as $indicador)
        <tr>
            <td>
                <a href="/indicadores-itens/{{$indicador->id}}" class="fs-lg fw-500 d-block">
                    {{ $indicador->indicador }}
                </a>
            </td>
            <td>{{ $indicador->descricao_indicador }}</td>
            <td>{{ $indicador->item_planes }}</td>
            <td>
                @if( is_null($indicador->ativo) )
                    <form action="{{ url('indicadores-itens-ativar/' . $indicador->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="ativo" value="nao">
                        <button type="submit" class="btn badge badge-danger">Não</button>
                    </form>
                @else
                <form action="{{ url('indicadores-itens-ativar/' . $indicador->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="ativo" value="sim">
                        <button type="submit" class="btn badge badge-info">Sim</button>
                    </form>
                @endif
            </td>
            <td>
                <button 
                type="button" 
                class="btn btn-dark" 
                data-toggle="popover" 
                data-trigger="focus" 
                data-placement="top" 
                title="" 
                data-content=
                '<div class="d-flex">
                    <a href="{{ url('indicadores-itens/' . $indicador->id . '/editar') }}" class="btn btn-info btn-lg btn-icon rounded-circle ml-2">
                        <i class="fal fa-file-edit"></i>
                    </a>
                    <form action="{{ url('indicadores-itens/' . $indicador->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-lg btn-icon rounded-circle ml-2">
                            <i class="fal fa-trash-alt"></i>
                        </button>
                    </form>
                    
                </div>'
            class="cursor-pointer"
            data-toggle="popover"
            data-trigger="focus"
            data-placement="top" 
            title="<h4 class='fw-500 width-sm'><i class='fal fa-file-check mr-2'></i>File permissions</h4>" 
            data-html="true" 
            data-original-title="Opções" 
            >
                <i class="far fa-angle-double-up"></i>
            </button>
        </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
        <th>Indicador</th>
            <th>Descrição</th>
            <th>Item Planes</th>
            <th>Ativo</th>
        </tr>
    </tfoot>
</table>
<!-- datatable end -->