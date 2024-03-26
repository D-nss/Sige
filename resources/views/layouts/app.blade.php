<!DOCTYPE html>
<!-- Utilizando template SmartAdmin Responsive WebApp - Template build with Twitter Bootstrap 4
Versão: 4.5.1
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

        <!-- Estilos -->

        <!-- PROEC e Design System EC (transicionando)-->
        <link id="proec-estilo" rel="stylesheet" media="screen" href="{{asset('css/proec.css')}}">
        <link id="extecult-estilo" rel="stylesheet" media="screen" href="{{asset('css/extecult.css')}}">
        <link id="fontes" rel="stylesheet" media="screen" href="{{asset('css/fontes.css')}}">
        <link id="icones" rel="stylesheet" media="screen" href="{{asset('css/icones.css')}}">
        <link id="fontes-typekit" rel="stylesheet" href="https://use.typekit.net/tzw0dhy.css">

        <!-- Templates/plugins, etc -->
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="{{asset('smartadmin-4.5.1/css/vendors.bundle.css')}}">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="{{asset('smartadmin-4.5.1/css/app.bundle.css')}}">
        <link id="myskin" rel="stylesheet" media="screen, print" href="{{asset('smartadmin-4.5.1/css/themes/cust-theme-3.css')}}">
        <link id="customizado" rel="stylesheet" media="screen, print" href="{{asset('smartadmin-4.5.1/css/customizado.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{asset('smartadmin-4.5.1/css/fa-regular.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{asset('smartadmin-4.5.1/css/tagsinput.css')}}">

        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo-proec.png') }}">
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link id="stylesheetDatatable" media="screen, print" href="{{asset('smartadmin-4.5.1/css/datagrid/datatables/datatables.bundle.css')}}">
        <link id="stylesheetDatatable" media="screen, print" href="{{asset('smartadmin-4.5.1/css/formplugins/smartwizard/smartwizard.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{ asset('smartadmin-4.5.1/css/notifications/toastr/toastr.css') }}">
        <link rel="stylesheet" media="screen, print" href="{{ asset('smartadmin-4.5.1/css/fa-duotone.css') }}">
        <link rel="stylesheet" media="screen, print" href="{{ asset('smartadmin-4.5.1/css/select2.min.css') }}">
    </head>
    <!-- BEGIN Body -->
    <!-- Possible Classes

		* 'header-function-fixed'         - header is in a fixed at all times
		* 'nav-function-fixed'            - left panel is fixed
		* 'nav-function-minify'			  - skew nav to maximize space
		* 'nav-function-hidden'           - roll mouse on edge to reveal
		* 'nav-function-top'              - relocate left pane to top
		* 'mod-main-boxed'                - encapsulates to a container
		* 'nav-mobile-push'               - content pushed on menu reveal
		* 'nav-mobile-no-overlay'         - removes mesh on menu reveal
		* 'nav-mobile-slide-out'          - content overlaps menu
		* 'mod-bigger-font'               - content fonts are bigger for readability
		* 'mod-high-contrast'             - 4.5:1 text contrast ratio
		* 'mod-color-blind'               - color vision deficiency
		* 'mod-pace-custom'               - preloader will be inside content
		* 'mod-clean-page-bg'             - adds more whitespace
		* 'mod-hide-nav-icons'            - invisible navigation icons
		* 'mod-disable-animation'         - disables css based animations
		* 'mod-hide-info-card'            - hides info card from left panel
		* 'mod-lean-subheader'            - distinguished page header
		* 'mod-nav-link'                  - clear breakdown of nav links

		>>> more settings are described inside documentation page >>>
	-->
    <body class="mod-bg-1 ">
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /**
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /**
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...", "color: #ed1c24");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);

            }
            else if (themeSettings.themeURL && document.getElementById('mytheme'))
            {
                document.getElementById('mytheme').href = themeSettings.themeURL;
            }
            /**
             * Save to localstorage
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|footer|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /**
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
            @if(config('app.env') == 'testing')
                <div class="ambiente-teste alert alert-danger m-0 fs-xl"><strong class="">Ambiente de Teste</strong> - As informações salvas neste ambiente podem sofrer alterações, ou sumir, no decorrer dos testes</div>
            @endif
        <!-- BEGIN Page Wrapper -->

        <div class="page-wrapper">

            <div class="page-inner">

                <!-- BEGIN Left Aside -->
                @include('layouts._includes.sidebar')
                <!-- END Left Aside -->
                <div class="page-content-wrapper">

                <!-- BEGIN Page Header -->
                    @include('layouts._includes.header')
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        @yield('content')
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    @include('layouts._includes.footer')
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                    @include('layouts._includes.shortcuts')
                    <!-- END Shortcuts -->
                    <!-- BEGIN Color profile -->
                    <!-- this area is hidden and will not be seen on screens or screen readers -->
                    <!-- we use this only for CSS color refernce for JS stuff -->
                    <p id="js-color-profile" class="d-none">
                        <span class="color-primary-50"></span>
                        <span class="color-primary-100"></span>
                        <span class="color-primary-200"></span>
                        <span class="color-primary-300"></span>
                        <span class="color-primary-400"></span>
                        <span class="color-primary-500"></span>
                        <span class="color-primary-600"></span>
                        <span class="color-primary-700"></span>
                        <span class="color-primary-800"></span>
                        <span class="color-primary-900"></span>
                        <span class="color-info-50"></span>
                        <span class="color-info-100"></span>
                        <span class="color-info-200"></span>
                        <span class="color-info-300"></span>
                        <span class="color-info-400"></span>
                        <span class="color-info-500"></span>
                        <span class="color-info-600"></span>
                        <span class="color-info-700"></span>
                        <span class="color-info-800"></span>
                        <span class="color-info-900"></span>
                        <span class="color-danger-50"></span>
                        <span class="color-danger-100"></span>
                        <span class="color-danger-200"></span>
                        <span class="color-danger-300"></span>
                        <span class="color-danger-400"></span>
                        <span class="color-danger-500"></span>
                        <span class="color-danger-600"></span>
                        <span class="color-danger-700"></span>
                        <span class="color-danger-800"></span>
                        <span class="color-danger-900"></span>
                        <span class="color-warning-50"></span>
                        <span class="color-warning-100"></span>
                        <span class="color-warning-200"></span>
                        <span class="color-warning-300"></span>
                        <span class="color-warning-400"></span>
                        <span class="color-warning-500"></span>
                        <span class="color-warning-600"></span>
                        <span class="color-warning-700"></span>
                        <span class="color-warning-800"></span>
                        <span class="color-warning-900"></span>
                        <span class="color-success-50"></span>
                        <span class="color-success-100"></span>
                        <span class="color-success-200"></span>
                        <span class="color-success-300"></span>
                        <span class="color-success-400"></span>
                        <span class="color-success-500"></span>
                        <span class="color-success-600"></span>
                        <span class="color-success-700"></span>
                        <span class="color-success-800"></span>
                        <span class="color-success-900"></span>
                        <span class="color-fusion-50"></span>
                        <span class="color-fusion-100"></span>
                        <span class="color-fusion-200"></span>
                        <span class="color-fusion-300"></span>
                        <span class="color-fusion-400"></span>
                        <span class="color-fusion-500"></span>
                        <span class="color-fusion-600"></span>
                        <span class="color-fusion-700"></span>
                        <span class="color-fusion-800"></span>
                        <span class="color-fusion-900"></span>
                    </p>
                    <!-- END Color profile -->
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
        <!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
        @include('layouts._includes.quickmenu')
        <!-- END Quick Menu -->
        <!-- base vendor bundle:
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
        <script src="{{asset('smartadmin-4.5.1/js/vendors.bundle.js')}}"></script>
        <script src="{{asset('smartadmin-4.5.1/js/app.bundle.js')}}"></script>
        <script src="{{asset('smartadmin-4.5.1/js/formplugins/smartwizard/smartwizard.js')}}"></script>
        <script src="{{asset('smartadmin-4.5.1/js/datagrid/datatables/datatables.bundle.js')}}"></script>
        <script src="{{asset('smartadmin-4.5.1/js/datagrid/datatables/datatables.export.js')}}"></script>
        <script src="{{asset('smartadmin-4.5.1/js/upload.js')}}"></script>
        <script src="{{asset('smartadmin-4.5.1/js/tagsinput.js')}}"></script>
        <script src="{{asset('smartadmin-4.5.1/js/jquery.mask.js')}}"></script>
        <script src="{{asset('smartadmin-4.5.1/js/notifications/toastr/toastr.js')}}"></script>
        <script src="{{asset('smartadmin-4.5.1/js/statistics/sparkline/sparkline.bundle.js')}}"></script>
		<script src="{{asset('smartadmin-4.5.1/js/statistics/easypiechart/easypiechart.bundle.js')}}"></script>
		<script src="{{asset('smartadmin-4.5.1/js/statistics/flot/flot.bundle.js')}}"></script>
        <script src="{{ asset('smartadmin-4.5.1/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('smartadmin-4.5.1/js/select2.min.js') }}"></script>
        <script type="text/javascript">

            if($('#detalhes').length) {
                //console.log($('#ckeditor').length );
                CKEDITOR.replace('detalhes');
            }

            if($('#carta_apresentacao').length) {
                //console.log($('#ckeditor').length );
                CKEDITOR.replace('carta_apresentacao');
            }


            $(document).ready(function()
            {
                $("#online").change(function(){
                    if ( $('#online').is(':checked') ) {
                        $("#hibrido").prop('disabled', true);
                        $("#hibrido").prop('checked', false);
                    }
                    else {
                        $("#hibrido").removeAttr('disabled')
                    }
                });

                $("#hibrido").change(function(){
                    if ( $('#hibrido').is(':checked') ) {
                        $("#online").prop('disabled', true);
                        $("#online").prop('checked');
                    }
                    else {
                        $("#online").removeAttr('disabled', false);
                    }
                });

                $("#inscricao").change(function(){
                    if ( $('#inscricao').is(':checked') ) {
                        $("#evento_inscricao").removeClass('d-none')
                    }
                    else {
                        $("#evento_inscricao").addClass('d-none');
                        $("#inscricao_inicio").val('');
                        $("#inscricao_fim").val('');
                        $("#vagas").val('');
                        $("#ck_documento").prop('checked', false);
                        $("#ck_sexo").prop('checked', false);
                        $("#ck_identidade_genero").prop('checked', false);
                        $("#ck_nascimento").prop('checked', false);
                        $("#ck_instituicao").prop('checked', false);
                        $("#ck_vinculo").prop('checked', false);
                        $("#ck_area").prop('checked', false);
                        $("#ck_funcao").prop('checked', false);
                        $("#ck_pais").prop('checked', false);
                        $("#ck_cidade_estado").prop('checked', false);

                    }
                });

                $("#certificado").change(function(){
                    if ( $('#certificado').is(':checked') ) {
                        $("#evento_certificado").removeClass('d-none')
                    }
                    else {
                        $("#evento_certificado").addClass('d-none');
                        $("#doc_certificado").prop('checked', false);
                        $("#enviar_modelo").prop('checked', false);
                        $("#carregar_modelo").addClass('d-none');
                        $(".box-body").empty();
                        $(".preview-zone").addClass('hidden');
                        $("#carga_horaria").val('');
                    }
                });

                $("#curricularizar").change(function(){
                    if ( $('#curricularizar').is(':checked') ) {
                        $("#acao_curricularizacao").removeClass('d-none')
                        $("#vagas_curricularizacao").prop('required', true);
                        $("#qtd_horas_curricularizacao").prop('required', true);
                    }
                    else {
                        $("#acao_curricularizacao").addClass('d-none');
                        $("#vagas_curricularizacao").prop('required', false);
                        $("#qtd_horas_curricularizacao").prop('required', false);
                        $("#acao_curricularizacao").addClass('d-none');
                        $("#vagas_curricularizacao").val('');
                        $("#qtd_horas_curricularizacao").val('');
                    }
                });

                $("#vagas").change(function(){
                    if($("#vagas").val() < 0) {
                        $("#vagas").val('');
                    }
                });

                $("#carga_horaria").change(function(){
                    if($("#carga_horaria").val() < 0) {
                        $("#carga_horaria").val('');
                    }
                });

                $("#ck_arquivo").change(function() {
                    if($("#ck_arquivo").is(':checked')) {
                        $("#div_prazo_envio_arquivo").removeClass("d-none");
                        $("#div_prazo_envio_arquivo").addClass("d-block");
                    }
                    else {
                        $("#div_prazo_envio_arquivo").removeClass("d-block");
                        $("#div_prazo_envio_arquivo").addClass("d-none");
                    }
                });

                $("#enviar_modelo").change(function(){
                    if ( $('#enviar_modelo').is(':checked') ) {
                        $("#carregar_modelo").removeClass('d-none')
                    }
                    else {
                        $("#carregar_modelo").addClass('d-none')
                    }
                });

                $("#funcionario_unicamp").change(() => {
                    if ( $('#funcionario_unicamp').is(':checked') ) {
                        $("#funcionario_unicamp_label").html('Sim');
                        $("#user_form_group").removeClass("d-none");
                        $("#user_form_group").addClass("d-block");
                    }
                    else {
                        $("#funcionario_unicamp_label").html('Não');
                        $("#user_form_group").removeClass("d-block");
                        $("#user_form_group").addClass("d-none");
                    }
                });

                $("#aluno_unicamp").change(() => {
                    if ( $('#aluno_unicamp').is(':checked') ) {
                        $("#aluno_unicamp_label").html('Sim');
                        $("#user_form_group").removeClass("d-none");
                        $("#user_form_group").addClass("d-block");
                    }
                    else {
                        $("#aluno_unicamp_label").html('Não');
                        $("#user_form_group").removeClass("d-block");
                        $("#user_form_group").addClass("d-none");
                    }
                });

                $("#deficiencia").change(() => {
                    if ( $('#deficiencia').val() == 'Sim') {
                        $("#div_desc_deficiencia").removeClass("d-none");
                        $("#div_desc_deficiencia").addClass("d-block");
                    }
                    else {
                        $("#desc_deficiencia").html('');
                        $("#div_desc_deficiencia").removeClass("d-block");
                        $("#div_desc_deficiencia").addClass("d-none");
                    }
                });



                $("#data_fim").blur(function(){
                    var dt_inicio = new Date($("#data_inicio").val())
                    var dt_fim = new Date($("#data_fim").val())
                    var dt_atual = new Date()
                    if(dt_fim < dt_inicio || dt_fim < dt_atual) {
                        $("#msg_erro_data_fim").html("A data fim não pode ser antes da data início");
                        $("#data_fim").val('');
                    }
                    else {
                        $("#msg_erro_data_fim").html('');
                    }
                });

                $('#data_inicio').blur(() => {
                    dt_atual = new Date();
                    dt_inicio = new Date($('#data_inicio').val());
                    if(dt_inicio < dt_atual) {
                        $("#data_inicio").val('');
                        $("#msg_erro_data_inicio").html('Data de início não pode ser no passado');
                    }
                    else {
                        $("#msg_erro_data_inicio").html('');
                    }
                });

                $('#inscricao_inicio').blur(() => {
                    dt_atual = new Date();
                    dt_inicio = new Date($('#inscricao_inicio').val());
                    if(dt_inicio < dt_atual) {
                        $("#inscricao_inicio").val('');
                        $("#msg_erro_inscricao_inicio").html('Data de início das inscrições não pode ser no passado');
                    }
                    else {
                        $("#msg_erro_inscricao_inicio").html('');
                    }
                });

                $("#inscricao_fim").blur(function(){
                    var dt_inicio = new Date($("#inscricao_inicio").val())
                    var dt_fim = new Date($("#inscricao_fim").val())
                    var dt_atual = new Date()
                    if(dt_fim < dt_inicio || dt_fim < dt_atual) {
                        $("#msg_erro_inscricao_fim").html("A data fim data inscrição não pode ser antes da data de início das incrições");
                        $("#inscricao_fim").val('');
                    }
                    else {
                        $("#msg_erro_inscricao_fim").html('');
                    }
                });

                $('#prazo_envio_arquivo').blur(() => {
                    dt_atual = new Date();
                    dt_prazo_envio = new Date($('#prazo_envio_arquivo').val());
                    if(dt_prazo_envio < dt_atual) {
                        $("#prazo_envio_arquivo").val('');
                        $("#msg_erro_prazo_envio_arquivo").html('Data de início das inscrições não pode ser no passado');
                    }
                    else {
                        $("#msg_erro_prazo_envio_arquivo").html('');
                    }

                    console.log(dt_prazo_envio);
                });

                $("#inscricao_fim").blur(function(){
                    var data1 = new Date($("#inscricao_inicio").val())
                    var data2 = new Date($("#inscricao_fim").val())
                    if(data1 > data2) {
                        $("#msg_erro_inscricao_inicio").html("A data de inicio da inscrição não pode ser menor que a data fim da inscrição");
                        $("#inscricao_inicio").val('');
                        $("#inscricao_fim").val('');
                    }else {
                        $("#msg_erro_inscricao_inicio").html('');
                    }
                });

                $('#user_id').change(function(){
                    $.ajax({
                        url: "{{ url('usuarios/get-data') }}" + "/" + $("#user_id").val(),
                        method: "GET",
                        dataType: 'json',
                        data: { },
                        success: function(data) {
                            $("#nome").val(data.name);
                            $("#email").val(data.email);
                        }
                    });
                });

                if ( $( "#checked-modal" ).length ) {
                    $('#checked-modal').modal('show');

                    setInterval(() => {
                        $('#checked-modal').modal('hide');
                    }, @if(isset($inscrito) && $inscrito->confirmacao == 2) 2500 @else 3500 @endif);
                }

                $('#dt-eventos-abertos').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('#dt-eventos-abertos-comissao').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('#dt-eventos-encerrados').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('#dt-eventos-cancelados').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('#dt-inscritos-espera').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('#dt-inscritos-nao-confirmados').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('#dt-inscritos-confirmados-adm').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('#dt-inscritos-confirmados-comissao').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('#dt-inscritos-cancelados').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('#dt-inscrito-historico').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true,
                    paging: false,
                    searching: false,
                    info: false

                });

                $('#dt-usuarios').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    order: [[0,'asc']],
                    responsive: true
                });

                $('.js-thead-colors a').on('click', function()
                {
                    var theadColor = $(this).attr("data-bg");
                    console.log(theadColor);
                    $('#dt-usuarios thead').removeClassPrefix('bg-').addClass(theadColor);
                });

                $('.js-tbody-colors a').on('click', function()
                {
                    var theadColor = $(this).attr("data-bg");
                    console.log(theadColor);
                    $('#dt-usuarios').removeClassPrefix('bg-').addClass(theadColor);
                });

                $('#dt-unidades').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('#dt-orcamento').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true,
                    dom:
                        /*	--- Layout Structure
                        	--- Options
                        	l	-	length changing input control
                        	f	-	filtering input
                        	t	-	The table!
                        	i	-	Table information summary
                        	p	-	pagination control
                        	r	-	processing display element
                        	B	-	buttons
                        	R	-	ColReorder
                        	S	-	Select

                        	--- Markup
                        	< and >				- div element
                        	<"class" and >		- div with a class
                        	<"#id" and >		- div with an ID
                        	<"#id.class" and >	- div with an ID and a class

                        	--- Further reading
                        	https://datatables.net/reference/option/dom
                        	--------------------------------------
                         */
                        "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'l>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p><'col-sm-12 col-md-2 d-flex align-items-center justify-content-end'B>>",
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            text: 'Exportar para Excel',
                            titleAttr: 'Generate Excel',
                            className: 'btn-outline-success btn-sm mr-1'
                        },
                    ]
                });

                $('#dt-propostas').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('#dt-participantes').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('#dt-classificacao').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                $('.js-thead-colors a').on('click', function()
                {
                    var theadColor = $(this).attr("data-bg");
                    console.log(theadColor);
                    $('#dt-unidades thead').removeClassPrefix('bg-').addClass(theadColor);
                });

                $('.js-tbody-colors a').on('click', function()
                {
                    var theadColor = $(this).attr("data-bg");
                    console.log(theadColor);
                    $('#dt-unidades').removeClassPrefix('bg-').addClass(theadColor);
                });

                $('#dt-indicadores').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true,
                    dom:
                        /*	--- Layout Structure
                        	--- Options
                        	l	-	length changing input control
                        	f	-	filtering input
                        	t	-	The table!
                        	i	-	Table information summary
                        	p	-	pagination control
                        	r	-	processing display element
                        	B	-	buttons
                        	R	-	ColReorder
                        	S	-	Select

                        	--- Markup
                        	< and >				- div element
                        	<"class" and >		- div with a class
                        	<"#id" and >		- div with an ID
                        	<"#id.class" and >	- div with an ID and a class

                        	--- Further reading
                        	https://datatables.net/reference/option/dom
                        	--------------------------------------
                         */
                        "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'l>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p><'col-sm-12 col-md-2 d-flex align-items-center justify-content-end'B>>",
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            text: 'Exportar para Excel',
                            titleAttr: 'Generate Excel',
                            className: 'btn-outline-success btn-sm mr-1'
                        },
                    ]
                });


                $('#dt-classificados').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true,
                    dom:
                        /*	--- Layout Structure
                        	--- Options
                        	l	-	length changing input control
                        	f	-	filtering input
                        	t	-	The table!
                        	i	-	Table information summary
                        	p	-	pagination control
                        	r	-	processing display element
                        	B	-	buttons
                        	R	-	ColReorder
                        	S	-	Select

                        	--- Markup
                        	< and >				- div element
                        	<"class" and >		- div with a class
                        	<"#id" and >		- div with an ID
                        	<"#id.class" and >	- div with an ID and a class

                        	--- Further reading
                        	https://datatables.net/reference/option/dom
                        	--------------------------------------
                         */
                        "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'l>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p><'col-sm-12 col-md-2 d-flex align-items-center justify-content-end'B>>",
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            text: 'Exportar para Excel',
                            titleAttr: 'Generate Excel',
                            className: 'btn-outline-success btn-sm mr-1'
                        },
                    ]
                });


                $('#dt-indicadores_filter').addClass('form-inline');
                $('#dt-indicadores_length').addClass('form-inline');

                $('#dt-acoes-extensao').dataTable(
                {
                    language: {
                        url: "{{ asset('/smartadmin-4.5.1/js/pt_BR.json') }}",
                    },
                    responsive: true
                });

                // Smart Wizard
                $('#smartwizard').smartWizard(
                {
                    selected: 0, // Initial selected step, 0 = first step
                    keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                    autoAdjustHeight: false, // Automatically adjust content height
                    cycleSteps: false, // Allows to cycle the navigation of steps
                    backButtonSupport: true, // Enable the back button support
                    useURLhash: false, // Enable selection of the step based on url hash
                    showStepURLhash: false,
                    lang:
                    { // Language variables
                        next: 'Próximo',
                        previous: 'Anterior'
                    },
                    toolbarSettings:
                    {
                        toolbarPosition: 'bottom', // none, top, bottom, both
                        toolbarButtonPosition: 'right', // left, right
                        showNextButton: true, // show/hide a Next button
                        showPreviousButton: true, // show/hide a Previous button
                        toolbarExtraButtons: [
                        $('<button></button>').text('Salvar')
                                    .addClass('btn btn-primary btn-user btn-block btn-verde')
                                    .on('click', function(){
                                    //alert('Finsih button click');
                                    }),
                        // $('<button></button>').text('Cancelar')
                        //             .addClass('btn btn-danger')
                        //             .on('click', function(){
                        //             alert('Cancel button click');
                        //             })
                        ]
                    },
                    anchorSettings:
                    {
                        anchorClickable: true, // Enable/Disable anchor navigation
                        enableAllAnchors: true, // Activates all anchors clickable all times
                        markDoneStep: true, // add done css
                        enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                    },
                    contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
                    contentCache: true, //ajax content
                    disabledSteps: [], // Array Steps disabled
                    errorSteps: [], // Highlight step with errors
                    theme: 'dots', //dots, default, circles
                    transitionEffect: 'fade', // Effect on navigation, none/slide/fade
                    transitionSpeed: '400'
                });

                // Smart Wizard
                $('#swproposta').smartWizard(
                {
                    selected: 0, // Initial selected step, 0 = first step
                    keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                    autoAdjustHeight: false, // Automatically adjust content height
                    cycleSteps: true, // Allows to cycle the navigation of steps
                    backButtonSupport: true, // Enable the back button support
                    useURLhash: false, // Enable selection of the step based on url hash
                    showStepURLhash: false,
                    lang:
                    { // Language variables
                        next: 'Próximo',
                        previous: 'Anterior'
                    },
                    toolbarSettings:
                    {
                        toolbarPosition: 'bottom', // none, top, bottom, both
                        toolbarButtonPosition: 'right', // left, right
                        showNextButton: true, // show/hide a Next button
                        showPreviousButton: true, // show/hide a Previous button
                        toolbarExtraButtons: [
                        $('<button></button>').text('Salvar')
                                    .addClass('btn btn-primary btn-pills waves-effect btn-salvar')
                                    .prop('disabled', true)
                                    .on('click', function(){
                                        $(this).text('');
                                        $(this).append('<div class="spinner-border spinner-border-sm spin" role="status"><span class="sr-only">Loading...</span></div>');
                                        $(this).append('<span> Loading...</span>');
                                        $(this).prop('disabled', true);
                                        $('#form_proposta').submit();
                                    }),
                        // $('<button></button>').text('Cancelar')
                        //             .addClass('btn btn-danger')
                        //             .on('click', function(){
                        //             alert('Cancel button click');
                        //             })
                        ]
                    },
                    anchorSettings:
                    {
                        anchorClickable: true, // Enable/Disable anchor navigation
                        enableAllAnchors: true, // Activates all anchors clickable all times
                        markDoneStep: true, // add done css
                        enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                    },
                    contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
                    contentCache: true, //ajax content
                    disabledSteps: [], // Array Steps disabled
                    errorSteps: [], // Highlight step with errors
                    theme: 'default', //dots, default, circles
                    transitionEffect: 'fade', // Effect on navigation, none/slide/fade
                    transitionSpeed: '400'
                });

                // Smart Wizard
                $('#swpropostashow').smartWizard(
                {
                    selected: 0, // Initial selected step, 0 = first step
                    keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                    autoAdjustHeight: false, // Automatically adjust content height
                    cycleSteps: true, // Allows to cycle the navigation of steps
                    backButtonSupport: true, // Enable the back button support
                    useURLhash: false, // Enable selection of the step based on url hash
                    showStepURLhash: false,
                    lang:
                    { // Language variables
                        next: 'Próximo',
                        previous: 'Anterior'
                    },
                    toolbarSettings:
                    {
                        toolbarPosition: 'bottom', // none, top, bottom, both
                        toolbarButtonPosition: 'right', // left, right
                        showNextButton: true, // show/hide a Next button
                        showPreviousButton: true, // show/hide a Previous button
                        toolbarExtraButtons: [
                            $('<button></button>').text( @if( (isset($avaliacaoResposta['analise']) && $avaliacaoResposta['analise'] == true )  ) 'Finalizar' @elseif( (isset($avaliacaoResposta['parecerista']) && $avaliacaoResposta['parecerista'] == true) || (isset($avaliacaoResposta['comissao1']) && $avaliacaoResposta['comissao1'] == true) ) 'Avaliar' @else 'Voltar' @endif )
                                    .addClass('btn btn-primary btn-block')
                                    .on('click', function(){
                                        @if(isset($avaliacaoResposta['analise']) && $avaliacaoResposta['analise'] == true)
                                            $('#analiseModal').modal('show');
                                        @elseif((isset($avaliacaoResposta['parecerista']) && $avaliacaoResposta['parecerista'] == true) || (isset($avaliacaoResposta['comissao1']) && $avaliacaoResposta['comissao1'] == true))
                                            $(this).text('');
                                            $(this).append('<div class="spinner-border spinner-border-sm spin" role="status"><span class="sr-only">Loading...</span></div>');
                                            $(this).append('<span> Loading...</span>');
                                            $(this).prop('disabled', true);
                                            window.location.replace('{{ url("/inscricao/$inscricao->id/avaliacao") }}');
                                        @else
                                            history.back();
                                        @endif
                                    }),
                        // $('<button></button>').text('Cancelar')
                        //             .addClass('btn btn-danger')
                        //             .on('click', function(){
                        //             alert('Cancel button click');
                        //             })
                        ]
                    },
                    anchorSettings:
                    {
                        anchorClickable: true, // Enable/Disable anchor navigation
                        enableAllAnchors: true, // Activates all anchors clickable all times
                        markDoneStep: true, // add done css
                        enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                    },
                    contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
                    contentCache: true, //ajax content
                    disabledSteps: [], // Array Steps disabled
                    errorSteps: [], // Highlight step with errors
                    theme: 'default', //dots, default, circles
                    transitionEffect: 'fade', // Effect on navigation, none/slide/fade
                    transitionSpeed: '400'
                });

                // Smart Wizard
                $('#swpropostaanalise').smartWizard(
                {
                    selected: 0, // Initial selected step, 0 = first step
                    keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                    autoAdjustHeight: false, // Automatically adjust content height
                    cycleSteps: true, // Allows to cycle the navigation of steps
                    backButtonSupport: true, // Enable the back button support
                    useURLhash: false, // Enable selection of the step based on url hash
                    showStepURLhash: false,
                    lang:
                    { // Language variables
                        next: 'Próximo',
                        previous: 'Anterior'
                    },
                    toolbarSettings:
                    {
                        toolbarPosition: 'bottom', // none, top, bottom, both
                        toolbarButtonPosition: 'right', // left, right
                        showNextButton: true, // show/hide a Next button
                        showPreviousButton: true, // show/hide a Previous button
                        toolbarExtraButtons: [
                        $('<button></button>').text('Finalizar')
                                    .addClass('btn btn-primary btn-user btn-block btn-verde')
                                    .on('click', function(){
                                    $('#analiseModal').modal('show');
                                    }),
                        // $('<button></button>').text('Cancelar')
                        //             .addClass('btn btn-danger')
                        //             .on('click', function(){
                        //             alert('Cancel button click');
                        //             })
                        ]
                    },
                    anchorSettings:
                    {
                        anchorClickable: true, // Enable/Disable anchor navigation
                        enableAllAnchors: true, // Activates all anchors clickable all times
                        markDoneStep: true, // add done css
                        enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                    },
                    contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
                    contentCache: true, //ajax content
                    disabledSteps: [], // Array Steps disabled
                    errorSteps: [], // Highlight step with errors
                    theme: 'default', //dots, default, circles
                    transitionEffect: 'fade', // Effect on navigation, none/slide/fade
                    transitionSpeed: '400'
                });

                // Smart Wizard
                $('#swpropostaavaliacao').smartWizard(
                {
                    selected: 0, // Initial selected step, 0 = first step
                    keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                    autoAdjustHeight: false, // Automatically adjust content height
                    cycleSteps: true, // Allows to cycle the navigation of steps
                    backButtonSupport: true, // Enable the back button support
                    useURLhash: false, // Enable selection of the step based on url hash
                    showStepURLhash: false,
                    lang:
                    { // Language variables
                        next: 'Próximo',
                        previous: 'Anterior'
                    },
                    toolbarSettings:
                    {
                        toolbarPosition: 'bottom', // none, top, bottom, both
                        toolbarButtonPosition: 'right', // left, right
                        showNextButton: true, // show/hide a Next button
                        showPreviousButton: true, // show/hide a Previous button
                        toolbarExtraButtons: [
                        $('<button></button>').text('Finalizar')
                                    .addClass('btn btn-primary btn-user btn-block btn-verde')
                                    .on('click', function(){
                                    $('#analiseModal').modal('show');
                                    }),
                        // $('<button></button>').text('Cancelar')
                        //             .addClass('btn btn-danger')
                        //             .on('click', function(){
                        //             alert('Cancel button click');
                        //             })
                        ]
                    },
                    anchorSettings:
                    {
                        anchorClickable: true, // Enable/Disable anchor navigation
                        enableAllAnchors: true, // Activates all anchors clickable all times
                        markDoneStep: true, // add done css
                        enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                    },
                    contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
                    contentCache: true, //ajax content
                    disabledSteps: [], // Array Steps disabled
                    errorSteps: [], // Highlight step with errors
                    theme: 'default', //dots, default, circles
                    transitionEffect: 'fade', // Effect on navigation, none/slide/fade
                    transitionSpeed: '400'
                });

                $('#nova_questao').click(function(){
                    $(`#div_nova_questao`).removeClass('d-none');
                    $(`#div_questao_existente`).addClass('d-none');
                    $(`#nova_questao`).addClass('d-none');
                    $(`#questao_existente`).removeClass('d-none');
                });

                $('#questao_existente').click(function(){
                    $(`#div_nova_questao`).addClass('d-none');
                    $(`#div_questao_existente`).removeClass('d-none');
                    $(`#nova_questao`).removeClass('d-none');
                    $(`#questao_existente`).addClass('d-none');
                });

                $("#parceria_sim").click(function() {
                    if($("#parceria_sim").val() == 'Sim') {
                        $("#arquivo_parceria").removeClass("d-none");
                        $("#arquivo_parceria").addClass("d-block");
                    }
                });

                $("#parceria_nao").click(function() {
                    if($("#parceria_nao").val() == 'Não') {
                        $("#arquivo_parceria").removeClass("d-block");
                        $("#arquivo_parceria").addClass("d-none");
                    }
                });

                $('#status').change(function() {
                    if( $('#status').val() == 'Indeferido' ) {
                        $("#criterios").removeClass("d-none");
                        $("#criterios").addClass("d-block");
                        $("#alerta-justificativa").addClass("d-none");
                    }
                    else {
                        $("#criterios").removeClass("d-block");
                        $("#criterios").addClass("d-none");
                        $("#alerta-justificativa").removeClass("d-none");
                    }
                });

                $('#tipo').change(function(){
                    if( $('#tipo').val() == 'PEX' ) {
                        $("#div_valor_programa").removeClass("d-none");
                        $("#div_valor_programa").addClass("d-block");
                    }
                    else {
                        $("#div_valor_programa").removeClass("d-block");
                        $("#div_valor_programa").addClass("d-none");
                    }
                });

                $('#total_recurso').mask("#.##0,00", {reverse: true});
                $('#valor_max_inscricao').mask("#.##0,00", {reverse: true});
                $('#valor_max_programa').mask("#.##0,00", {reverse: true});
                $('#valor').mask("#.##0,00", {reverse: true});
                $('#total_orcamento_realizado').mask("#.##0,00", {reverse: true});

                $('#investimento').mask("#.##0,00", {reverse: true});

                //Eventos
                $('#valor_inscricao').mask("#.##0,00", {reverse: true});

                $("#gratuito").change(() => {
                    if ( $('#gratuito').is(':checked') ) {
                        $("#div_valor_inscricao").removeClass("d-block");
                        $("#div_valor_inscricao").addClass("d-none");
                    }
                    else {
                        $("#div_valor_inscricao").removeClass("d-none");
                        $("#div_valor_inscricao").addClass("d-block");
                    }
                });

                toastr.options = {
                    closeButton: true,
                    debug: false,
                    newestOnTop: true,
                    progressBar: true,
                    rtl: false,
                    positionClass: 'toast-top-full-width',
                    preventDuplicates: true,
                    onclick: null
                };

                @if( session('alert') == 'success')
                    toastr.success('{{ session('status') }}');
                @elseif( session('alert') == 'danger')
                    toastr.error('{{ session('status') }}');
                @elseif( session('alert') == 'warning')
                    toastr.warning('{{ session('status') }}');
                @endif

                @php
                    session()->forget('alert');
                    session()->forget('status');
                @endphp

                @if($errors->any())
                    var content = '';
                    @foreach($errors->all() as $error)
                        content+='<li>{{ $error }}</li>'
                    @endforeach

                    toastr.error('<ul>' + content + '</ul>');
                @endif

                $('#sw_acao_extensao').smartWizard(
                {
                    selected: 0, // Initial selected step, 0 = first step
                    keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                    autoAdjustHeight: false, // Automatically adjust content height
                    cycleSteps: true, // Allows to cycle the navigation of steps
                    backButtonSupport: true, // Enable the back button support
                    useURLhash: false, // Enable selection of the step based on url hash
                    showStepURLhash: false,
                    lang:
                    { // Language variables
                        next: 'Próximo',
                        previous: 'Anterior'
                    },
                    toolbarSettings:
                    {
                        toolbarPosition: 'bottom', // none, top, bottom, both
                        toolbarButtonPosition: 'right', // left, right
                        showNextButton: true, // show/hide a Next button
                        showPreviousButton: true, // show/hide a Previous button
                        toolbarExtraButtons: [
                        $('<button></button>').text('Salvar')
                                    .addClass('btn btn-primary btn-user btn-block btn-verde')
                                    .on('click', function(){
                                        $(this).text('');
                                        $(this).append('<div class="spinner-border spinner-border-sm spin" role="status"><span class="sr-only">Loading...</span></div>');
                                        $(this).append('<span> Loading...</span>');
                                        $(this).prop('disabled', true);
                                        $('#form_acao_extensao').submit();
                                    }),
                        // $('<button></button>').text('Cancelar')
                        //             .addClass('btn btn-danger')
                        //             .on('click', function(){
                        //             alert('Cancel button click');
                        //             })
                        ]
                    },
                    anchorSettings:
                    {
                        anchorClickable: true, // Enable/Disable anchor navigation
                        enableAllAnchors: true, // Activates all anchors clickable all times
                        markDoneStep: true, // add done css
                        enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                    },
                    contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
                    contentCache: true, //ajax content
                    disabledSteps: [], // Array Steps disabled
                    errorSteps: [], // Highlight step with errors
                    theme: 'default', //dots, default, circles
                    transitionEffect: 'fade', // Effect on navigation, none/slide/fade
                    transitionSpeed: '400'
                });

                $('#aviso-modal').modal('show');

                $('.step-4').click(function(){
                    $('.btn-salvar').prop('disabled', false);
                });

                $('.step').click(function(){
                    $('.btn-salvar').prop('disabled', true);
                });

                $('.sw-btn-next').click(function(){
                    if($('.step-4').hasClass('active')) {
                        $('.btn-salvar').prop('disabled', false);
                    }
                    else {
                        $('.btn-salvar').prop('disabled', true);
                    }
                });

                $('.sw-btn-prev').click(function(){
                    if($('.step-4').hasClass('active')) {
                        $('.btn-salvar').prop('disabled', false);
                    }
                    else {
                        $('.btn-salvar').prop('disabled', true);
                    }
                });

            });

            $('#estado').change(function(){

                $.ajax({
                    url: "{{ url('get-municipios-by-uf') }}",
                    method: "GET",
                    dataType: 'json',
                    data: { _token : $('meta[name="csrf-token"]').attr('content'), uf: $('#estado').val() },
                    success: function(data) {
                        var content = '';

                        data.map(municipio => {
                            content += `<option value="${municipio.id}">${municipio.nome_municipio}</option>`;
                        });

                        $('#cidade').html(content);
                    }
                });
            });

            $('#subcomissao_tematica').change(function(){

                $.ajax({
                    url: "{{ url('get-avaliador-by-subcomissao') }}",
                    method: "GET",
                    dataType: 'json',
                    data: { _token : $('meta[name="csrf-token"]').attr('content'), subcomissao_id: $('#subcomissao_tematica').val() },
                    success: function(data) {
                        var content = '';

                        data.map(avaliador => {
                            content += `<option value="${avaliador.id}">${avaliador.name}</option>`;
                        });

                        $('#avaliador').html(content);
                    }
                });
            });

            $('#tipo_item').change(function(){

                $.ajax({
                    url: "{{ url('get-item-by-id') }}",
                    method: "GET",
                    dataType: 'json',
                    data: { _token : $('meta[name="csrf-token"]').attr('content'), tipo_item: $('#tipo_item').val() },
                    success: function(data) {
                        var content = '';

                        data.map(item => {
                            content += `<option value="${item.id}">${item.nome}</option>`;
                        });

                        $('#item').html(content);
                    }
                });
            });

            function enableDateInput(id, element){
                if ($(element).is(':checked')) {
                    $(`#${id}`).removeClass('disabled');
                }
                else {
                    $(`#${id}`).addClass('disabled');
                }

            }

            $('.loading-questao-existente').on('click',function(){
                var $spin = $(".spin");
                $('.loading-questao-existente').prop('disabled', true);
                $spin.removeClass('d-none');
                $(".spin-text-questao-existente").text('Loading...');

                $('#div_questao_existente').submit();

                setTimeout(function(){
                    $('.loading-questao-existente').prop('disabled', false);
                    $spin.addClass('d-none');

                    $(".spin-text-questao-existente").text('Adicionar');

                },10000);

            });

            $('.loading-nova-questao').on('click',function(){
                var $spin = $(".spin");
                $('.loading-nova-questao').prop('disabled', true);
                $spin.removeClass('d-none');
                $(".spin-text-nova-questao").text('Loading...');

                $('#div_nova_questao').submit();

                setTimeout(function(){
                    $('.loading-nova-questao').prop('disabled', false);
                    $spin.addClass('d-none');

                    $(".spin-text-nova-questao").text('Adicionar');

                },10000);

            });

            $('.loading').on('click',function(){
                var $spin = $(".spin");
                $('.loading').prop('disabled', true);
                $spin.removeClass('d-none');
                $(".spin-text").text('Loading...');

                if($('#form-criterios')) {
                    $('#form-criterios').submit();
                }

                if($('#form-divulgar')) {
                    $('#form-divulgar').submit();
                }

                if($('#form-edital')) {
                    $('#form-edital').submit();
                }

                if($('#form-avaliadores')) {
                    $('#form-avaliadores').submit();
                }

                if($('#form-analise')) {
                    $('#form-analise').submit();
                }

                if($('#form-cronograma')) {
                    $('#form-cronograma').submit();
                }

                if($('#form-orcamento')) {
                    $('#form-orcamento').submit();
                }

                setTimeout(function(){
                    $('.loading').prop('disabled', false);
                    $spin.addClass('d-none');

                    if($('#form-criterios')) {
                        $(".spin-text").text('Salvar');
                    }

                    if($('#form-divulgar')) {
                        $(".spin-text").text('Divulgar');
                    }

                    if($('#form-edital')) {
                        @if(isset($edital))
                            $(".spin-text").text('Atualizar');
                        @else
                            $(".spin-text").text('Salvar');
                        @endif
                    }

                    if($('#form-avaliadores')) {
                        $(".spin-text").text('Adicionar');
                    }

                    if($('#form-cronograma')) {
                        @if(isset($edital) && !empty($edital->cronogramas->toArray()))
                            $(".spin-text").text('Atualizar');
                        @else
                            $(".spin-text").text('Salvar');
                        @endif
                    }

                    if($('#form-orcamento')) {
                        $(".spin-text").text('Inserir Item');
                    }

                    if($('#form-analise')) {
                        $(".spin-text").text('Enviar');
                    }

                },10000);
            });

            $('#btn-submeter').click(function(){
                let text = "Após a submissão não será possível alterar a inscrição. Deseja submeter?";
                if (confirm(text) == true) {
                    $('#form-submeter').submit();
                }
            });

            $("#indicadores-parametros-editar-btn").click(function(){
                $('#ano_base').prop('readonly', false);
                $('#ano_base').removeClass('disabled');
                $('#data_limite').prop('readonly', false);
                $('#data_limite').removeClass('disabled');
                $('#indicadores-parametros-editar-btn').prop('disabled', true);
                $('#indicadores-parametros-salvar-btn').prop('disabled', false);
            });

            $("#indicadores-parametros-salvar-btn").click(function(){
                $('#indicadores-parametros-form').submit();
            });

            $(document).on("input", "#resumo", function () {
                var limite = 2500;
                var caracteresDigitados = $(this).val().length;
                var caracteresRestantes = limite - caracteresDigitados;

                $(".caracteres-resumo").text(caracteresRestantes + ' Caracteres restantes');
            });

            function contadorCaracteresFaltantes(id)
            {
                var limite = 10000;
                var caracteresDigitados = document.querySelector(`#${id}`).value.length;
                var caracteresRestantes = limite - caracteresDigitados;
                document.querySelector(`.caracteres-${id}`).innerHTML = caracteresRestantes + ' Caracteres restantes';
            }

            $('#georreferenciacao').click(function(){
                $('#modal-inserir-local').modal('show') ;
            });

            $('#btn-limpar-geo').click(function(){
                $('#georreferenciacao').text('');
                $('#modal-inserir-local').modal('hide') ;
            });

            $('#btn-inserir-local').click(function(){
                var campo1 = $('#info_local').val();
                var campo2 = $('#lat_local').val();
                var campo3 = $('#long_local').val();
                var geo = $('#georreferenciacao').text();
                if (campo1 != '' && campo2 != '' && campo3 != ''){
                    $('#georreferenciacao').text(geo + campo1 + ', ' + campo2 + ', ' +  campo3 + '; ');
                    $('#info_local').val('');
                    $('#lat_local').val('');
                    $('#long_local').val('');
                    $('#modal-inserir-local').modal('hide') ;
                }
            });

            $('#unidades_envolvidas').click(function(){
                $('#modal-inserir-unidade').modal('show') ;
            });

            $('#btn-limpar-unidade').click(function(){
                $('#unidades_envolvidas').text('');
                $('#modal-inserir-unidade').modal('hide') ;
            });

            $('#btn-inserir-unidade').click(function(){
                var campo1 = $('#unidade_selecao').val();
                var unidades = $('#unidades_envolvidas').text();
                if (campo1 != ''){
                    $('#unidades_envolvidas').text(unidades + campo1 + '; ');
                    $('#unidade_selecao').val('');
                    $('#modal-inserir-unidade').modal('hide') ;
                }
            });

            $('#selecao_segmento').change(function(){
                var valorSelecao = $(this).val();
                if(valorSelecao != ""){
                    $('#segmento_cultural').val(valorSelecao);
                    $('#segmento_cultural').prop( "readonly", true );
                } else {
                    $('#segmento_cultural').val('');
                    $('#segmento_cultural').prop( "readonly", false );
                }
            });

            $('#btn_limpar').click(function(){
                $('#selecao_segmento').val('');
                $('#segmento_cultural').val('');
                $('#segmento_cultural').prop( "readonly", false );
            });

            $("#ckensino").change(function() {
                if($(this).prop('checked')) {
                    $('#vinculo_ensino').prop( "disabled", false );
                    $('#lbl_vinculo_ensino').removeClass( "text-muted" );
                } else {
                    $('#vinculo_ensino').val('');
                    $('#vinculo_ensino').prop( "disabled", true );
                    $('#lbl_vinculo_ensino').addClass( "text-muted" );
                }
            });

            $("#ckpesquisa").change(function() {
                if($(this).prop('checked')) {
                    $('#vinculo_pesquisa').prop( "disabled", false );
                    $('#lbl_vinculo_pesquisa').removeClass( "text-muted" );
                } else {
                    $('#vinculo_pesquisa').val('');
                    $('#vinculo_pesquisa').prop( "disabled", true );
                    $('#lbl_vinculo_pesquisa').addClass( "text-muted" );
                }
            });

            $("#ckextensao").change(function() {
                if($(this).prop('checked')) {
                    $('#vinculo_extensao').prop( "disabled", false );
                    $('#lbl_vinculo_extensao').removeClass( "text-muted" );
                } else {
                    $('#vinculo_extensao').val('');
                    $('#vinculo_extensao').prop( "disabled", true );
                    $('#lbl_vinculo_extensao').addClass( "text-muted" );
                }
            });

            // var dataSetPie = [
            //     {
            //         label: "Asia",
            //         data: 4119630000,
            //         color: color.primary._500
            //     },
            //     {
            //         label: "Latin America",
            //         data: 590950000,
            //         color: color.info._500
            //     },
            //     {
            //         label: "Africa",
            //         data: 1012960000,
            //         color: color.warning._500
            //     },
            //     {
            //         label: "Oceania",
            //         data: 95100000,
            //         color: color.danger._500
            //     },
            //     {
            //         label: "Europe",
            //         data: 727080000,
            //         color: color.success._500
            //     },
            //     {
            //         label: "North America",
            //         data: 344120000,
            //         color: color.fusion._400
            //     }];

            // $.plot($("#flotPie"), dataSetPie,
            //     {
            //         series:
            //         {
            //             pie:
            //             {
            //                 innerRadius: 0.5,
            //                 show: true,
            //                 radius: 1,
            //                 label:
            //                 {
            //                     show: true,
            //                     radius: 2 / 3,
            //                     threshold: 0.1
            //                 }
            //             }
            //         },
            //         legend:
            //         {
            //             show: true
            //         }
            //     });

            function buscarUnidadesNaoCadastradasPorAno(ano){
                $.ajax({
                    url: "{{ url('buscar-unidades-nao-cadastradas') }}",
                    method: "GET",
                    dataType: 'json',
                    data: { _token : $('meta[name="csrf-token"]').attr('content'), ano: ano },
                    success: function(data) {
                        var content = ``;
                        data.map(dado => {
                            content += `<tr class="text-muted">
                                            <td>${dado.nome}</td>
                                            <td>${dado.sigla}</td>
                                            <td></td>
                                        </tr>`;
                        });

                        $('#unidades-nao-cadastradas-table').html(content);
                        $('#ano-selecionado').html(ano);
                        $('#unidades-nao-enviadas').text(data.length);
                        $('#unidades-enviadas').text($("#total-unidades").text() - data.length);
                    }
                });
            }

            //para remover a classe is-invalid quando o campo esta sendo preenchido "use o onkeyup"
            function clearErrorClass(e)
            {
                const list = e.classList;
                list.remove('is-invalid');
            }

            $('#curricularizacao_status').change(function() {
                if($(this).val() === 'Não Aceito') {
                    $('#curricularizacao_justificativa').removeClass( "d-none" );
                } else {
                    $('#curricularizacao_justificativa').addClass( "d-none" );
                }
            });

            let divAtual = 1;
            const numDivs = 3;

            $('#btn-anterior').click(function(){
                $('#div' + divAtual).addClass('d-none');
                $('#step' + divAtual).addClass('opacity-50');
                divAtual = (divAtual - 1) <= 0 ? numDivs : (divAtual - 1);
                $('#div' + divAtual).removeClass('d-none');
                $('#step' + divAtual).removeClass('opacity-50');
            });

            $('#btn-proximo').click(function(){
                $('#div' + divAtual).addClass('d-none');
                $('#step' + divAtual).addClass('opacity-50');
                divAtual = (divAtual + 1) > numDivs ? 1 : (divAtual + 1);
                $('#div' + divAtual).removeClass('d-none');
                $('#step' + divAtual).removeClass('opacity-50');
            });

            @if(isset($acao_extensao))
            $("#btn-editar-acao").click(function(){
                var ocorrencias = '{{ $acao_extensao->ocorrencia->count() }}';
                if(ocorrencias > 0) {
                    if(confirm('Esta ação existe ocorrências ou inscrições em andamento  as alterações não irão refletir nas mesmas, para mudanças que alteram a proposta é necessário cadastrar uma nova Ação de Extensão.')) {
                        $('#form_acao_extensao').submit();
                    }
                }else {
                    $('#form_acao_extensao').submit();
                }
            });
            @endif

            //criacao da comissao no inicio do modulo de acoes de extensao
            var membros_selecionados = [];

            $("#nome_membro").change(function(){
                membros_selecionados.push({
                    "id" : $("#nome_membro").val(),
                    "nome" : $("#nome_membro option:selected").text()
                });

                 membros_selecionados_lista();
               
            });

            function remove_selecionado(index){
                membros_selecionados.splice(index, 1);

                 membros_selecionados_lista();
            }

            function membros_selecionados_lista() {
                var conteudo = '';
                var cont = 0;

                 membros_selecionados.map(membro => {

                    conteudo +=  `<span class="badge ${membro.id == '{{ Auth::user()->id }}' ? 'badge-warning' : 'badge-primary' } badge-pill px-3">
                                    ${membro.nome}
                                    <button type="button" class="btn btn-sm btn-icon rounded-circle text-white" onclick="remove_selecionado(${cont})">
                                        <i class="fal fa-times mx-2"></i>
                                    </button>
                                </span>`;
                    cont++;

                    console.log('{{ Auth::user()->id }}');
                });

                $("#nomes_selecionados").html(conteudo);

                if($("#nome_comissao").val() != '' && membros_selecionados.length != 0) {
                    $("#btn-criar-comissao").removeClass("btn-secondary");
                    $("#btn-criar-comissao").addClass("btn-primary");
                    $("#btn-criar-comissao").prop("disabled", false);
                }
                else {
                    $("#btn-criar-comissao").addClass("btn-secondary");
                    $("#btn-criar-comissao").removeClass("btn-primary");
                    $("#btn-criar-comissao").prop("disabled", true);
                }
            }

            $("#nome_comissao").blur(function(){
                if($("#nome_comissao").val() != '' && membros_selecionados.length != 0) {
                    $("#btn-criar-comissao").removeClass("btn-secondary");
                    $("#btn-criar-comissao").addClass("btn-primary");
                    $("#btn-criar-comissao").prop("disabled", false);
                }
                else {
                    $("#btn-criar-comissao").addClass("btn-secondary");
                    $("#btn-criar-comissao").removeClass("btn-primary");
                    $("#btn-criar-comissao").prop("disabled", true);
                }
            });
            //fim da criacao da comissao no inicio do modulo de acoes de extensao

            $("#btn-criar-comissao").click(function(){
                $.ajax({
                        url: "{{ url('acoes-extensao/inicio/store-comissao') }}",
                        method: "POST",
                        dataType: 'json',
                        data: { nome_comissao: $("#nome_comissao").val(), membros: membros_selecionados, _token: '{{ csrf_token() }}' },
                        success: function(data) {
                            if(data.alert === 'success') {
                                toastr.success(data.status);
                                $('#modalComissaoExtensao').modal('hide');
                                $('#modalComissaoExtensao').modal('hide');
                                $('#nome_comissao').val('');
                                $('#nome_membro').val('');
                                $("#nomes_selecionados").html('');

                                $('#modalComissaoExtensao').modal('show');

                            }
                            else if(data.alert === 'danger') {
                                toastr.danger(data.status);
                            }
                        }
                    });
            });
            

            /* Usando API para auxiar no preenchimento do endereço com latitude e longitude
            Mas apresenta erros - por enquanto desconsiderar...

            document.addEventListener("DOMContentLoaded", function() {
  const enderecoInput = document.getElementById("endereco");
  const latitudeInput = document.getElementById("latitude");
  const longitudeInput = document.getElementById("longitude");

  enderecoInput.addEventListener("input", function() {
    const endereco = enderecoInput.value;

    if (endereco) {
      fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(endereco)}&format=json`)
        .then(response => response.json())
        .then(data => {
          const suggestions = data.map(item => item.display_name);
          const latitudes = data.map(item => item.lat);
          const longitudes = data.map(item => item.lon);
          createAutocompleteSuggestions(suggestions, latitudes, longitudes);
        })
        .catch(error => {
          console.error("Erro ao buscar sugestões de endereço:", error);
        });
    } else {
      clearAutocompleteSuggestions();
    }
  });

  function createAutocompleteSuggestions(suggestions, latitudes, longitudes) {
    const suggestionsList = document.getElementById("suggestions-list");

    // Limpar sugestões anteriores
    suggestionsList.innerHTML = "";

    suggestions.forEach((suggestion, index) => {
      const suggestionItem = document.createElement("li");
      suggestionItem.textContent = suggestion;

      suggestionItem.addEventListener("click", function() {
        enderecoInput.value = suggestion;
        latitudeInput.value = latitudes[index];
        longitudeInput.value = longitudes[index];
        clearAutocompleteSuggestions();
      });

      suggestionsList.appendChild(suggestionItem);
    });
  }

  function clearAutocompleteSuggestions() {
    const suggestionsList = document.getElementById("suggestions-list");
    suggestionsList.innerHTML = "";
  }
}); */

document.addEventListener("DOMContentLoaded", function () {
      const openMapButton = document.getElementById("open-map-button");

      openMapButton.addEventListener("click", function () {
        const latitude = document.getElementById("latitude").value;
        const longitude = document.getElementById("longitude").value;

        if (latitude && longitude) {
          const mapUrl = `https://www.google.com/maps?q=${latitude},${longitude}`;
          window.open(mapUrl, "_blank");
        } else {
          alert("Por favor, insira valores válidos para latitude e longitude.");
        }
      });
    });

        </script>
        <!--This page contains the basic JS and CSS files to get started on your project. If you need aditional addon's or plugins please see scripts located at the bottom of each page in order to find out which JS/CSS files to add.-->
    </body>
    <!-- END Body -->
</html>
