<div class="row mb-3">
    <label for="nome" class="col-md-4 col-form-label text-md-end">Nome</label>

    <div class="col-md-6">
        <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{isset($unidade->nome) ? $unidade->nome : ''}}" required autocomplete="nome" autofocus>

        @error('nome')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="sigla" class="col-md-4 col-form-label text-md-end">SIGLA</label>

    <div class="col-md-6">
        <input id="sigla" type="text" class="form-control @error('sigla') is-invalid @enderror" name="sigla" value="{{isset($unidade->sigla) ? $unidade->sigla : ''}}" required autocomplete="sigla">

        @error('sigla')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
