@extends('layouts.app')

@section('title', 'Sistema de Informação Gestão de Extensão')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="subheader">
      <h1 class="subheader-title">
          <span class="bem-vindo">Seja bem vindo!</span>
          <small>
          <span class="">Extecult</span> - Sistema de gestão de extensão e cultura
          </small>
      </h1>
      <div class="subheader-block d-lg-flex align-items-center">
          <div class="d-inline-flex flex-column justify-content-center">
            <img src="{{ url('img/proec.svg')}}" alt="PROEC" class="img-fluid" style="width: 50%;">
          </div>
      </div>
  </div>

<div class="bg-white mb-5 p-5 shadow">
    <div class="d-flex flex-start w-100">
        <div class="d-flex flex-fill">
            <div class="flex-fill fs-xl">
                <p>A Pró-Reitoria de Extensão e Cultura tem como missão coordenar, fomentar, estimular e produzir ações de Extensão e de Cultura pela integração dialógica, interativa e pró ativa com a sociedade, difundindo e adquirindo conhecimento por meio da comunidade universitária.</p>
                <p>“Extensão Comunitária” é a atividade acadêmica de Extensão Universitária destinada a atender a sociedade civil em comunidade externa à UNICAMP em segmentos da população ou em grupos específicos (minorias, grupos étnicos, portadores de necessidades especiais, faixas etárias, etc.), promovendo ação de natureza social, artística, cultural, desportiva ou educativa.</p>
                <p>A ação de "Extensão Comunitária" deve estar diretamente vinculada a uma atividade acadêmica regular de ensino e de pesquisa; deve ser dirigida por um docente ou pesquisador da UNICAMP; deve ter, necessariamente, a participação de alunos regularmente matriculados na UNICAMP; e deve prever a troca mútua de conhecimentos e de experiências entre os acadêmicos participantes do projeto e as pessoas da comunidade atendida.</p>
                <!-- <p class="m-0">
                    Find in-depth, guidelines, tutorials and more on Bootstrap Colorpicker's <a href="https://farbelous.io/bootstrap-colorpicker/" target="_blank">Official Documentation</a>
                </p> -->
            </div>
        </div>
    </div>
</div>
 
<div class="row">
  <div class="col-xl-4">
    <div id="panel-1" class="panel">
        <div class="panel-hdr bg-primary-700">
            <h2>
                Editais
            </h2>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                @forelse($editais as $edital)
                  <div class="panel-tag">{{ $edital->titulo }} 
                    <a href="{{ url('storage/' . $edital->anexo_edital) }}" class="btn btn-info btn-xs"><i class="fal fa-file-pdf"></i> Edital</a>
                    <a href="{{ url('inscricao/' . $edital->id .'/novo') }}" class="px-3"><i class="far fa-arrow-right ml-2"></i> Inscrever-se</a>
                  </div>
                @empty
                <div class="panel-tag"><p class="font-italic font-color-light">Nenhum edital com inscrição aberta.</p></div>
                @endforelse
                <a href="{{ url('editais') }}" class="btn btn-link fw-bold fs-xl">Ver Mais ...</a>
            </div>
        </div>
    </div>
  </div>

  <div class="col-xl-4">
    <div id="panel-1" class="panel">
        <div class="panel-hdr bg-primary-700">
            <h2>
                Eventos
            </h2>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                @forelse($eventos as $evento)
                  <div class="panel-tag">{{ $evento->titulo }}
                    <a href="{{ url('eventos/' . $evento->id ) }}" class="px-3"><i class="far fa-arrow-right ml-2"></i> Ver Detalhes</a>
                  </div>
                @empty
                <div class="panel-tag"><p class="font-italic font-color-light">Nenhum evento com inscrição aberta.</p></div>
                @endforelse
                <a href="{{ url('eventos') }}" class="btn btn-link fw-bold fs-xl">Ver Mais ...</a>
            </div>
        </div>
    </div>
  </div>
        
  <div class="col-xl-4">
    <div class="panel">
      <div class="panel-hdr bg-primary-700">
          <h2>
              Contato
          </h2>
      </div>
      <div class="panel-container show">
          <div class="panel-content">
            <div class="panel-tag fs-xl">
                  <span class="text-secondary font-weight-bold">Dúvidas sobre editais:</span> pex@unicamp.br
            </div>
                <div class="panel-tag fs-xl">
                    <span class="text-secondary font-weight-bold">Dúvidas sobre Indicadores:</span> conex@unicamp.br
                </div>
                <div class="panel-tag fs-xl">
                    <span class="text-secondary font-weight-bold">Dúvidas sobre Sistemas:</span> suporte@proec.unicamp.br
                </div>
                <div class="panel-tag fs-xl">
                    <span class="text-secondary font-weight-bold">Endereço: </span>Av. Érico Veríssimo, 500 – Cidade Universitária “Zeferino Vaz” – Barão Geraldo CEP 13083-851 – Campinas – SP
                </div>
          </div>
      </div>
          
    </div>
  </div>
</div>
@endsection
