<form action="{{ url('criterios') }}" method="POST">
    @csrf
    
    <input type="hidden" name="edital_id" value="@if( $edital ) {{ $edital->id }} @endif">
    <label for="descricao" class="font-weight-bold">Descrição:</label>
    <input type="text" name="descricao" class="form-control mb-3" placeholder="Descrição do critério" />

    <div class="mt-3">
        <button type="submit" class="btn btn-primary btn-user btn-verde font-weight-bold">
            Salvar
        </button>
    </div>
</form>