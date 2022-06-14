
<div>
    <a href="#" class="header-icon" data-toggle="dropdown" title="Você tem 11 notificações">
        <i class="fal fa-bell"></i>
        <span class="badge badge-icon">{{ count(Auth::user()->unreadNotifications->toArray()) }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-animated dropdown-xl">
        <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
            <h4 class="m-0 text-center color-white">
                
                {{ count(Auth::user()->unreadNotifications->toArray()) }}
                <small class="mb-0 opacity-80">Notificações</small>
            </h4>
        </div>
        <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
            <li class="nav-item">
                <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-messages" data-i18n="drpdwn.messages">Mensagens</a>
            </li>
        </ul>
        <div class="tab-content tab-notification">
            <div class="tab-pane active p-3 text-center">
                <h5 class="mt-4 pt-4 fw-500">
                    <span class="d-block fa-3x pb-4 text-muted">
                        <i class="ni ni-arrow-up text-gradient opacity-70"></i>
                    </span> Select a tab above to activate
                    <small class="mt-3 fs-b fw-400 text-muted">
                        This blank page message helps protect your privacy, or you can show the first message here automatically through
                        <a href="#">settings page</a>
                    </small>
                </h5>
            </div>
            <div class="tab-pane" id="tab-messages" role="tabpanel">
                <div class="custom-scroll h-100">
                    <ul class="notification">
                        <div id="notification">
                        @foreach(Auth::user()->unreadNotifications as $unreadNotification)
                        <li>
                            <a href="{{ route('notificacao.show', $unreadNotification->id) }}" class="d-flex align-items-center">
                                <span class="status status-danger mr-2">
                                    
                                </span>
                                <span class="d-flex flex-column flex-1 ml-1">
                                    <span class="name">{{ $unreadNotification->data['dados']['titulo'] }}</span>
                                    <span class="msg-a fs-sm mt-1 text-primary">{{ $unreadNotification->data['mensagem'] }}</span>
                                    <span class="fs-nano text-muted mt-1">{{ date('d/m/Y H:i:s', strtotime($unreadNotification->created_at)) }}</span>
                                </span>
                            </a>
                        </li>
                        @endforeach
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="py-2 px-3 bg-faded d-block rounded-bottom text-center border-faded border-bottom-0 border-right-0 border-left-0">
            <a href="{{ route('notificacoes.index') }}" class="fs-md fw-700 ml-auto">Ver todas as Notificações</a>
        </div>
    </div>
</div>