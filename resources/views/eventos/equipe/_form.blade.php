<h3 class="font-color-light">Preencha corretamente o formulário com as informações sobre o membro da equipe nos campos correspondentes</h3>

<div class="form-group mt-3">
    <label for="local" class="fw-500">O membro da equipe é funcionário da UNICAMP?</label>
    <div class="custom-control custom-switch">
        <input class="custom-control-input" type="checkbox" id="funcionario_unicamp" name="funcionario_unicamp" value="1" @if( isset($membro->funcionario_unicamp) && $membro->funcionario_unicamp == 1 ) checked @endif >
        <label class="custom-control-label" for="funcionario_unicamp" id="funcionario_unicamp_label">
            @if( isset($membro->funcionario_unicamp) && $membro->funcionario_unicamp == 1 )
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
        <input class="custom-control-input" type="checkbox" id="aluno_unicamp" name="aluno_unicamp" value="1" @if( isset($membro->aluno_unicamp) && $membro->aluno_unicamp == 1 ) checked @endif>
        <label class="custom-control-label" for="aluno_unicamp" id="aluno_unicamp_label">
            @if( isset($membro->aluno_unicamp) && $membro->aluno_unicamp == 1 )
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
            <option value="{{ $user->id }}" @if( isset($membro->user_id ) && $membro->user_id == $user->id ) selected @endif>{{ $user->name }} - {{ $user->sigla }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="nome" class="fw-500">Nome Completo<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome completo" value="@if( isset($membro->nome) ){{ $membro->nome }}@else{{ old('nome') }}@endif">
</div>

<div class="form-group">
    <label for="cpf" class="fw-500">CPF<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Digite o CPF " value="@if( isset($membro->cpf) ){{ $membro->cpf }}@else{{ old('cpf') }}@endif">
</div>

<div class="form-group">
    <label for="email" class="fw-500">E-Mail<span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="email" id="email" placeholder="Digite o e-mail " value="@if( isset($membro->email) ){{ $membro->email }}@else{{ old('email') }}@endif">
</div>

<div class="form-group">
    <label for="whatsapp" class="fw-500">Whatsapp</label>
    <input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="Digite o e-mail " value="@if( isset($membro->whatsapp) ){{ $membro->whatsapp }}@else{{ old('whatsapp') }}@endif">
</div>

<div class="form-group">
    <label for="instituicao" class="fw-500">Instituição Externa</label>
    <input type="text" class="form-control" name="instituicao" id="instituicao" placeholder="Digite o nome da instituição " value="@if( isset($membro->instituicao) ){{ $membro->instituicao }}@else{{ old('instituicao') }}@endif">
</div>

<div class="form-group">    
    <label class="form-label fw-500" for="simpleinput">Função no Evento<span class="text-danger">*</span></label>
    <select name="funcao_evento" class="form-control w-50">
        <option value="">Selecione ...</option>
        <option value="Palestrante" @if( isset($membro->funcao_evento ) && $membro->funcao_evento == 'Palestrante' ) selected @endif >Palestrante</option>
        <option value="Staff" @if( isset($membro->funcao_evento ) && $membro->funcao_evento == 'Staff' ) selected @endif>Staff</option>
    </select>
</div>
                
