<form action="{{ route('comissoes.store')}}" method="post">
    @csrf
    <div class="form-group">    
        <label class="form-label" for="simpleinput">Nome</label>
        <input type="text" id="nome" name="nome" class="form-control w-50">
    </div>
    <div class="form-group">    
        <label class="form-label" for="simpleinput">Atribuição</label>
        <select name="atribuicao" class="form-control w-50">
            <option value="">Selecione ...</option>
            <option value="Avaliação">Avaliação</option>
            <option value="Sub Comissão">Sub Comissão</option>
        </select>
    </div>
    <input type="hidden" id="edital_id" name="edital_id" value="{{$edital_id}}">
    
    <button class="btn btn-success">Cadastrar</button>
</form>