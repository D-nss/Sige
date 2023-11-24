
<form action="{{ url('questoes') }}" class="row" id="div_questao_existente" method="post">
    @csrf
    <input type="hidden" name="edital_id" value="{{ $edital->id }}">
    <div class="col-md-12">
        

        <label for="browser" class="font-weight-bold">Escolha a questão na Lista:</label>
        <input list="questoes_list" class="form-control mb-3 " name="enunciado">

        <datalist id="questoes_list">
            @foreach($edital->questoes as $questao)
                <option value="{{ $questao->enunciado }}">
            @endforeach
        </datalist>

        <label for="tipo" class="font-weight-bold">Tipo da Questão</label>
        <select class="form-control mb-3 col-3" name="tipo">
            <option value="">Selecione ...</option>
            <option value="Avaliativa">Avaliativa</option>
            <option value="Complementar">Complementar</option>
        </select>

        <button class="btn btn-primary btn-pills waves-effect waves-themed loading-questao-existente">
            <div class="spinner-border spinner-border-sm d-none spin" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <span class="spin-text-questao-existente">
                <i class="far fa-save"></i>
                Salvar
            </span>
        </button>
    </div>
</form>

<form action="{{ url('questoes') }}" class="row d-none" id="div_nova_questao" method="post">
    @csrf
    <input type="hidden" name="edital_id" value="{{ $edital->id }}">
    <div class="col-md-12">
        <label for="questao" class="font-weight-bold">Questão</label>
        <textarea name="enunciado" class="form-control mb-3" id="" cols="30" rows="5"></textarea>

        <label for="tipo" class="font-weight-bold">Tipo da Questão</label>
        <select class="form-control mb-3 col-3" name="tipo">
            <option value="">Selecione ...</option>
            <option value="Avaliativa">Avaliativa</option>
            <option value="Complementar">Complementar</option>
        </select>

        <button class="btn btn-primary btn-pills waves-effect waves-themed loading-nova-questao">
            <div class="spinner-border spinner-border-sm d-none spin" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <span class="spin-text-nova-questao">
                <i class="far fa-save"></i>
                Salvar
            </span>
        </button>
    </div>
</form>

<button type="button" class="btn btn-outline-primary btn-pills waves-effect waves-themed mt-3" id="nova_questao">Nova questão</button>
<button type="button" class="btn btn-outline-primary btn-pills waves-effect waves-themed d-none mt-3" id="questao_existente">Usar questão existente</button>