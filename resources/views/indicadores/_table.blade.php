<!-- datatable start -->
<table id="dt-indicadores" class="table table-bordered table-hover table-striped w-100">
    <thead>
        <tr>
            <th>Indicador</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        @foreach($indicardoresPorUnidade as $indicardorPorUnidade)
            <tr>
                <th>{{ $indicardorPorUnidade->indicador }}</th>
                <th>{{ str_replace('.', ',', $indicardorPorUnidade->valor) }}</th>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Indicador</th>
            <th>Valor</th>
        </tr>
    </tfoot>
</table>
<!-- datatable end -->