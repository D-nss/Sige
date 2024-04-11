<div class="col-lg-5">
    <h2>Situação Atual</h2>
    <div class=" p-3 bg-secondary rounded" style="height: 80px">
        <div class="row text-light justify-content-center align-items-center">
            <div class="d-flex justify-content-center align-items-center mr-2">
                <div class="d-flex flex-column justify-content-center align-items-center mr-2">
                    <div class="">
                    <div class="
                    @switch($acao_extensao->status)
                        @case('Rascunho')
                            bg-warning
                            @break
                        @case('Pendente')
                            bg-success
                            @break
                        @default()
                            bg-light
                            @break
                    @endswitch
                        rounded-circle" style="width:27px; height:27px"></div>
                    </div>
                    
                    <small class="text-center">Inicio<br>Proposta</small>
                </div>
                <span class="
                    @switch($acao_extensao->status)
                        @case('Rascunho')
                            text-warning
                            @break
                        @case('Pendente')
                            text-success
                            @break
                        @default()
                            text-light
                            @break
                    @endswitch"><i class="far fa-angle-right fa-2x"></i></span>
            </div>
            <div class="d-flex justify-content-center align-items-center mr-2">
                <div class="d-flex flex-column justify-content-center align-items-center mr-2">
                    <div class="
                    @switch($acao_extensao->status)
                        @case('Rascunho')
                            bg-light
                            @break
                        @case('Pendente')
                            bg-warning
                            @break
                        @case('Aprovado')
                            bg-success
                            @break
                        @default()
                            bg-light
                            @break
                    @endswitch
                    rounded-circle" style="width:27px; height:27px"></div>
                    <small class="text-center">Registro<br>Unidade</small>
                </div>
                <span class="
                @switch($acao_extensao->status)
                    @case('Rascunho')
                        text-light
                        @break
                    @case('Pendente')
                        text-warning
                        @break
                    @case('Aprovado')
                        text-success
                        @break
                    @default()
                        text-light
                        @break
                @endswitch
                "><i class="far fa-angle-right fa-2x"></i></span>
            </div>
            <div class="d-flex justify-content-center align-items-center mr-2">
                <div class="d-flex flex-column justify-content-center align-items-center mr-2">
                    <div class="bg-light rounded-circle" style="width:27px; height:27px"></div>
                    <small class="text-center">Reconheci<br>mento ProEC</small>
                </div>
                <span class="text-light"><i class="far fa-angle-right fa-2x"></i></span>
            </div>
            <div class="d-flex justify-content-center align-items-center mr-2">
                <div class="d-flex flex-column justify-content-center align-items-center mr-2">
                    <div class="bg-light rounded-circle" style="width:27px; height:27px"></div>
                    <small class="text-center">Ação<br>Publicada!</small>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-7">
    <h2>Próximos Passos</h2>
    <div class="p-3 bg-secondary rounded d-flex justify-content-center align-items-center" style="height: 80px">
        <p class="text-light">
            @switch($acao_extensao->status)
                @case('Rascunho')
                    Após essa etapa, você poderá acompanhar a apreciação de sua proposta em <span class="fw-700"> Ações de Extensão > Minhas Ações </span>
                    @break
                @case('Pendente')
                    Aguarde o parecer da Comissão de Extensão.
                    @break
                @default()
                    Após essa etapa, você poderá acompanhar a apreciação de sua proposta em Ações de Extensão > Minhas Ações
                    @break
            @endswitch
        </p>
    </div>
</div>