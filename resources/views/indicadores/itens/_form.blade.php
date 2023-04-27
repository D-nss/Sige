<div class="form-group">
    <label for="indicador" class="form-label">Indicador</label>
    <textarea type="text" class="form-control @error('indicador') is-invalid @enderror" name="indicador" placeholder="Digite o nome do Indicador" rows="3" onkeyup="clearErrorClass(this)">@if(isset($indicador)){{ $indicador->indicador }}@else{{ old('indicador') }}@endif</textarea>
</div>
<div class="form-group">
    <label for="descricao_indicador" class="form-label">Descrição</label>
    <textarea type="text" class="form-control @error('descricao_indicador') is-invalid @enderror" name="descricao_indicador" placeholder="Digite a descrição do Indicador" rows="3" onkeyup="clearErrorClass(this)">@if(isset($indicador)){{ $indicador->descricao_indicador }}@else{{ old('descricao_indicador') }}@endif</textarea>
</div>
<div class="form-group">
    <label for="item_planes" class="form-label">Item Planes</label>
    <textarea type="text" class="form-control @error('item_planes') is-invalid @enderror" name="item_planes" placeholder="Digite o item planes do Indicador" rows="3" onkeyup="clearErrorClass(this)">@if(isset($indicador)){{ $indicador->item_planes }}@else{{ old('item_planes') }}@endif</textarea>
</div>
<div class="custom-control custom-switch">
    <input class="custom-control-input" type="checkbox" id="ativo" name="ativo" value="1" {{ isset($indicador) && $indicador->ativo == 1 ? 'checked' : ''}} {{ old('ativo') ? 'checked' : '' }}>
    <label class="custom-control-label mb-2" for="ativo">
        Ativo
    </label>
</div>