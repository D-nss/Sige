<div class="card mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para criar um novo Edital</h6>
</div>
<div class="card-body">
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="titulo" class="font-weight-bold">Titulo:</label>
        <input type="text" name="titulo" class="form-control mb-3" placeholder="Título" />

        <label for="resumo" class="font-weight-bold">Resumo:</label>
        <textarea name="resumo" class="form-control mb-3" rows="6"></textarea>

        <label for="Regras" class="font-weight-bold">Critérios:</label>
        <textarea name="regras" class="form-control mb-3" rows="6"></textarea>

        <label for="valor" class="font-weight-bold">Valor:</label>
        <input type="text" name="valor" class="form-control mb-3" placeholder="Valor" />

        <div class="row">
            <div class="col-md-12">
            <div class="form-group">
                <label class="control-label font-weight-bold text-success">Upload do Edital em pdf</label>
                <div class="preview-zone hidden">
                <div class="box box-solid">
                    <div class="box-header with-border">
                    <div></div>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-secondary btn-xs remove-preview">
                        Limpar
                        </button>
                    </div>
                    </div>
                    <div class="box-body" id="edital-box-body"></div>
                </div>
                </div>
                <div class="dropzone-wrapper">
                    <div class="dropzone-desc">
                        <i class="glyphicon glyphicon-download-alt"></i>
                        <p class="font-weight-bold">Arraste o arquivo aqui ou clique para selecionar.</p>
                    </div>
                    <input type="file" name="arquivo" class="dropzone" id="edital_arquivo">
                    
                </div>
                <div id="alert-pdf-format"></div>
            </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary btn-user btn-verde font-weight-bold">
                Salvar
            </button>
            <a href="#" onclick="history.back()" class="btn btn-secondary btn-user ">
                <span class="icon text-white-50">
                    <i class="fal fa-long-arrow-left"></i>
                </span>
                <span class="text">Voltar</span>
            </a>
        </div>
        </form>
</div>
</div>