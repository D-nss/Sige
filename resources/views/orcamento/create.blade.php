@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Orçamento da Proposta: Teste 2</h1>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4 p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <form method="post" >
  
                                <input type="hidden" name="acao_id" value="">

                                <label class="font-weight-bold" for="tipo_orcamento">Tipo do Item do Orçamento:</label>
                                
                                <select class="form-control mb-3" name="tipo_orcamento" id="tipo_orcamento"  required="" >
                                    <option>Selecione o tipo</option>
                                    <option value="1">Materiais de Consumo</option>
                                    <option value="2">Serviços Terceiros e Encargos</option>
                                    <option value="3">Equipamentos e Instalações</option>      
                                </select>
                                
                                <label class="font-weight-bold" for="item_orcamento">Item do Orçamento:</label>
                             
                                <select class="form-control mb-3" name="item_orcamento" id="item_orcamento" required="" >
                                    <option value="1">Escritório/Papelaria</option>
                                    <option value="2">Informática</option>
                                    <option value="3">Fotografia/filmagem/arquivo</option>
                                    <option value="4">Esportes</option><option value="5">Didático</option>
                                    <option value="6">Gêneros Alimentícios</option
                                    ><option value="7">Equipamento Proteção Individual</option>
                                    <option value="8">Alimentação Pronta</option>
                                    <option value="9">Odontológico/hospitalar/ambulatorial</option>
                                    <option value="10">Produtos químicos, reagentes e assemelhados</option>
                                    <option value="11">Básico de construção/Elétrico/Hidráulico</option>
                                    <option value="12">Correios</option><option value="13">Vestuários</option>
                                    <option value="14">Outros Materiais de consumo</option>
                                </select>
                            
                                <label class="font-weight-bold" for="desc_item_orcamento">Descrição do Item:</label>
                                <input type="text" class="form-control mb-3" name="desc_item_orcamento" id="desc_item_orcamento" required="">
                        
                                <label class="font-weight-bold" for="just_item_orcamento">Justificativa do Item:</label>
                                <textarea type="text" class="form-control mb-3" name="just_item_orcamento" id="just_item_orcamento" required=""></textarea>

                                <label class="font-weight-bold" for="valor_solicitado">Valor solicitado:</label>
                                <input type="text" class="form-control mb-3" name="valor_solicitado" id="valor_solicitado" required="">
                                
                                <button type="submit" class="btn btn-success btn-block">Inserir Item do Orçamento</button>
                                
                            </form>
                        </div>
                        <div class="col-md-9">
                            <table class="table table-bordered table-hover table-striped w-100 mb-2" id="dt-orcamento">
                                <thead>
                                    <tr>
                                        <th>Nome do Item</th>
                                        <th>Tipo do Item</th>
                                        <th>Descrição</th>
                                        <th>Justificativa</th>
                                        <th>Valor</th>
                                        <th>Operação</th>
                                    </tr>
                                </thead>

                                <tbody>   
                                    <tr>
                                        <td>Informática</td>
                                        <td>Materias de Consumo</td>
                                        <td>2 Aparelhos celulares Samsung</td>
                                        <td>Atendimento Remoto</td>
                                        <td>R$ 6.000,00</td>
                                        <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Informática</td>
                                        <td>Materias de Consumo</td>
                                        <td>2 Aparelhos celulares Samsung</td>
                                        <td>Atendimento Remoto</td>
                                        <td>R$ 6.000,00</td>
                                        <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Informática</td>
                                        <td>Serviços Terceiros e Encargos</td>
                                        <td>2 Aparelhos celulares Samsung</td>
                                        <td>Atendimento Remoto</td>
                                        <td>R$ 6.000,00</td>
                                        <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Informática</td>
                                        <td>Equipamentos e Instalações</td>
                                        <td>2 Aparelhos celulares Samsung</td>
                                        <td>Atendimento Remoto</td>
                                        <td>R$ 6.000,00</td>
                                        <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <span class="alert alert-success font-size-14 font-weight-bold">Total R$ 24.000,00</span>
                            <span class="alert alert-info font-size-14 font-weight-bold">Total DisponívelR$ 25.000,00</span>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection