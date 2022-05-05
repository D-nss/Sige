@extends('layouts.app')

@section('title', 'Sistema de Informação Gestão de Extensão')

@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

            @include('layouts._includes._status')

            <div class="row">

                    <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">

                                    <!-- Project Card Example -->
              <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-green">Apresentação</h6>
                    </div>
                    <div class="card-body">
                      A ação de "Extensão Comunitária" deve estar diretamente vinculada a uma atividade acadêmica regular de ensino e de pesquisa; deve ser dirigida por um docente ou pesquisador da UNICAMP; deve ter, necessariamente, a participação de alunos regularmente matriculados na UNICAMP; e deve prever a troca mútua de conhecimentos e de experiências entre os acadêmicos participantes do projeto e as pessoas da comunidade atendida.
                    </div>
                  </div>

                  <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-green">Cronograma PEX 2022</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Data</th>
                      <th>Evento</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>20/05/22</td>
                      <td>Divulgação do 1º Edital PROEC - PEX 2022.</td>
                    </tr>
                    <tr>
                      <td>07/07/20</td>
                      <td>Limite para inscrição da proposta via <i>sige.unicamp.br</i>.</td>
                    </tr>
                    <tr>
                      <td>16/08/20</td>
                      <td>Encerramento do prazo para análise dos pareceristas.</td>
                    </tr>
                    <tr>
                      <td>30/08/20</td>
                      <td>Divulgação do resultado em <a href="http://www.proec.unicamp.br/" target="_blank">www.proec.unicamp.br</a> e <a href="http://www.dproj.preac.unicamp.br/" target="_blank">www.dproj.preac.unicamp.br</a></td>
                    </tr>
                    <tr>
                      <td>16/09/20</td>
                      <td>Assinatura na Funcamp do termo de Outorga pelo coordenador da proposta aprovada e INÍCIO efetivo da execução do projeto.</td>
                    </tr>
                    <tr>
                      <td>01/10/21</td>
                      <td>Término do Projeto.</td>
                    </tr>
                    <tr>
                      <td>01/10/21</td>
                      <td>Prestação de Contas (item 7).</td>
                    </tr>
                    <tr>
                      <td>01/10/22</td>
                      <td>Relatório Técnico Final (item 7).</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>




                                </div>

                                <div class="col-lg-4">

                                  <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                      <h6 class="m-0 font-weight-bold text-green">Editais & Bolsas [Ativos]</h6>
                                    </div>
                                    <div class="card-body">
                                      201904 - 201901 - 1º Edital ProEC-PEx 2019 <br>
                                      Edital de Cultura<br>
                                      Bolsa de Extensão<br>
                                      Prêmio de Extensão
                                    </div>
                                  </div>

                                            <!-- DataTales Example -->
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-green">Bolsas Extensão 2020</h6>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Mês</th>
                                  <th>Data limite para solicitação via sistema</th>
                                  <th>Dia da Reunião das subcomissões</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Março</td>
                                  <td>20/02/2020</td>
                                  <td>25/02/2020</td>
                                </tr>
                                <tr>
                                  <td>Abril</td>
                                  <td>20/02/2020</td>
                                  <td>25/02/2020</td>
                                </tr>
                                <tr>
                                  <td>Junho</td>
                                  <td>20/02/2020</td>
                                  <td>25/02/2020</td>
                                </tr>
                                <tr>
                                  <td>Julho</td>
                                  <td>20/02/2020</td>
                                  <td>25/02/2020</td>
                                </tr>
                                <tr>
                                  <td>Agosto</td>
                                  <td>20/02/2020</td>
                                  <td>25/02/2020</td>
                                </tr>
                                <tr>
                                  <td>Setembro</td>
                                  <td>20/02/2020</td>
                                  <td>25/02/2020</td>
                                </tr>
                                <tr>
                                  <td>Outubro</td>
                                  <td>20/02/2020</td>
                                  <td>25/02/2020</td>
                                </tr>
                                <tr>
                                  <td>Novembro</td>
                                  <td>20/02/2020</td>
                                  <td>25/02/2020</td>
                                </tr>
                                <tr>
                                  <td>Dezembro</td>
                                  <td>20/02/2020</td>
                                  <td>25/02/2020</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                              </div>

                                <div class="col-lg-4">

                                  <!-- Project Card Example -->
            <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-green">Entrar no Sistema</h6>
                  </div>
                  <div class="card-body">
                    <form class="user">
                      {{ csrf_field() }}
                      <a href="/login" class="btn btn-primary btn-user btn-block btn-verde">
                        Entrar
                      </a>
                    </form>
                  </div>
                </div>

                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-green">Banco de Ações de Extensão (BAE UNICAMP)</h6>
                  </div>
                  <div class="card-body text-center">
                    <img src="{{asset('template/img/logo-bae_positive.svg')}}" style="width: 250px; object-fit: contain" alt="">
                  </div>
                </div>



      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-green">Contato</h6>
        </div>
        <div class="card-body">
          Telefone: <b>(19) 3521-4753</b> <br>
          E-mail Institucional: <b>pec@unicamp.br</b><br>
          Endereço: Av. Érico Veríssimo, 500<br>
          Cidade Universitária “Zeferino Vaz”<br>
          Barão Geraldo, CEP 13083-851<br>
          Campinas/SP
          <hr>
          <div class="text-center">
            <a class="m-0 font-weight-bold text-green" href="forgot-password.html">Visualizar no Mapa</a>
          </div>
        </div>
      </div>

                              </div>

                            </div>
                            <!-- /.row (nested) -->

                            <div class="row">








                              <div class="col-lg-4">





                                          </div>

                                          <div class="col-lg-4">






                                                      </div>

                          </div>
                          <!-- /.row (nested) -->


                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->

                </div>


        </div>
        <!-- /.container-fluid -->



@endsection
