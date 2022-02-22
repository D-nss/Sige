<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Nome Completo" value="{{isset($registro->name) ? $registro->name : ''}}">
</div>
<div class="form-group">
  <input type="email" class="form-control" name="email" placeholder="Endereço de Email" value="{{isset($registro->email) ? $registro->email : ''}}">
</div>
<div class="form-group">
    <select class="form-control">
        <option>Selecione o Tipo (Permissão)</option>
        <option>Coordenador</option>
        <option>Avaliador</option>
        <option>Conselheiro</option>
        <option>Administrador Sistema</option>
    </select>
  </div>

<div class="form-group row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <input type="password" class="form-control" name="password" placeholder="Senha">
  </div>
  <div class="col-sm-6">
    <input type="password" class="form-control" name="password_confirmacao" placeholder="Confirmação Senha">
  </div>
</div>
