<form action="{{ url('criterios') }}" method="POST" id="form-criterios">
    @csrf
    
    <input type="hidden" name="edital_id" value="@if( $edital ) {{ $edital->id }} @endif">
    <label for="descricao" class="font-weight-bold">Descrição:</label>
    <input type="text" name="descricao" class="form-control mb-3" placeholder="Descrição do critério" value="{{ old('descricao') }}" required />

    <div class="mt-3">
        <button type="submit" class="btn btn-primary btn-pills waves-effect waves-themed loading">
        <i class="far fa-save"></i>
            <div class="spinner-border spinner-border-sm d-none spin" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <span class="spin-text">
                    Salvar
                </span>
        </button>
    </div>
</form>