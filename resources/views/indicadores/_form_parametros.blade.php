<form action="{{ url('indicadores-parametros') }}" method="post" id="indicadores-parametros-form">
    @csrf
    <input type="hidden" value="@if(isset($indicadoresParametros->id)){{$indicadoresParametros->id}}@endif" name="id">
    <div class="form-row">
        <div class="col">
            <strong>
                <label for="ano_base">Ano Base</label>
            </strong>
            <input type="text" class="form-control" name="ano_base" id="ano_base" maxlength="4" value="@if(isset($indicadoresParametros->ano_base)){{$indicadoresParametros->ano_base}}@endif">
        </div>
        <div class="col">
            <strong>
                <label for="data_limite">Data Limite</label>
            </strong>
            <input type="date" class="form-control" name="data_limite" id="data_limite" value="@if(isset($indicadoresParametros->data_limite)){{$indicadoresParametros->data_limite}}@endif">
        </div>
    </div>
    <div class="my-2">
        <button class="btn btn-xs btn-success waves-effect waves-themed" type="button" id="indicadores-parametros-salvar-btn">Salvar</button>
    </div>
</form>