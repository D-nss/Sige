<form action="{{ route('participantes.store')}}" method="post">
    @csrf
    
    <input type="hidden" id="comissao_id" name="comissao_id" value="{{ $comissao->id }}">
    <input type="hidden" id="edital_id" name="edital_id" value="{{$edital_id}}">

    <div class="form-group">    
        <label class="form-label" for="simpleinput">Usuário</label>
        <select name="user_id" class="form-control w-50">
            <option value="">Selecione ...</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->sigla }}</option>
            @endforeach
        </select>
    </div>
    
    <button class="btn btn-success">Cadastrar</button>
</form>