<h3 class="font-color-light">Preencha corretamente o formulário com as informações sobre o membro da equipe nos campos correspondentes</h3>
<div class="form-group mt-3">
    <label for="local" class="fw-500">O membro da equipe é funcionário da UNICAMP?</label>
    <div class="custom-control custom-switch">
        <input class="custom-control-input" type="checkbox" id="funcionario_unicamp" name="funcionario_unicamp" value="1" @if( isset($acaoExtensaoOcorrenciaMembro->funcionario_unicamp) && $acaoExtensaoOcorrenciaMembro->funcionario_unicamp == 1 ) checked @endif >
        <label class="custom-control-label" for="funcionario_unicamp" id="funcionario_unicamp_label">
            @if( isset($acaoExtensaoOcorrenciaMembro->funcionario_unicamp) && $acaoExtensaoOcorrenciaMembro->funcionario_unicamp == 1 )
                Sim
            @else
                Não
            @endif
        </label>
    </div>
</div>

<div class="form-group mt-3">
    <label for="local" class="fw-500">O membro da equipe é aluno da UNICAMP?</label>
    <div class="custom-control custom-switch">
        <input class="custom-control-input" type="checkbox" id="aluno_unicamp" name="aluno_unicamp" value="1" @if( isset($acaoExtensaoOcorrenciaMembro->aluno_unicamp) && $acaoExtensaoOcorrenciaMembro->aluno_unicamp == 1 ) checked @endif>
        <label class="custom-control-label" for="aluno_unicamp" id="aluno_unicamp_label">
            @if( isset($acaoExtensaoOcorrenciaMembro->aluno_unicamp) && $acaoExtensaoOcorrenciaMembro->aluno_unicamp == 1 )
                Sim
            @else
                Não
            @endif
        </label>
    </div>
</div>

<div class="form-group d-none" id="user_form_group">
    <label class="form-label fw-500" for="simpleinput">Usuário</label>
    <select name="user_id" id="user_id" class="form-control w-50">
        <option value="">Selecione ...</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}" @if( isset($acaoExtensaoOcorrenciaMembro->user_id ) && $acaoExtensaoOcorrenciaMembro->user_id == $user->id ) selected @endif>{{ $user->name }} - {{ $user->sigla }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="nome" class="fw-500">Nome Completo<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome completo" value="@if( isset($acaoExtensaoOcorrenciaMembro->nome) ){{ $acaoExtensaoOcorrenciaMembro->nome }}@else{{ old('nome') }}@endif">
</div>

<div class="form-group">
    <label for="cpf" class="fw-500">CPF<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Digite o CPF " value="@if( isset($acaoExtensaoOcorrenciaMembro->cpf) ){{ $acaoExtensaoOcorrenciaMembro->cpf }}@else{{ old('cpf') }}@endif">
</div>

<div class="form-group">
    <label for="email" class="fw-500">E-Mail<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="email" id="email" placeholder="Digite o e-mail " value="@if( isset($acaoExtensaoOcorrenciaMembro->email) ){{ $acaoExtensaoOcorrenciaMembro->email }}@else{{ old('email') }}@endif">
</div>

<div class="form-group">
    <label for="whatsapp" class="fw-500">Whatsapp</label>
    <input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="Digite o whatsapp" value="@if( isset($acaoExtensaoOcorrenciaMembro->whatsapp) ){{ $acaoExtensaoOcorrenciaMembro->whatsapp }}@else{{ old('whatsapp') }}@endif">
</div>

<div class="form-group">
    <label for="instituicao" class="fw-500">Instituição</label>
    <input type="text" class="form-control" name="instituicao" id="instituicao" placeholder="Digite o nome da instituição " value="@if( isset($acaoExtensaoOcorrenciaMembro->instituicao) ){{ $acaoExtensaoOcorrenciaMembro->instituicao }}@else{{ old('instituicao') }}@endif">
</div>

<div class="form-group">
    <label class="form-label" for="vinculo">Vinculo <span class="text-danger">*</span></label>
    <select class="form-control @error('vinculo') is-invalid @enderror" id="vinculo" name="vinculo">
        @if(isset($acaoExtensaoOcorrenciaMembro))
            <option value="{{$acaoExtensaoOcorrenciaMembro->vinculo}}">{{$acaoExtensaoOcorrenciaMembro->vinculo}}</option>
        @else
            <option value="">Selecione o Vinculo</option>
        @endif
        @if (!empty($lista_vinculo))
            @foreach ($lista_vinculo as $vinculo_colaborador)
              <option value="{{$vinculo_colaborador}}" @if( old('vinculo') == $vinculo_colaborador ) selected @endif>{{$vinculo_colaborador}}</option>
            @endforeach
        @endif
    </select>
    @error('vinculo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="form-group">
    <label class="form-label fw-500">Função<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="funcao" id="funcao" placeholder="Digite a função do membro na Ocorrência " value="@if( isset($acaoExtensaoOcorrenciaMembro->funcao) ){{ $acaoExtensaoOcorrenciaMembro->funcao }}@else{{ old('funcao') }}@endif">
</div>

<div class="form-group">
    <label for="carga_horaria" class="fw-500">Carga Horária</label>
    <input type="text" class="form-control" name="carga_horaria" id="carga_horaria" value="@if( isset($acaoExtensaoOcorrenciaMembro->carga_horaria) ){{ $acaoExtensaoOcorrenciaMembro->carga_horaria }}@else{{ old('carga_horaria') }}@endif">
</div>

