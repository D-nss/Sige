<aside class="page-sidebar">
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <span class="fa-4x d-inline l-h-n">
                <i class="fal fa-people-carry"></i>
            </span>
            <span class="page-logo-text mr-1 fw-900 fs-xxl p-2">
                SIGEC
            </span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
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
                @auth
                    <a href="#" class="d-flex align-items-center text-white">
                        <span class="text-truncate text-truncate-sm d-inline-block">
                            {{Auth::user()->id}}
                        </span>
                    </a>
                    <span class="d-inline-block text-truncate text-truncate-sm">{{User::where('email', Auth::user()->id)->first()->unidade->sigla}},<br> Unicamp</span>
                @endauth
                @guest
                    <a href="#" class="d-flex align-items-center text-white">
                        <span class="text-truncate text-truncate-sm d-inline-block">
                            Visitante
                        </span>
                    </a>
                @endguest
                <span class="d-inline-block text-truncate text-truncate-sm">Reitoria,<br> Unicamp</span>
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
            <li>
                <a href="#" title="Category" data-filter-tags="category">
                    <i class="fal fa-file"></i>
                    <span class="nav-link-text" data-i18n="nav.category">UNIDADE: ABCDEF</span>
                </a>
                <ul>
                    <li>
                        <a href="{{ url('/indicadores') }}" title="Indicadores">
                            <span class="nav-link-text">Dados Indicadores</span>
                        </a>
                        <!-- <a href="javascript:void(0);" title="Menu child" data-filter-tags="utilities menu child">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Dados Indicadores</span>
                        </a> -->
                        <!-- <ul>
                            <li>
                                <a href="javascript:void(0);" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Cadastrar Dados</span>
                                </a>
                            </li>
                        </ul> -->
                    </li>
                    <!-- <li class="disabled">
                        <a href="javascript:void(0);" title="Menu child" data-filter-tags="utilities menu child">
                            <span class="nav-link-text" data-i18n="nav.utilities_menu_child">Ações de Extensão</span>
                        </a>
                        <ul>
                            <li class="disabled">
                                <a href="javascript:void(0);" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Cadastrar Ação de Extensão</span>
                                </a>
                            </li>
                            <li class="disabled">
                                <a href="javascript:void(0);" title="Sublevel Item" data-filter-tags="utilities menu child sublevel item">
                                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child_sublevel_item">Em Andamento</span>
                                </a>
                            </li>
                            <li class="disabled">
                                <a href="javascript:void(0);" title="Another Item" data-filter-tags="utilities menu child another item">
                                    <span class="nav-link-text" data-i18n="nav.utilities_menu_child_another_item">Concluídos</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="disabled">
                        <a href="javascript:void(0);" title="Disabled item" data-filter-tags="utilities disabled item">
                            <span class="nav-link-text" data-i18n="nav.utilities_disabled_item">Ações Culturais</span>
                        </a>
                    </li> -->
                </ul>
            <!-- </li>
            <li class="disabled">
                <a href="blank.html" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-globe"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Editais Extensão</span>
                </a>
            </li>
            <li class="disabled">
                <a href="blank.html" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-globe"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Editais Cultura</span>
                </a>
            </li>
            <li class="disabled">
                <a href="blank.html" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-globe"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Editais Bolsas</span>
                </a>
            </li>
            <li class="disabled">
                <a href="blank.html" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-globe"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Relatórios</span>
                </a>
            </li> -->
            <li class="nav-title">Administração</li>
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
            </li>
            <li>
                <a href="/unidades" title="Blank Project" data-filter-tags="blank page">
                    <i class="fal fa-globe"></i>
                    <span class="nav-link-text" data-i18n="nav.blankpage">Unidades</span>
                </a>
            </li>
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
