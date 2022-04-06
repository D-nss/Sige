<!-- Default Card Example -->
<div class="card mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para cadastar os conselheiros</h6>
</div>
<div class="card-body">
    <form action="" method="POST">
        @csrf
        <label for="area_tematica" class="font-weight-bold">Área Temática: </label>
        <select name="area_tematica" id="area_tematica" class="form-control mb-3">
            <option value="">Selecionar ...</option>
            <option value="">Cultura</option>
            <option value="">Meio Ambiente</option>
        </select>

        <label for="docente" class="font-weight-bold">Docente: </label>
        <select name="docente" id="docente" class="form-control mb-3">
            <option value="">Selecionar ...</option>
            <option value="">Docente 1</option>
            <option value="">Docente 2</option>
        </select>

        <label for="atribuicao" class="font-weight-bold">Atribuição: </label>
        <select name="atribuicao" id="atribuicao" class="form-control mb-3">
            <option value="">Selecionar ...</option>
            <option value="">Conselheiro</option>
            <option value="">Parecerista</option>
        </select>

        <div class="mt-3">
            <button class="btn btn-primary btn-user btn-verde font-weight-bold">
                Adicionar
            </button>
            
        </div>
        </form>

        <div class="border border-success rounded-lg mt-3 p-3">

        <h3 class="font-weight-bold">Conselheiros</h3>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th>Docente</th>
                <th>Área Temática</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Docente 1</td>
                <td>Meio Ambiente</td>
                <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
            </tr><tr>
                <td>Docente 2</td>
                <td>Cultura</td>
                <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
            </tr>
            </tbody>
        </table>

        </div>
        
        <div class="border border-success rounded-lg  mt-3 p-3">

        <h3 class="font-weight-bold">Pareceristas</h3>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th>Docente</th>
                <th>Área Temática</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Docente 1</td>
                <td>Meio Ambiente</td>
                <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
            </tr><tr>
                <td>Docente 2</td>
                <td>Cultura</td>
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