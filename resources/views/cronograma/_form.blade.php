<!-- Default Card Example -->
<div class="card mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-green">Preencha corretamente os campos para criar um novo cronograma</h6>
</div>
<div class="card-body">
    
    <form action="" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="checkbox" name="" id="" onChange="enableDateInput('dt1', this)">
                    <div class="disabled ml-2" id="dt1"> 
                        <label for="dt_divulgacao" class="font-weight-bold">Data Divulgação:</label>
                        <input type="date" name="dt_divulgacao" class="form-control mb-3" placeholder="dd/mm/aaaa" />
                    </div>
                </div>
                

                <div class="input-group">
                    <input type="checkbox" name="" id="" onChange="enableDateInput('dt2', this)">
                    <div class="disabled ml-2" id="dt2"> 
                    <label for="dt_inicio_insc" class="font-weight-bold">Data Início das Inscrições:</label>
                    <input type="date" name="dt_inicio_insc" class="form-control mb-3" placeholder="dd/mm/aaaa" />
                    </div>
                </div>

                <div class="input-group">
                    <input type="checkbox" name="" id="" onChange="enableDateInput('dt3', this)">
                    <div class="disabled ml-2" id="dt3"> 
                    <label for="dt_termino_insc" class="font-weight-bold">Data Término das Inscrições:</label>
                    <input type="date" name="dt_termino_insc" class="form-control mb-3" placeholder="dd/mm/aaaa" />
                    </div>
                </div>

                <div class="input-group">
                    <input type="checkbox" name="" id="" onChange="enableDateInput('dt4', this)">
                    <div class="disabled ml-2" id="dt4"> 
                    <label for="dt_termino_proj" class="font-weight-bold">Data Término dos projetos:</label>
                    <input type="date" name="dt_termino_proj" class="form-control mb-3" placeholder="dd/mm/aaaa" />
                    </div>
                </div>

                <div class="input-group">
                    <input type="checkbox" name="" id="" onChange="enableDateInput('dt5', this)">
                    <div class="disabled ml-2" id="dt5"> 
                    <label for="dt_inicio_execucao" class="font-weight-bold">Data Inicio da Execução:</label>
                    <input type="date" name="dt_inicio_execucao" class="form-control mb-3" placeholder="dd/mm/aaaa" />
                    </div>                  
                </div> 
            </div>

            <div class="col-md-6">
                <div class="input-group">
                    <input type="checkbox" name="" id="" onChange="enableDateInput('dt6', this)">
                    <div class="disabled ml-2" id="dt6"> 
                    <label for="dt_fim_execucao" class="font-weight-bold">Data Fim da Execução:</label>
                    <input type="date" name="dt_fim_execucao" class="form-control mb-3" placeholder="dd/mm/aaaa" />
                    </div>                  
                </div>  

                <div class="input-group">
                    <input type="checkbox" name="" id="" onChange="enableDateInput('dt7', this)">
                    <div class="disabled ml-2" id="dt7"> 
                    <label for="dt_inicio_rec" class="font-weight-bold">Data Início dos recursos:</label>
                    <input type="date" name="dt_inicio_rec" class="form-control mb-3" placeholder="dd/mm/aaaa" />
                    </div>
                </div>

                <div class="input-group">
                    <input type="checkbox" name="" id="" onChange="enableDateInput('dt8', this)">
                    <div class="disabled ml-2" id="dt8"> 
                    <label for="dt_termino_rec" class="font-weight-bold">Data Fim dos recursos:</label>
                    <input type="date" name="dt_termino_rec" class="form-control mb-3" placeholder="dd/mm/aaaa" />
                    </div>
                </div>

                <div class="input-group">
                    <input type="checkbox" name="" id="" onChange="enableDateInput('dt9', this)">
                    <div class="disabled ml-2" id="dt9"> 
                    <label for="dt_limite_comite" class="font-weight-bold">Data Limite comprovante comitê:</label>
                    <input type="date" name="dt_li,ite_comite" class="form-control mb-3" placeholder="dd/mm/aaaa" />
                    </div>                  
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mt-3">
                    <button class="btn btn-primary btn-user btn-verde font-weight-bold">
                        Salvar
                    </button>
                    <a href="#" onclick="history.back()" class="btn btn-secondary btn-user ">
                        <span class="icon text-white-50">
                            <i class="fal fa-long-arrow-left"></i>
                        </span>
                        <span class="text">Voltar</span>
                    </a>
                </div>
            </div>
        </div>
    </form>
   
    </div>
</div>