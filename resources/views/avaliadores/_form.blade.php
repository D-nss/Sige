<form action="{{ url('avaliadores') }}" method="POST" id="form-avaliadores">
    @csrf
    <input type="hidden" name="edital_id" value="{{ $edital->id }}">
    <label for="subcomissao_tematica" class="font-weight-bold">Subcomissão Temática: </label>
    <select name="subcomissao_tematica" id="subcomissao_tematica" class="form-control mb-3">
        <option value="">Selecionar ...</option>
        @foreach($subcomissoes as $subcomissao)
            <option value="{{ $subcomissao->id }}">{{ $subcomissao->nome }}</option>
        @endforeach
    </select>

    <label for="avaliador" class="font-weight-bold">Avaliador: </label>
    <select name="avaliador" id="avaliador" class="form-control mb-3">
        
    </select>

    <!-- <label for="atribuicao" class="font-weight-bold">Atribuição: </label>
    <select name="atribuicao" id="atribuicao" class="form-control mb-3">
        <option value="">Selecionar ...</option>
        <option value="">Conselheiro</option>
        <option value="">Parecerista</option>
    </select> -->

    <div class="mt-3">
        <button class="btn btn-primary btn-user btn-verde font-weight-bold loading">
            <div class="spinner-border spinner-border-sm d-none spin" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <span class="spin-text">
                Adicionar
            </span>
        </button>
        
    </div>
</form>
        
