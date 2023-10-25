<div class="mt-3">
    <div class="frame-wrap w-100">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <div class='icon-stack display-3 flex-shrink-0'>
                            <i class="fal fa-circle icon-stack-3x opacity-100 color-primary"></i>
                            <i class="far fa-check icon-stack-1x opacity-100 color-primary"></i>
                            @if(count($confirmados) > 0)
                            <span class="badge badge-icon pos-top pos-right">{{count($confirmados)}}</span>
                            @endif
                        </div>
                        <h4 class="ml-2 mb-0 flex-1 fw-500">
                            Inscritos Confirmados
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
                        <h2>Link para inscrição: <a
                                href="{{ url('evento/' . $evento->id . '/inscrito/novo') }}">{{ url('evento/' . $evento->id . '/inscrito/novo') }}</a>
                        </h2>
                        <table class="table table-bordered table-hover" id="dt-inscritos-confirmados-adm"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($confirmados as $confirmado)
                                    <tr>
                                        <td>{{ $confirmado->nome }}</td>
                                        <td>{{ $confirmado->email }}</td>
                                        <td>
                                            <a href="{{ url('evento/inscrito/' . \Illuminate\Support\Facades\Crypt::encryptString($confirmado->id)) }}"
                                                class="btn btn-primary btn-xs">
                                                Dados Completos
                                            </a>
                                            <a href="{{ url('inscrito/enviar-email/' . $confirmado->id . '/novo') }}"
                                                class="btn btn-primary btn-xs">
                                                Enviar E-Mail
                                            </a>
                                            @if ($confirmado->presenca == 0)
                                                <a href="{{ url('inscritos/adm/presenca/' . $confirmado->id) }}"
                                                    class="btn btn-primary btn-xs">
                                                    Marcar Presença
                                                </a>
                                            @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style='text-align: right'>
                            <a href="{{ url('inscritos/adm/certificados/' . $evento->id) }}" class="btn btn-primary">
                                <i class="fal fa-bell-on mr-1"></i> Notificar Certificados
                            </a>
                            <a href="{{ url('evento/' . $evento->id . '/exportar') }}"
                                class="btn btn-primary waves-effect waves-themed">
                                <i class="fal fa-download mr-1"></i> Exportar para Excel
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header" id="headingTwo">
                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <div class='icon-stack display-3 flex-shrink-0'>
                            <i class="fal fa-circle icon-stack-3x opacity-100 color-primary"></i>
                            <i class="far fa-ellipsis-v icon-stack-1x opacity-100 color-primary"></i>

                        </div>
                        <h4 class="ml-2 mb-0 flex-1 fw-500">
                            Inscritos Lista de Espera
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
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="dt-inscritos-espera" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listaEspera as $lista)
                                    <tr>
                                        <td>{{ $lista->nome }}</td>
                                        <td>{{ $lista->email }}</td>
                                        <td>
                                            <a href="{{ url('evento/inscrito/' . \Illuminate\Support\Facades\Crypt::encryptString($lista->id)) }}"
                                                class="btn btn-primary btn-xs">
                                                Dados Completos
                                            </a>
                                            <a href="{{ url('inscrito/enviar-email/' . $lista->id . '/novo') }}"
                                                class="btn btn-primary btn-xs">
                                                Enviar E-Mail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-header" id="headingThree">
                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="true" aria-controls="collapseThree">
                        <div class='icon-stack display-3 flex-shrink-0'>
                            <i class="fal fa-circle icon-stack-3x opacity-100 color-primary"></i>
                            <i class="far fa-clock icon-stack-1x opacity-100 color-primary"></i>

                        </div>
                        <h4 class="ml-2 mb-0 flex-1 fw-500">
                            Inscritos Aguardando Confirmação
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
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="dt-inscritos-nao-confirmados"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($naoConfirmados as $naoConfirmado)
                                    <tr>
                                        <td>{{ $naoConfirmado->nome }}</td>
                                        <td>{{ $naoConfirmado->email }}</td>
                                        <td>
                                            <a href="{{ url('evento/inscrito/' . \Illuminate\Support\Facades\Crypt::encryptString($naoConfirmado->id)) }}"
                                                class="btn btn-info btn-xs">
                                                Dados Completos
                                            </a>
                                            <a href="{{ url('inscrito/enviar-email/' . $naoConfirmado->id . '/novo') }}"
                                                class="btn btn-primary btn-xs">
                                                Enviar E-Mail
                                            </a>
                                            <a href="{{ url('inscritos/adm/confirmacao/' . $naoConfirmado->id) }}"
                                                class="btn btn-primary btn-xs">
                                                Confirmar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-header" id="headingFour">
                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                        data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        <div class='icon-stack display-3 flex-shrink-0'>
                            <i class="fal fa-circle icon-stack-3x opacity-100 color-primary"></i>
                            <i class="far fa-times icon-stack-1x opacity-100 color-primary"></i>
                        </div>
                        <h4 class="ml-2 mb-0 flex-1 fw-500">
                            Inscritos Cancelados
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
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="dt-inscritos-cancelados"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cancelados as $cancelado)
                                    <tr>
                                        <td>{{ $cancelado->nome }}</td>
                                        <td>{{ $cancelado->email }}</td>
                                        <td>
                                            <a href="{{ url('evento/inscrito/' . \Illuminate\Support\Facades\Crypt::encryptString($cancelado->id)) }}"
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
