    <div class="form-group">
        <label for="data_hora_inicio">Data e Hora de Início: <span class="text-danger">*</span></label>
        <input type="datetime-local" class="form-control @error('data_hora_inicio') is-invalid @enderror" id="data_hora_inicio" name="data_hora_inicio" value="{{isset($acaoExtensaoOcorrencia->data_hora_inicio) ? $acaoExtensaoOcorrencia->data_hora_inicio : old('data_hora_inicio')}}">
        @error('data_hora_inicio')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="data_hora_fim">Data e Hora de Fim: <span class="text-danger">*</span></label>
        <input type="datetime-local" class="form-control @error('data_hora_fim') is-invalid @enderror" id="data_hora_fim" name="data_hora_fim" value="{{isset($acaoExtensaoOcorrencia->data_hora_fim) ? $acaoExtensaoOcorrencia->data_hora_fim : old('data_hora_fim')}}">
    </div>

    <div class="form-group">
        <label for="local">Local: <span class="text-danger">*</span></label>
        <input type="text" class="form-control @error('local') is-invalid @enderror" id="local" name="local" value="{{isset($acaoExtensaoOcorrencia->local) ? $acaoExtensaoOcorrencia->local : old('local')}}">
        @error('local')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="complemento">Complemento:</label>
        <input type="text" class="form-control @error('complemento') is-invalid @enderror" id="complemento" name="complemento" value="{{isset($acaoExtensaoOcorrencia->complemento) ? $acaoExtensaoOcorrencia->complemento : old('complemento')}}">
    </div>

    <div class="form-group">
        <label for="latitude">Latitude:</label>
        <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{isset($acaoExtensaoOcorrencia->latitude) ? $acaoExtensaoOcorrencia->latitude : old('latitude')}}">
    </div>

    <div class="form-group">
        <label for="longitude">Longitude:</label>
        <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{isset($acaoExtensaoOcorrencia->longitude) ? $acaoExtensaoOcorrencia->longitude : old('longitude')}}">
    </div>

    <div class="form-group">
        <label for="inicio_inscricoes">Início das Inscrições: (Para Curricularização)</label>
        <input type="datetime-local" class="form-control @error('inicio_inscricoes') is-invalid @enderror" id="inicio_inscricoes" name="inicio_inscricoes" value="{{isset($acaoExtensaoOcorrencia->inicio_inscricoes) ? $acaoExtensaoOcorrencia->inicio_inscricoes : old('inicio_inscricoes')}}">
    </div>

    <div class="form-group">
        <label for="fim_inscricoes">Fim das Inscrições: (Para Curricularização)</label>
        <input type="datetime-local" class="form-control @error('fim_inscricoes') is-invalid @enderror" id="fim_inscricoes" name="fim_inscricoes" value="{{isset($acaoExtensaoOcorrencia->fim_inscricoes) ? $acaoExtensaoOcorrencia->fim_inscricoes : old('fim_inscricoes')}}">
    </div>
