<div class="col-md-6">
    <form action="{{ route('comissoes.store')}}" method="post">
        @csrf
        <div class="form-group">    
            <label class="form-label" for="nome">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control">
        </div>
        <div class="form-group">    
            <label class="form-label" for="atribuicao">Atribuição</label>
            <select name="atribuicao" class="form-control">
                <option value="">Selecione ...</option>
                <option value="Avaliação">Avaliação</option>
                <option value="Extensão">Extensão</option>
                <option value="Sub Comissão">Sub Comissão</option>
            </select>
        </div>
        @if($user->hasRole('edital-administrador'))
            <div class="form-group">    
                <label class="form-label" for="edital_id">Edital</label>
                <select class="form-control" name="edital_id" id="edital_id">
                    <option value="{{ null }}">Selecione o Edital ...</option>
                    @foreach($editais as $edital)
                        <option value="{{ $edital->id }}">{{ $edital->titulo . ' - ' . $edital->tipo }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" id="unidade_id" name="unidade_id" value="{{ null }}">
        @elseif($user->hasRole('extensao-coordenador'))
            <input type="hidden" id="unidade_id" name="unidade_id" value="{{ isset($user)? $user->unidade_id : null }}">
            <input type="hidden" id="edital_id" name="edital_id" value="{{ null }}">
        @endif

        <button class="btn btn-success">Cadastrar</button>
    </form>
</div>