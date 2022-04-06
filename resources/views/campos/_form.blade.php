<!-- Default Card Example -->
<div class="card mb-4 p-3">
    <div class="card-body">
        <div class="mt-3">

            <form action="" class="row">
                @csrf
                
                <div class="col-md-12">
                    <label for="texto-campo" class="font-weight-bold">Texto do Campo:</label>
                    <input type="text" class="form-control mb-3" name="texto-campo" id="texto-campo">
                    
                    <button class="btn btn-primary btn-user btn-verde font-weight-bold">
                        Adicionar
                    </button>
                </div>
            </form>

            <div class="border border-success rounded-lg  mt-3 p-3">

                <h3 class="font-weight-bold">Campos da Proposta</h3>
                <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th>Campo</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>1. Titulo?</td>
                    <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                    </tr><tr>
                    <td>2. O projeto está em execução?</td>
                    <td><a href="#" class="btn btn-sm btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                </tbody>
                </table>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="usar-area-tematica">
                    <label class="form-check-label" for="usar-area-tematica">
                        Usar Áreas Temáticas
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="usar-linhas-extensao">
                    <label class="form-check-label" for="usar-linhas-extensao">
                        Usar Linhas de Extensão
                    </label>
                </div>

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