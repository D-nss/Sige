<div class="card mb-4 p-3">
    <div class="card-body">
        <div class="edital">
            
            <h2>Edital</h2>
            
            @if( isset($processo) )
                <h3 class="text-secondary">Titulo do Edital</h3>
                <p style="color: #999;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In massa nisi, scelerisque vitae urna quis, hendrerit ultrices quam. Mauris ut tortor pellentesque, congue lacus at, sagittis urna. Quisque vestibulum purus in nisi fermentum, nec imperdiet odio commodo. Nulla interdum tincidunt lectus. Pellentesque dictum, dui a gravida eleifend, dolor leo placerat erat, at volutpat magna leo sollicitudin nisl</p>
                <p class="text-success"><strong>Valor:</strong> R$ 10.000,00</p>
                <a href="#" class="btn btn-danger btn-lg btn-icon rounded-circle"><i class="far fa-file-pdf"></i></a>
                <a href="#" class="btn btn-info btn-lg btn-icon rounded-circle"><i class="far fa-edit"></i></a>
            @else
                <a href="{{ url('editais/novo') }}" class="btn btn-success btn-lg btn-icon rounded-circle">
                    <i class="far fa-plus"></i>
                </a>
                Adicionar Edital
            @endif

        </div>
        <hr class="border-top border-bottom">
        <div class="campos-proposta">
            
            <h2>Campos da Proposta</h2>
            
            @if( isset($processo) )
                <ul style="color: #999;">
                    <li>1. Título:</li>
                    <li>2. Tipo de Extensão:</li>
                    <li>3. Estado:</li>
                    <li>4. Cidade:</li>
                    <li>5. Número de pessoas da UNICAMP que serão envolvidas:</li>
                    <li>6. Número de pessoas externas que serão envolvidas:</li>
                    <li>7. Realidade social, econômica e cultural da Comunidade: (máx. 3000 caracteres)</li>
                    <li>8. O projeto já está em execução?</li>
                    <li>9. Tipo de envolvimento da equipe com a Comunidade</li>
                    <li>10. Há parcerias com outras instituições (públicas ou privadas) para o desenvolvimento do projeto?</li>
                </ul>
                <p class="text-primary font-size-14 font-weight-bold">Usar Área Temáticas : Sim</p>
                <p class="text-info font-size-14 font-weight-bold">Usar Linhas de Extensão : Sim</p>
            @else
                <a href="{{ url('campos/novo') }}" class="btn btn-success btn-lg btn-icon rounded-circle">
                    <i class="far fa-plus"></i>
                </a>
                Adicionar Campo
            @endif
            
        </div>
        <hr class="border-top border-bottom">
        <div class="cronograma">
            <h2>Cronograma</h2>
            
            @if( isset($processo) )
                <ul>
                    <li><strong class="text-secondary">Data Divulgação: </strong><span style="color: #999;">25/05/2022</span></li>
                    <li><strong class="text-secondary">Data Inicio Inscrições: </strong><span style="color: #999;">25/05/2022</span></li>
                    <li><strong class="text-secondary">Data Termino Inscrições: </strong><span style="color: #999;">25/05/2022</span></li>
                    <li><strong class="text-secondary">Data Termino dos Projetos: </strong><span style="color: #999;">25/05/2022</span></li>
                    <li><strong class="text-secondary">Data Limite comprovante comitê: </strong><span style="color: #999;">25/05/2022</span></li>
                </ul>
                <a href="#" class="btn btn-info btn-lg btn-icon rounded-circle"><i class="far fa-edit"></i></a>
            @else
                <a href="{{ url('cronograma/novo') }}" class="btn btn-success btn-lg btn-icon rounded-circle">
                    <i class="far fa-plus"></i>
                </a>
                Adicionar Cronograma
            @endif
        </div>
        <hr class="border-top border-bottom">
        <div class="conselheiros">
            <h2>Conselheiros / Avaliadores</h2>
            
            @if( isset($processo) )
                <div class="pl-2">
                    <h4>Conselheiros</h4>
                        <ul style="color: #999;">
                            <li>Prof. Dr. José Fulano de tal</li>
                            <li>Prof. Dra. Maria Fulano de tal</li>
                        </ul>

                    <h4>Pareceristas</h4>
                        <ul style="color: #999;">
                            <li>Prof. Dr. José Fulano de tal</li>
                            <li>Prof. Dra. Maria Fulano de tal</li>
                        </ul>
                </div>
                <a href="#" class="btn btn-info btn-lg btn-icon rounded-circle"><i class="far fa-edit"></i></a>
            @else
                <a href="{{ url('conselheiros/novo') }}" class="btn btn-success btn-lg btn-icon rounded-circle">
                    <i class="far fa-plus"></i>
                </a>
                Adicionar Conselheiros / Avaliadores
            @endif
        </div>
        <hr class="border-top border-bottom">
        <div class="questoes-avaliativas" >
            <h3>Questões Avaliativas</h3>
            
            @if( isset($processo) )
                <ul style="color: #999;">
                    <li>1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</li>
                    <li>2. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</li>
                    <li>3. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</li>
                    <li>4. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</li>
                    <li>5. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</li>
                    <li>6. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</li>
                    <li>7. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</li>
                    <li>8. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</li>
                    <li>9. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</li>
                    <li>10. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</li>
                </ul>

                <a href="#" class="btn btn-info btn-lg btn-icon rounded-circle"><i class="far fa-edit"></i></a>
            @else
                <a href="{{ url('questoes/novo') }}" class="btn btn-success btn-lg btn-icon rounded-circle">
                    <i class="far fa-plus"></i>
                </a>
                Adicionar Questões
            @endif
        </div>
    </div>
</div>