<aside class="page-sidebar">
    <div class="page-logo">
        <!-- <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut"> -->
            <span class="fa-4x d-inline l-h-n">
                <img src="{{ asset('smartadmin-4.5.1/img/proec.svg') }}" alt="Proec - ExteCult" class="w-100" style="fill:white;"/>
            </span>
            <span class="page-logo-text mr-1 fw-900 fs-xxl p-2">
                ExteCult
            </span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        <!-- </a> -->
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="{{asset('smartadmin-4.5.1/img/demo/avatars/avatar-m.png')}}" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
            <div class="info-card-text">
                @if(Auth::hasUser())
                    <a href="#" class="d-flex align-items-center text-white">
                        <span class="text-truncate text-truncate-sm d-inline-block">
                            {{Auth::user()->id}}
                        </span>
                    </a>
                    <span class="d-inline-block text-truncate text-truncate-sm">{{ Str::of(Str::before(Auth::user()->name, ' '))->trim() }},<br>
                    <a href="/logout" class="btn btn-xs btn-secondary waves-effect waves-themed">Sair</a>
                @else
                    <a href="#" class="d-flex align-items-center text-white">
                        <span class="text-truncate text-truncate-sm d-inline-block">
                            Visitante
                        </span>
                    </a>
                    <a href="/login" class="btn btn-xs btn-primary waves-effect waves-themed">Entrar</a>
                @endif
            </div>
            <img src="{{asset('smartadmin-4.5.1/img/card-backgrounds/cover-3-lg.png')}}" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>
        <!--
        TIP: The menu items are not auto translated. You must have a residing lang file associated with the menu saved inside dist/media/data with reference to each 'data-i18n' attribute.
        -->

        <ul id="js-nav-menu" class="nav-menu">
            @if(Auth::hasUser())

            @hasanyrole('super|admin|acoes', 'web_user')
                <li>
                    <a href="javascript:void(0);" title="Ações de Extensão" data-filter-tags="utilities menu child">
                        <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Ações de Extensão</span>
                    </a>
                    <ul>
                        <li class="">
                            <a href="{{ url('acoes-extensao/painel/extensao') }}" title="Dashboard" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Dashboard</span>
                            </a>
                            <a href="{{ url('acoes-extensao/novo') }}" title="Cadastrar" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Cadastrar</span>
                            </a>
                            <a href="{{ url('acoes-extensao-catalogo') }}" title="Catálogo" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Catálogo Aprovados PROEC</span>
                            </a>
                            <a href="{{ url('acoes-extensao-ocorrencias/catalogo') }}" title="Catálogo Ocorrências" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Catálogo Ocorrências</span>
                            </a>
                            <a href="{{ url('acoes-extensao') }}" title="Listagem" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Listagem</span>
                            </a>
                            <a href="{{ url('acoes-extensao/mapa/extensao') }}" title="Mapa" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Mapa</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" title="Ações de Cultura" data-filter-tags="utilities menu child">
                        <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Ações de Cultura</span>
                    </a>
                    <ul>
                        <li class="">
                            <a href="{{ url('painel-cultura') }}" title="Cadastrar" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Dashboard</span>
                            </a>
                            <a href="{{ url('acoes-culturais/novo') }}" title="Cadastrar" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Cadastrar</span>
                            </a>
                            <a href="{{ url('acoes-culturais') }}" title="Listagem" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Listagem</span>
                            </a>
                            <a href="#" title="Listagem" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Mapa</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endhasanyrole
            @endif

            @if(Auth::hasUser())

            @hasanyrole('super|admin|indicadores-admin|indicadores-user', 'web_user')
                <li>
                    <a href="javascript:void(0);" title="Indicadores" data-filter-tags="utilities menu child">
                        <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Indicadores</span>
                    </a>
                    <ul>
                        <li class="">
                            <a href="{{ url('indicadores/novo') }}" title="Cadastrar" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Cadastrar</span>
                            </a>
                            <a href="{{ url('indicadores') }}" title="Listagem" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Listagem</span>
                            </a>
                            @hasanyrole('super|admin|indicadores-admin', 'web_user')
                            <a href="{{ url('indicadores-parametros') }}" title="Parametros" data-filter-tags="utilities menu child sublevel item">
                                <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Parâmetros</span>
                            </a>
                            @endhasanyrole
                        </li>
                    </ul>
                </li>
            @endhasanyrole
            @endif

            <li>
                <a href="javascript:void(0);" title="Menu child" data-filter-tags="utilities menu child">
                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Editais</span>
                </a>
                <ul>
                    @if(Auth::hasUser())
                    @hasanyrole('super|admin|edital-administrador', 'web_user')
                    <li class="">
                        <a href="{{ url('processo-editais') }}" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Processos de Editais</span>
                        </a>
                    </li>
                    @endhasanyrole
                    @endif
                    <li class="">
                        <a href="{{ url('editais') }}" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Editais</span>
                        </a>
                    </li>
                    @if(Auth::hasUser())
                    <!-- <li class="">

                        <a href="javascript:void(0);" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Inscrições</span>
                        </a>
                        <ul>
                            <li class="">
                                <a href="{{ url('inscricoes-enviadas') }}" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Suas Inscrições</span>
                                </a>
                            </li>

                            <li class="">
                                <a href="{{ url('inscricao') }}" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Em Andamento</span>
                                </a>
                            </li>

                        </ul>
                    </li> -->
                    @endif

                </ul>
            </li>
            @if(Auth::hasUser())
            <li class="">
                <a href="javascript:void(0);"  title="Menu child" data-filter-tags="utilities menu child">
                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Eventos</span>
                </a>
                <ul>
                    <li class="">
                        <a href="{{ url('eventos') }}" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Eventos</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('eventos_por_comissao') }}" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Por Comissão</span>
                        </a>
                    </li>
                </ul>
            </li>
            @hasanyrole('super|admin', 'web_user')
            <li class="nav-title">Administração</li>
            <li>
                <a href="javascript:void(0);" title="Menu child" data-filter-tags="utilities menu child">
                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Usuarios</span>
                </a>
                <ul>
                    <li class="">
                        <a href="/usuarios" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Usuarios</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/usuarios/novo" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Cadastrar Usuario</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" title="Menu child" data-filter-tags="utilities menu child">
                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Papeis</span>
                </a>
                <ul>
                    <li class="">
                        <a href="/roles" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Papeis</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/roles/novo" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Cadastrar Papel</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" title="Menu child" data-filter-tags="utilities menu child">
                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Permissões</span>
                </a>
                <ul>
                    <li class="">
                        <a href="/permissions" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Permissões</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/permissions/novo" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Cadastrar Permissão</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" title="Menu child" data-filter-tags="utilities menu child">
                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Unidades</span>
                </a>
                <ul>
                    <li class="">
                        <a href="/unidades" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Unidades</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/unidades/novo" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Cadastrar Unidade</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endhasanyrole
            @endif
            <!--<li class="nav-title">Administração</li>
            <li>
                <a href="#" title="Category" data-filter-tags="category">
                    <i class="fal fa-file"></i>
                    <span class="nav-link-text" data-i18n="nav.category">Usuários</span>
                </a>
                <ul>
                    <li>
                        <a href="/usuarios/novo" title="Menu child" data-filter-tags="utilities menu child">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Cadastrar Usuário</span>
                        </a>
                    </li>
                </ul>
            </li>-->
            @if(Auth::check())
            <li class="mt-3">
                <a href="https://runrun.it/share/form/UdKA3gCmPmCrxEc0" title="Blank Project" target="_blank" data-filter-tags="blank page">
                    <i class="fal fa-user-headset"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Solicitação de Suporte</span>
                </a>
            </li>
            @endif
            <!-- <li class="disabled">
                <a href="#" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-globe"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Editais</span>
                </a>
            </li>
            <li class="disabled">
                <a href="#" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-globe"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Cronogramas</span>
                </a>
            </li>
            <li class="disabled">
                <a href="#" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-globe"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Áreas Temáticas</span>
                </a>
            </li>
            <li class="disabled">
                <a href="#" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-globe"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Logs</span>
                </a>
            </li> -->
        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify" class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
        <!-- <ul class="list-table m-auto nav-footer-buttons">
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                    <i class="fal fa-comments"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Support Chat">
                    <i class="fal fa-life-ring"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Make a call">
                    <i class="fal fa-phone"></i>
                </a>
            </li>
        </ul> -->
    </div> <!-- END NAV FOOTER -->
</aside>
