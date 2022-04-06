<!-- Default Card Example -->
<div class="card mb-4 p-3">
    <div class="card-body">
        <div class="mt-3">
            <button class="btn btn-default btn-sm d-none mb-3" id="questao_existente">Usar questão existente</button>
            <form action="" class="row" id="div_questao_existente">
                @csrf
                
                <div class="col-md-12">
                    <label for="tipo" class="font-weight-bold">Tipo da Questão</label>
                    <select class="form-control mb-3" name="tipo">
                        <option value="">Selecione ...</option>
                        <option value="">Dados Indicadores</option>
                        <option value="">Avaliação</option>
                    </select>

                    <label for="browser" class="font-weight-bold">Escolha a questão na Lista:</label>
                    <input list="questoes_list" class="form-control mb-3" name="questao" id="questao">

                    <datalist id="questoes_list">
                        <option value="Quais as contribuições do projeto para suas atividades de pesquisa, já realizadas ou potenciais?">
                        <option value="Quais as contribuições esperadas do projeto para a formação acadêmica, profissional e cidadã dos alunos envolvidos?">
                        <option value="De que maneiras a comunidade externa à Unicamp será envolvida no projeto?">
                    </datalist>

                    <button class="btn btn-primary btn-user btn-verde font-weight-bold">
                        Adicionar
                    </button>
                </div>
            </form>
                
            <button class="btn btn-default btn-sm mt-3" id="nova_questao">Nova questão</button>

            <form action="" class="row d-none" id="div_nova_questao">
                <div class="col-md-12">
                    <label for="questao" class="font-weight-bold">Questão</label>
                    <textarea name="questao" class="form-control mb-3" id="" cols="30" rows="5"></textarea>

                    <label for="tipo" class="font-weight-bold">Tipo da Questão</label>
                    <select class="form-control mb-3" name="tipo">
                        <option value="">Selecione ...</option>
                        <option value="">Dados Indicadores</option>
                        <option value="">Avaliação</option>
                    </select>

                    <button class="btn btn-primary btn-user btn-verde font-weight-bold">
                        Adicionar
                    </button>
                </div>
            </form>

            <div class="border border-success rounded-lg  mt-3 p-3">

                <h3 class="font-weight-bold">Dados Indicadores</h3>
                <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th>Questão</th>
                    <th>Tipo</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</td>
                    <td>Dados Indicadores</td>
                    <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                    </tr><tr>
                    <td>1. Quais as contribuições do projeto para suas atividades de ensino, já realizadas ou potenciais?</td>
                    <td>Dados Indicadores</td>
                    <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                </tbody>
                </table>

            </div>

            <div class="border border-success rounded-lg  mt-3 p-3">

                <h3 class="font-weight-bold">Avaliação</h3>
                <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th>Questão</th>
                    <th>Tipo</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</td>
                    <td>Avaliação</td>
                    <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                    </tr><tr>
                    <td>1. Quais as contribuições do projeto para suas atividades de ensino, já realizadas ou potenciais?</td>
                    <td>Avaliação</td>
                    <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                </tbody>
                </table>

            </div>

            <div class="mt-3">
                <a href="/usuarios" class="btn btn-secondary btn-user float-right">
                    <span class="text">Finalizar</span>
                </a>
                <a href="#" onclick="history.back()" class="btn btn-secondary btn-user float-left">
                    <span class="icon text-white-50">
                        <i class="fal fa-long-arrow-left"></i>
                    </span>
                    <span class="text">Voltar</span>
                </a>
            </div>
            
        </div>
    </div>
</div>