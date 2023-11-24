<!-- Default Card Example -->
<div class="card mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para criar um novo cronograma para o Edital <span class="text-success">{{ $edital->titulo }}</span></h6>
</div>
<div class="card-body">
    
@if(!empty($edital->cronogramas->toArray()))
    <form action='{{ url("cronogramas/$edital->id") }}' method="POST" id="form-cronograma">
        @method('PUT')
@else
    <form action='{{ url("cronogramas") }}' method="POST" id="form-cronograma">
@endif
        @csrf       
        <div class="row">
            <div class="col-md-6">
                <input type="hidden" name="edital_id" value="{{ $edital->id }}">
                <?php 
                    //contador para ser usado no value do input
                    $i = 0 
                ?>
                @foreach($modelo_cronograma as $mc)
                <div class="mb-3">
                    <label for="{{ $mc->dt_input }}" class="font-weight-bold">{{ $mc->dt_label }}:</label>
                    <input type="date" name="{{ $mc->dt_input }}" id="{{ $mc->dt_input }}" class="form-control" placeholder="dd/mm/aaaa" value="@if(!empty($edital->cronogramas->toArray())){{ $edital->cronogramas[$i]->data }}@endif" onblur="validadorData(this, '{{ $mc->validate }}', '{{ $mc->msg_erro}}')" />
                    <span class="font-size-14 text-danger" id="erro_{{ $mc->dt_input }}"></script>
                </div>
                <?php 
                    //incremento do contador usado no value do input
                    $i += 1 
                ?>
                @endforeach
                <script>
                    function validadorData(e, validate, msg_erro) {
                        if(validate != '') {
                            /*checa se a data é menor que a data anterior com base no validate da tabela modelo_cronograma */
                            var data1 = new Date($(`#${e.name}`).val())
                            var data2 = new Date($(`#${validate}`).val())
                            if(data1 < data2) {
                                $(`#erro_${e.name}`).html(msg_erro);
                                $(`#${e.name}`).val('');
                            } 
                            else {
                                $(`#erro_${e.name}`).html('');
                            }
                        }
                    }
                </script>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <a href="#" onclick="history.back()" class="btn btn-outline-primary btn-pills waves-effect waves-themed">
                        <span class="icon">
                            <i class="fal fa-long-arrow-left"></i>
                        </span>
                        <span class="text">Voltar</span>
                    </a>
                    <button class="btn btn-primary btn-pills waves-effect waves-themed loading">
                        <div class="spinner-border spinner-border-sm d-none spin" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="spin-text">
                            @if(!empty($edital->cronogramas->toArray()))
                                Atualizar
                            @else
                                Salvar
                            @endif
                        </span>
                    </button>
                    
                </div>
            </div>
        </div>
    </form>
   
    </div>
</div>