@extends('layouts.app')

@section('title', 'Sistema de Informação Gestão de Extensão')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="subheader">
      <h1 class="subheader-title">
          <span class="text-success">Seja bem vindo!</span>
          <small>
          <span class="text-danger">Extecult</span> - Sistema de gestão de extensão e cultura
          </small>
      </h1>
      <div class="subheader-block d-lg-flex align-items-center">
          <div class="d-inline-flex flex-column justify-content-center">
            <img src="{{ url('smartadmin-4.5.1/img/proec.svg')}}" alt="PROEC" class="img-fluid" style="width: 50%;">
          </div>
      </div>
  </div>

  <div class="alert alert-primary">
    <div class="d-flex flex-start w-100">
        <div class="mr-2 hidden-md-down">
            <span class="icon-stack icon-stack-lg">
                <i class="base base-5 icon-stack-3x opacity-100 color-primary-500"></i>
                <i class="far fa-money-check-edit icon-stack-1x opacity-100 color-white"></i>
            </span>
        </div>
        <div class="d-flex flex-fill">
            <div class="flex-fill">
                <span class="h5">Sobre </span>
                <p>A Pró-Reitoria de Extensão e Cultura tem como missão coordenar, fomentar, estimular e produzir ações de Extensão e de Cultura pela integração dialógica, interativa e pró ativa com a sociedade, difundindo e adquirindo conhecimento por meio da comunidade universitária. “Extensão Comunitária” é a atividade acadêmica de Extensão Universitária destinada a atender a sociedade civil em comunidade externa à UNICAMP em segmentos da população ou em grupos específicos (minorias, grupos étnicos, portadores de necessidades especiais, faixas etárias, etc.), promovendo ação de natureza social, artística, cultural, desportiva ou educativa. A ação de "Extensão Comunitária" deve estar diretamente vinculada a uma atividade acadêmica regular de ensino e de pesquisa; deve ser dirigida por um docente ou pesquisador da UNICAMP; deve ter, necessariamente, a participação de alunos regularmente matriculados na UNICAMP; e deve prever a troca mútua de conhecimentos e de experiências entre os acadêmicos participantes do projeto e as pessoas da comunidade atendida.</p>
                <!-- <p class="m-0">
                    Find in-depth, guidelines, tutorials and more on Bootstrap Colorpicker's <a href="https://farbelous.io/bootstrap-colorpicker/" target="_blank">Official Documentation</a>
                </p> -->
            </div>
        </div>
    </div>
</div>
 
<div class="row">
  <div class="col-xl-6">
    <div id="panel-1" class="panel">
        <div class="panel-hdr">
            <h2>
                Editais
            </h2>
            <div class="panel-toolbar">
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                @forelse($editais as $edital)
                  <div class="panel-tag">{{ $edital->titulo }} 
                    <a href="{{ url('storage/' . $edital->anexo_edital) }}" class="badge badge-primary px-3"> Edital<i class="fal fa-file-pdf ml-2"></i></a>
                    <a href="{{ url('inscricao/' . $edital->id .'/novo') }}" class="badge badge-danger px-3"> Inscrever-se<i class="far fa-arrow-right ml-2"></i></a>
                  </div>
                @empty
                <div class="panel-tag"><p class="font-italic font-color-light">Nenhum edital com inscrição aberta.</p></div>
                @endforelse
            </div>
        </div>
    </div>
  </div>
        
  <div class="col-xl-6">
    <div class="panel">
      <div class="panel-hdr">
          <h2>
              Contato
          </h2>
          <div class="panel-toolbar">
              <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
              <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
          </div>
      </div>
      <div class="panel-container show">
          <div class="panel-content">
              <div class="panel-tag">
                <p><span class="text-secondary font-weight-bold">Dúvidas sobre editais:</span> pex@unicamp.br</p>  
                <p><span class="text-secondary font-weight-bold">Dúvidas sobre Indicadores:</span> conex@unicamp.br</p>
                <p><span class="text-secondary font-weight-bold">Dúvidas sobre Sistemas:</span> suporte@proec.unicamp.br</p>
                <p><span class="text-secondary font-weight-bold">Endereço:</span>Av. Érico Veríssimo, 500 – Cidade Universitária “Zeferino Vaz” – Barão Geraldo CEP 13083-851 – Campinas – SP</p>
              
              </div>
          </div>
      </div>
          
    </div>
  </div>
</div>
@endsection
