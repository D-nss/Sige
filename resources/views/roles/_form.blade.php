    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">Nome</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{isset($role->name) ? $role->name : ''}}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="form-group">
            <strong>Permissões do Papel:</strong>
            <select class="form-control" id="permissions" name="permissions[]" multiple="multiple">
                @foreach ($permissions as $permission)
                    <option {{ isset($role) && in_array($role->permissions, $permission->id) ? "selected" : ""}} value="{{$permission->id}}">{{$permission->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
