<div class="my-3">
    <div class="frame-wrap w-100">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <div class='icon-stack display-3 flex-shrink-0'>
                            <i class="fal fa-circle icon-stack-3x opacity-100 color-primary"></i>
                            <i class="far fa-check icon-stack-1x opacity-100 color-primary"></i>

                        </div>
                        <h4 class="ml-2 mb-0 flex-1 fw-500">
                            Inscritos Confirmados <span class="alert-info p-1">Avaliação</span>
                        </h4>
                        <span class="ml-auto">
                            <span class="collapsed-reveal icon-stack display-4 flex-shrink-01">
                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                <i class="fal fa-chevron-up icon-stack-0-5x opacity-100"></i>
                            </span>
                            <span class="collapsed-hidden icon-stack display-4 flex-shrink-01">
                                <i class="fal fa-circle icon-stack-2x opacity-40"></i>
                                <i class="fal fa-chevron-down icon-stack-0-5x opacity-100"></i>
                            </span>
                        </span>
                    </a>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="dt-inscritos-confirmados-comissao"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($confirmados as $confirmado)
                                    <tr>
                                        <td>{{ $confirmado->nome }}</td>
                                        <td>{{ $confirmado->email }}</td>
                                        <td><span
                                                class="badge
                                                        @switch($confirmado->status_arquivo )
                                                            @case('Em Análise')
                                                                badge-warning
                                                                @break
                                                            @case('Pendente')
                                                                badge-warning
                                                                @break
                                                            @case('Cancelado')
                                                                badge-danger
                                                                @break
                                                            @case('Recusado')
                                                                badge-danger
                                                                @break
                                                            @case('Aceito')
                                                                badge-success
                                                                @break
                                                        @endswitch
                                                    badge-pill
                                                ">
                                                {{ $confirmado->status_arquivo }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ url('evento/inscrito/' . \Illuminate\Support\Facades\Crypt::encryptString($confirmado->id)) }}"
                                                class="btn btn-primary btn-xs">
                                                Dados Completos
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
