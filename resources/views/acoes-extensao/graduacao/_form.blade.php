<form action="{{ url('acoes-extensao-comite-consultivo/'. $acao_extensao->id .'/adicionar-membro/')}}" method="post">
    @csrf
    <input type="hidden" id="acao_extensao_id" name="acao_extensao_id" value="{{ $acao_extensao->id }}">

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