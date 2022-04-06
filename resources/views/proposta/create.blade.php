@extends('layouts.app')

@section('title', 'Cadastrar novo Processo Edital')

@section('content')
<h1>Proposta</h1>
        <!-- Begin Page Content -->
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
            <div class="card mb-4 p-3">
                <div class="card-body">                   
                    <div id="swproposta">
                        <ul class="nav d-flex justify-content-between">
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-1">
                                    Dados
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-2">
                                    Áreas
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-3">
                                    Linhas de Extensão
                                </a>
                            </li>
                            <li>
                                <a class="nav-link font-weight-bold font-size-16" href="#step-4">
                                    Dados Indicadores
                                </a>
                            </li>
                        </ul>
            
                        <div class="tab-content mt-3">
                            <div id="step-1" class="tab-pane" role="tabpanel">
                                <h3 class="text-success">Dados do projeto</h3>
                                <p style="color: #999;">Exibição das regras do edital cadastrado junto a inclusão do edital</p>

                                <label for="titulo" class="font-weight-bold">Título: </label>
                                <input type="text" name="titulo" class="form-control w-75" placeholder="Título">
                                <p style="color: #D0D3D4;">(máx. 100 caracteres)</p>

                                <label for="tipo_extensao" class="font-weight-bold">Tipo de Extensão: </label>
                                <select name="tipo_extensao" class="form-control w-25">
                                    <option value="">Programa</option>
                                    <option value="">Projeto</option>
                                </select>

                                <hr class="border-top border-bottom">

                                <h4 class="text-success">Local do projeto</h4>
                                <label for="estado" class="font-weight-bold">Estado: </label>
                                <select name="estado" class="form-control w-25 mb-4">
                                    <option value="">SP</option>
                                    <option value="">RJ</option>
                                </select>
                                <label for="cidade" class="font-weight-bold">Cidade: </label>
                                <select name="cidade" class="form-control w-50">
                                    <option value="">Campinas</option>
                                    <option value="">São Paulo</option>
                                </select> 

                                <hr class="border-top border-bottom">

                                <h4 class="text-success">Comunidade Participante</h4>

                                <label for="num_pessoas_unicamp_envolvidos" class="font-weight-bold">Número de pessoas da UNICAMP que serão envolvidas: </label>
                                <input type="text" name="num_pessoas_unicamp_envolvidos" class="form-control w-25 mb-4" placeholder="0">
                                <label for="num_pessoas_externas_envolvidas" class="font-weight-bold">Número de pessoas externas que serão envolvidas: </label>
                                <input type="text" name="num_pessoas_externas_envolvidas" class="form-control w-25 mb-4" placeholder="0">

                                <label for="realidade_social" class="font-weight-bold">Realidade social, econômica e cultural da Comunidade: (máx. 3000 caracteres)</label>
                                <textarea name="realidade_social" class="form-control" placeholder="Apresente a realidade social, econômica e cultural que fundamente a necessidade do desenvolvimento e da importância do projeto"></textarea>

                                <hr class="border-top border-bottom">

                                <h4 class="text-success">O projeto já está em execução?</h4>
                                Sim <input type="radio" name="projeto_execucao" value="sim">
                                Não <input type="radio" name="projeto_execucao" value="nao">

                                <hr class="border-top border-bottom">

                                <h4 class="text-success">Tipo de envolvimento da equipe com a Comunidade</h4>
                                <input type="radio" name="envolvimento_comunidade" value="Não conhece a comunidade"> Não conhece a comunidade <br>
                                <input type="radio" name="envolvimento_comunidade" value="Conhece a comunidade"> Conhece a comunidade <br>
                                <input type="radio" name="envolvimento_comunidade" value="Já houve contato com a comunidade"> Já houve contato com a comunidade <br>
                                <input type="radio" name="envolvimento_comunidade" value="Já houve outro projeto da equipe junto à comunidade"> Já houve outro projeto da equipe junto à comunidade <br>
                                <input type="radio" name="envolvimento_comunidade" value="Está totalmente integrada com a comunidade"> Está totalmente integrada com a comunidade <br>
                                <input type="radio" name="envolvimento_comunidade" value="Existe um documento de aceitação do projeto pela comunidade"> Existe um documento de aceitação do projeto pela comunidade
                                
                                <hr class="border-top border-bottom">
                            
                                <h4 class="text-success">Há parcerias com outras instituições (públicas ou privadas) para o desenvolvimento do projeto?</h4>
                                Sim <input type="radio" name="parcerias" id="parcerias_sim"  value="sim">
                                Não <input type="radio" name="parcerias" id="parcerias_nao"  value="nao">
                                <br>
                                <div id="arquivo_parceria" class="d-none">
                                    <label for="comprovante_parceria" class="font-weight-bold">Enviar o comprovante no campo abaixo: </label>
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
                                            <div class="box-body" id="comprovante-box-body"></div>
                                        </div>
                                    </div>
                                    <div class="dropzone-wrapper">
                                        <div class="dropzone-desc">
                                            <i class="glyphicon glyphicon-download-alt"></i>
                                            <p class="font-weight-bold">Arraste o comprovante aqui ou clique para selecionar.</p>
                                        </div>
                                        <input type="file" name="comprovante_parceria" class="dropzone" id="comprovante_arquivo">
                                    </div>
                                    <p class="text-warning font-size-16">O comprovante deve ser no formato PDF</p>
                                </div>
                                
                                <hr class="border-top border-bottom">

                                <h4 class="text-success">Envio do projeto: </h4>
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
                                        <div class="box-body" id="projeto-box-body"></div>
                                    </div>
                                </div>
                                <div class="dropzone-wrapper">
                                    <div class="dropzone-desc">
                                        <i class="glyphicon glyphicon-download-alt"></i>
                                        <p class="font-weight-bold">Arraste o pdf do projeto aqui ou clique para selecionar.</p>
                                        
                                    </div>
                                    <input type="file" name="pdf_projeto" class="dropzone" id="projeto_arquivo">
                                    
                                </div>
                                <p class="text-warning font-size-16">O projeto deve ter no mínimo 20 páginas e ser no formato PDF</p>
                            </div>
                            <div id="step-2" class="tab-pane" role="tabpanel">
                                <h3 class="text-success">Áreas Temáticas</h3>

                                <input type="checkbox" name="comunicacao" id="comunicacao"> Comunicação
                                <br>
                                <input type="checkbox" name="cultura" id="cultura"> Cultura
                                <br>
                                <input type="checkbox" name="direitos_humanos" id="direitos_humanos"> Direitos Humanos e Justiça
                                <br>
                                <input type="checkbox" name="educacao" id="educacao"> Educação
                                <br>
                                <input type="checkbox" name="meio_ambiente" id="meio_ambiente"> Meio Ambiente
                                <br>
                                <input type="checkbox" name="saude" id="sause"> Saúde
                                <br>
                                <input type="checkbox" name="tecnologia" id="tecnologia"> Tecnologia e Produção
                                <br>
                                <input type="checkbox" name="trabalho" id="trabalho"> Trabalho
                            </div>
                            <div id="step-3" class="tab-pane" role="tabpanel">
                                <h3 class="text-success">Linhas de Extensão</h3>
                                <div class="col-sm-12 row">
                                    <div class="col-md-6">
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Alfabetização e letramento de crianças, jovens e adultos; formação do leitor e do produtor de textos; incentivo à leitura; literatura; desenvolvimento de metodologias de ensino da leitura e da escrita e sua inclusão nos projetos político-pedagógicos das escolas.">
                                        <input type="radio" name="linha_extensao" value="1" data-bv-field="linha_extensao"> Alfabetização, Leitura e Escrita</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Dança, teatro, técnicas circenses, performance; formação, capacitação e qualificação de pessoas que atuam na área; memória, produção e difusão cultural e artística."><input type="radio" name="linha_extensao" value="2" data-bv-field="linha_extensao"> Artes Cênicas</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ações multiculturais, envolvendo as diversas áreas da produção e da prática artística em um único programa integrado; memória, produção e difusão cultural e artística."><input type="radio" name="linha_extensao" value="3" data-bv-field="linha_extensao"> Artes Integradas</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Escultura, pintura, desenho, gravura, instalação, apropriação; formação, memória, produção e difusão cultural e artística."><input type="radio" name="linha_extensao" value="4" checked="" data-bv-field="linha_extensao"> Artes Plásticas</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Artes gráficas, fotografia, cinema, vídeo; memória, produção e difusão cultural e artística."><input type="radio" name="linha_extensao" value="5" data-bv-field="linha_extensao"> Artes Visuais</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Elaboração, implementação e avaliação de planos estratégicos de comunicação; realização de assessorias e consultorias para organizações de natureza diversa em atividades de publicidade, propaganda e de relações públicas; suporte de comunicação a programas e projetos de mobilização social, a organizações governamentais e da sociedade civil."><input type="radio" name="linha_extensao" value="6" data-bv-field="linha_extensao"> Comunicação Estratégica</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Produção de origem animal, vegetal, mineral e laboratorial; manejo, transformação, manipulação, dispensação, conservação e comercialização de produtos e subprodutos."><input type="radio" name="linha_extensao" value="7" data-bv-field="linha_extensao"> Desenvolvimento de Produtos</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Elaboração de diagnóstico e de propostas de planejamento regional (urbano e rural) envolvendo práticas destinadas à elaboração de planos diretores, a soluções, tratamento de problemas e melhoria da qualidade de vida da população local, tendo em vista sua capacidade produtiva e potencial de incorporação na implementação das ações; participação em fóruns Desenvolvimento Local Integrado e Sustentável – DLIS; participação e assessoria a conselhos regionais, estaduais e locais de desenvolvimento e a fóruns de municípios e associações afins; elaboração de matrizes e estudos sobre desenvolvimento regional integrado, tendo como base recursos locais renováveis e práticas sustentáveis; permacultura; definição de indicadores e métodos de avaliação de desenvolvimento, crescimento e sustentabilidade."><input type="radio" name="linha_extensao" value="8" data-bv-field="linha_extensao"> Desenvolvimento Regional</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Constituição e/ou implementação de iniciativas de reforma agrária, matrizes produtivas locais ou regionais e de políticas de desenvolvimento rural; assistência técnica; planejamento do desenvolvimento rural sustentável; organização rural; comercialização; agroindústria; gestão de propriedades e/ou organizações; arbitragem de conflitos de reforma agrária; educação para o desenvolvimento rural; definição de critérios e de políticas de fomento para o meio rural; avaliação de impactos de políticas de desenvolvimento rural."><input type="radio" name="linha_extensao" value="9" data-bv-field="linha_extensao"> Desenvolvimento Rural e Questão Agrária</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Processos de investigação e produção de novas tecnologias, técnicas, processos produtivos, padrões de consumo e produção (inclusive tecnologias sociais, práticas e protocolos de produção de bens e serviços); serviços tecnológicos; estudos de viabilidade técnica, financeira e econômica; adaptação de tecnologias."><input type="radio" name="linha_extensao" value="10" data-bv-field="linha_extensao"> Desenvolvimento tecnológico</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Planejamento, implementação e avaliação de processos e metodologias visando proporcionar soluções e o tratamento de problemas das comunidades urbanas; urbanismo."><input type="radio" name="linha_extensao" value="11" data-bv-field="linha_extensao"> Desenvolvimento Urbano</label><br><label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Apoio a organizações e ações de memória social, defesa, proteção e promoção de direitos humanos; direito agrário e fundiário; assistência jurídica e judiciária, individual e coletiva, a instituições e organizações; bioética médica e jurídica; ações educativas e preventivas para garantia de direitos humanos."><input type="radio" name="linha_extensao" value="12" data-bv-field="linha_extensao"> Direitos Individuais e Coletivos</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Formação técnica profissional, visando a valorização, aperfeiçoamento, promoção do acesso aos direitos trabalhistas e inserção no mercado de trabalho."><input type="radio" name="linha_extensao" value="13" data-bv-field="linha_extensao"> Educação Profissional</label><br><label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Constituição e gestão de empresas juniores, pré-incubadoras, incubadoras de empresas, parques e pólos tecnológicos, cooperativas e empreendimentos solidários e outras ações voltadas para a identificação, aproveitamento de novas oportunidades e recursos de maneira inovadora, com foco na criação de empregos e negócios, estimulando a pró-atividade."><input type="radio" name="linha_extensao" value="14" data-bv-field="linha_extensao"> Empreendedorismo</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Defesa, proteção, promoção e apoio a oportunidades de trabalho, emprego e renda para empreendedores, setor informal, proprietários rurais, formas cooperadas/associadas de produção, empreendimentos produtivos solidários, economia solidária, agricultura familiar, dentre outros."><input type="radio" name="linha_extensao" value="15" data-bv-field="linha_extensao"> Emprego e Renda / Trabalho e Renda</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Planejamento, implementação e avaliação de metodologias de intervenção e de investigação tendo como tema o perfil epidemiológico de endemias e epidemias e a transmissão de doenças no meio rural e urbano; previsão e prevenção."><input type="radio" name="linha_extensao" value="16" data-bv-field="linha_extensao"> Endemias e Epidemias</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Difusão e divulgação de conhecimentos científicos e tecnológicos em espaços de ciência, como museus, observatórios, planetários, estações marinhas, entre outros; organização desses espaços."><input type="radio" name="linha_extensao" value="17" data-bv-field="linha_extensao"> Espaços de Ciência</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Práticas esportivas, experiências culturais, atividades físicas e vivências de lazer para crianças, jovens e adultos, como princípios de cidadania, inclusão, participação social e promoção da saúde; esportes e lazer nos projetos político-pedagógico das escolas; desenvolvimento de metodologias e inovações pedagógicas no ensino da Educação Física, Esportes e Lazer; iniciação e prática esportiva; detecção e fomento de talentos esportivos."><input type="radio" name="linha_extensao" value="18" data-bv-field="linha_extensao"> Esporte e Lazer</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Estilismo e moda"><input type="radio" name="linha_extensao" value="19" data-bv-field="linha_extensao"> Estilismo</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Uso correto de medicamentos para a assistência à saúde, em seus processos que envolvem a farmacoterapia; farmácia nuclear; diagnóstico laboratorial; análises químicas, físico-químicas, biológicas, microbiológicas e toxicológicas de fármacos, insumos farmacêuticos, medicamentos e fitoterápicos."><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Fármacos e Medicamentos</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Formação de Professores (Formação Docente)"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Formação de Professores (Formação Docente)</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Gestão do Trabalho"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Gestão do Trabalho</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Gestão Informacional"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Gestão Informacional</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Gestão Institucional"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Gestão Institucional</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Gestão Pública"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Gestão Pública</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Grupos Sociais Vulneráveis"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Grupos Sociais Vulneráveis</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Infância e Adolescência"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Infância e Adolescência</label>
                                        <br>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Inovação Tecnológica"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Inovação Tecnológica</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Jornalismo"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Jornalismo</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Jovens e Adultos"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Jovens e Adultos</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Línguas Estrangeiras"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Línguas Estrangeiras</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Metodologias e Estratégias de Ensino/Aprendizagem"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Metodologias e Estratégias de Ensino/Aprendizagem</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Mídias-Artes"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Mídias-Artes</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Mídias"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Mídias</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Música"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Música</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Organizações da Sociedade Civil e Movimentos Sociais e Populares"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Organizações da Sociedade Civil e Movimentos Sociais e Populares</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Patrimônio Cultural, Histórico, Natural e Imaterial."><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Patrimônio Cultural, Histórico, Natural e Imaterial.</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Pessoas com Deficiências, Incapacidades, e Necessidades Especiais."><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Pessoas com Deficiências, Incapacidades, e Necessidades Especiais.</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Propriedade Intelectual e Patente"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Propriedade Intelectual e Patente</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Questões Ambientais"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Questões Ambientais</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Recursos Hídricos"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Recursos Hídricos</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Resíduos Sólidos"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Resíduos Sólidos</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Saúde Animal"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Saúde Animal</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Saúde da Família"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Saúde da Família</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Saúde e Proteção no Trabalho"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Saúde e Proteção no Trabalho</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Saúde Humana"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Saúde Humana</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Segurança Alimentar e Nutricional"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Segurança Alimentar e Nutricional</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Segurança Pública e Defesa Social"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Segurança Pública e Defesa Social</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Tecnologia da Informação"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Tecnologia da Informação</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Temas Específicos/Desenvolvimento Humano."><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Temas Específicos/Desenvolvimento Humano.</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Terceira Idade"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Terceira Idade</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Turismo"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Turismo</label>
                                        <br>
                                        <label class="radio-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Uso de Drogas e Dependência Química"><input type="radio" name="linha_extensao" value="20" data-bv-field="linha_extensao"> Uso de Drogas e Dependência Química</label>
                                        <br>
                                    </div>
                                </div>  
                            </div>
                            <div id="step-4" class="tab-pane" role="tabpanel">
                                <h3 class="text-success">Dados Indicadores (Máx. 450 caracteres)</h3>
                                <div>
                                    <label class="text-secondary font-size-16">1. Por que o projeto deve ser enquadrado como iniciativa de extensão comunitária?</label>
                                    <textarea class="form-control  mb-3" name="1" id="1" cols="30" rows="5"></textarea>

                                    <label class="text-secondary font-size-16">2. Quais as contribuições do projeto para suas atividades de ensino, já realizadas ou potenciais?</label>
                                    <textarea class="form-control  mb-3" name="1" id="1" cols="30" rows="5"></textarea>

                                    <label class="text-secondary font-size-16">3. Quais as contribuições do projeto para suas atividades de pesquisa, já realizadas ou potenciais?</label>
                                    <textarea class="form-control  mb-3" name="1" id="1" cols="30" rows="5"></textarea>

                                    <label class="text-secondary font-size-16">4. Quais as contribuições esperadas do projeto para a formação acadêmica, profissional e cidadã dos alunos envolvidos?</label>
                                    <textarea class="form-control  mb-3" name="1" id="1" cols="30" rows="5"></textarea>

                                    <label class="text-secondary font-size-16">5. De que maneiras a comunidade externa à Unicamp será envolvida no projeto?</label>
                                    <textarea class="form-control  mb-3" name="1" id="1" cols="30" rows="5"></textarea>

                                    <label class="text-secondary font-size-16">6. Quais resultados e impactos de longo prazo o projeto deve trazer para a comunidade/sociedade?</label>
                                    <textarea class="form-control  mb-3" name="1" id="1" cols="30" rows="5"></textarea>

                                    <label class="text-secondary font-size-16">7. O projeto tem potencial para gerar novos conhecimentos, técnicas, metodologias ou formas de organização do trabalho e da gestão?</label>
                                    <textarea class="form-control  mb-3" name="1" id="1" cols="30" rows="5"></textarea>

                                    <label class="text-secondary font-size-16">8. De que forma será feito o acompanhamento do projeto e sua avaliação pela equipe responsável?</label>
                                    <textarea class="form-control  mb-3" name="1" id="1" cols="30" rows="5"></textarea>

                                    <label class="text-secondary font-size-16">9. Como o projeto pode contribuir para o estreitamento da relação entre a universidade e a sociedade?</label>
                                    <textarea class="form-control  mb-3" name="1" id="1" cols="30" rows="5"></textarea>

                                    <label class="text-secondary font-size-16">10. O projeto contribui com a constituição de redes que envolvam a produção, difusão e uso de conhecimentos e envolve outros parceiros e apoiadores?</label>
                                    <textarea class="form-control  mb-3" name="1" id="1" cols="30" rows="5"></textarea>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

@endsection