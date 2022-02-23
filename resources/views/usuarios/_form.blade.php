    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">Nome</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{isset($usuario->name) ? $usuario->name : ''}}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{isset($usuario->email) ? $usuario->email : ''}}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unidade">Unidade<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <select class="form-control" id="unidade" name="unidade">
            <option value="">Escolha a Unidade</option>
            @foreach($unidades as $unidade)
                <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
            @endforeach
          </select>
        </div>
    </div>
