<!DOCTYPE html>
<html>
<head>
    <title>Termo de Ciência</title>
    <style>
        body {
            padding: 40px 60px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .mt {
            margin-top: 40px;
        }

        .header {
            display: flex; 
            justify-content: space-between;
            align-items: center;
        }

        .num-solicitacao {
            text-align: right;
        }

        .dados {
            margin: 8px 0;
            display: flex;
        }

        .dados-col-1 {
            display: flex;
            flex-direction: column;
        }

        .dados-col-2 {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-top: 8px;
        }
        
        .parecer {
            display: flex;
            flex-direction: column;
            margin: 8px 0;
        }

        .recurso {
            margin: 16px 0;
            font-size: 10px;
        }

        .recurso table {
            width: 100%;
            height: 100%;
            table-layout: fixed;
        }
        
        .recurso table th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .recurso table caption {
            font-weight: bold;
            font-size: 20px;
            background: #999;
        }

        .rubricas {
            margin: 16px 0;
            font-size: 10px;
        }

        .rubricas table {
            width: 100%;
            height: 100%;
            table-layout: fixed;
        }
        
        .rubricas table th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .rubricas table caption {
            font-weight: bold;
            font-size: 20px;
            background: #999;
        }

        .assinaturas {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-top: 16px;
        }

        .assinaturas .outorgado{
            text-align: center;
            font-weight: bold;
        }

        .assinaturas .reitor{
            text-align: center;
            font-weight: bold;
        }

        .deliberacao {
            font-size: 13px;
            text-align: justify;
        }

        .data {
            margin: 32px 0;
            
        }

        .page-break {
            page-break-after: always;
        }

        .prestacao-relatorio {
            display: flex;
            flex-direction: column;
        }

        .img-funcamp {
            width: 200px;
            margin-right: 16px;
        }

        .img-unicamp {
            width: 150px;
            margin-right: 16px;
        }

        .convenio {
            margin-top: 18px;
            display: flex;
            justify-content: space-between;
        }
        
    </style>
</head>
<body>
    <div class="page-break">
        <div class="header" >
            <img src="https://www.unicamp.br/unicamp/sites/default/files/styles/large/public/Logo_Unicamp__0.jpg?itok=sO9EjTTS" alt="Unicamp" class="img-unicamp">
            <h3>Sistema de Informações e Gerenciamento FAEPEX</h3>
        </div>
        <div class="num-solicitacao">
            <strong>Solicitação: 55/2023</strong>
        </div>
        <hr>
            @include('inscricao.termos.dados')
        <hr>
        <div class="parecer">
            <label for="">Parecer do Conselho Científico</label> Conceder R$7.528,00
        </div>
        <hr>
            @include('inscricao.termos.recursos')
        <div class="rubricas">
            <table>
                <caption>Discriminação das Rubricas</caption>
                <thead>
                    <tr>
                        <th>Nome do Item</th>
                        <th>Tipo do Item</th>
                        <th>Descrição</th>
                        <th>Justificativa</th>
                        <th>Valor R$</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Item 1</td>
                        <td>Tipo Item 1</td>
                        <td>Descrição Item 1</td>
                        <td>Justificativa do Item 1</td>
                        <td>80</td>
                    </tr>
                    <tr>
                        <td>Item 2</td>
                        <td>Tipo Item 2</td>
                        <td>Descrição Item 2</td>
                        <td>Justificativa do Item 2</td>
                        <td>150</td>
                    </tr>
                    <tr>
                        <td>Item 3</td>
                        <td>Tipo Item 3</td>
                        <td>Descrição Item 3</td>
                        <td>Justificativa do Item 3</td>
                        <td>120</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="page-break mt">
        <div class="header" >
            <img src="https://www.unicamp.br/unicamp/sites/default/files/styles/large/public/Logo_Unicamp__0.jpg?itok=sO9EjTTS" alt="Unicamp" class="img-unicamp">
            <h3>Sistema de Informações e Gerenciamento - FAEPEX Termo de Outorga</h3>
        </div>
        <div class="num-solicitacao">
            <strong>Solicitação: 55/2023</strong>
        </div>
        <hr>
            @include('inscricao.termos.dados')
        <hr>
            @include('inscricao.termos.recursos')
        <hr>
        <div class="prestacao-relatorio">
            OBS: Os recursos liberados pelo FAEPEX não podem ser aplicados no mercado financeiro.
            <label for="prestacao-contas">Prestação de Contas até: </label>
            <label for="relatorio-tecnico">Relatório(s) Técnico(s) até: </label>
        </div>
        <div class="assinaturas">
            <div class="outorgado">
                <p>_______________________________</p>
                <p>Francisco da Fonseca Rodrigues</p>
                <p>Outorgado</p>
            </div>
            <div class="reitor">
                <p>__________________________________</p>
                <p>Pró-Reitor de Pesquisa</p>
                <p>FAEPEX</p>
            </div>
        </div>
    </div>
    <div class="page-break mt">
        <div class="header" >
            <img src="https://www.unicamp.br/unicamp/sites/default/files/styles/large/public/Logo_Unicamp__0.jpg?itok=sO9EjTTS" alt="Unicamp" class="img-unicamp">
            <h3>Sistema de Informações e Gerenciamento - FAEPEX Termo de Outorga</h3>
        </div>
        <div class="num-solicitacao">
            <strong>Solicitação: 55/2023</strong>
        </div>
        <hr>
            @include('inscricao.termos.dados')
        <hr>
            @include('inscricao.termos.recursos')
        <hr>
        <div class="prestacao-relatorio">
            OBS: Os recursos liberados pelo FAEPEX não podem ser aplicados no mercado financeiro.
            <label for="prestacao-contas">Prestação de Contas até: </label>
            <label for="relatorio-tecnico">Relatório(s) Técnico(s) até: </label>
        </div>
    </div>
    <div class="page-break mt">
        <div class="header" >
            <img src="https://www.unicamp.br/unicamp/sites/default/files/styles/large/public/Logo_Unicamp__0.jpg?itok=sO9EjTTS" alt="Unicamp" class="img-unicamp">
            <h3>Sistema de Informações e Gerenciamento - FAEPEX Termo de Outorga</h3>
        </div>
        <div class="num-solicitacao">
            <strong>Solicitação: 55/2023</strong>
        </div>
        <hr>
        <div class="deliberacao">
            <p>
                O Fundo de Apoio ao Ensino, à Pesquisa e à Extensão, doravante designada Outorgante, usada das atribuições que
                lhe confere o artigo 5. da Deliberação CONSU-A-24/03, de 30 de setembro de 2003, defere ao Outorgado o auxílio
                especificado e sujeito às cláusulas e condições seguintes:
            </p>
            <ol type="I">
                <li>
                    O pagamento será feito de acordo com o plano de aplicação efetuado pelo Outorgado, com as modificações eventualmente feitas pela Outorgante.
                </li>
                <li>
                    O Outorgado fica pessoalmente responsável pela perfeita aplicação do Auxílio, que em hipótese alguma poderá ser destinado, ainda que parcialmente, a fins diversos dos indicados no preâmbulo deste termo.
                </li>
                <li>
                    Em caso de falta ou impedimento do Outorgado, será feita comunicação imediata ao FAEPEX.
                </li>
                <li>
                    Todo material permanente adquirido com os recursos do presente Auxílio, será de prioridade da UNICAMP,
                    ficando assegurado ao Outorgado a sua plena e efetiva utilização durante a execução dos projetos para os
                    quais foi concedido o Auxílio.
                </li>
                <li>
                    No caso de "Auxílio-ponte" ou pagamento de alunos auxiliares, o Outorgado atestará à Outorgante que o
                    beneficiário não receberá remuneração de quaisquer outras fontes, assumindo inteira responsabilidade pelo
                    beneficiário.
                </li>
                <li>
                    Sempre que, em virtude do auxílio deferido, for produzido trabalho técnico ou científico de divulgação, deverá
                    seu autor fazer, no mesmo, expressa referência à Outorgante.
                </li>
                <li>
                    Fica estabelecido que o projeto objeto deste termo resultar em invento patenteável, os direitos daídecorrentes,
                    assim como seus resultados econômicos, serão tratados de acordo com as normas da UNICAMP.
                </li>
                <li>
                    Fica certo também que, na hipótese da cláusula anterior, o registro de eventual patente se fará sempre em
                    nome da UNICAMP e do Outorgado, cabendo a qualquer deles a iniciativa do requerimento, dando ciência à
                    outra parte.
                </li>
                <li>
                    Apenas mediante anuência da UNICAMP poderá o Outorgado ceder parcial ou totalmente, onerosa ou
                    gratuitamente, os direitos resultantes da eventual invenção
                </li>
                <li>
                    O Outorgado obriga-se a apresentar ao FAEPEX relatório(s) sobre as atividades desenvolvidas com o uso dos
                    recursos concedidos. A data-limite para apresentação do(s) relatório(s) será estabelecida de acordo com o
                    tipo do projeto aprovado, qual seja:
                    <ol type="a">
                        <li>Até 18/05/2022.</li>
                    </ol> 
                </li>
                <li>
                    A prestação de contas do auxilio deferido será feita pelo Outorgado dentro das normas da FUNCAMP, devendo
                    ser observadas as instruções anexas, as quais passam a fazer parte integrante deste termo, dentro das
                    seguintes normas:
                    <ol type="a">
                        <li>O prazo para utilização dos recursos concedidos seguem o estipulado nos itens (a), do inciso X;</li>
                        <li>Se houver saldo dos recursos em mãos do Outorgado, o mesmo devolverá em dinheiro ou cheque no momento da prestação de contas,</li>
                        <li>Se houver saldo dos recursos ainda não utilizados pelo Outorgado, a FUNCAMP procederá ao recolhimento dos mesmos, imediatamente após o vencimento da data-limite para uso dos mesmos.</li>
                    </ol>
                </li>
                <li>
                    A violação de qualquer das cláusulas do presente termo implicará na suspensão do Auxílio concedido e/ou,
                    na retirada do material adquirido.
                </li>
                <li>
                    Fica o Outorgado ciente que, a partir da assinatura do presente termo, passará a integrar a lista de
                    pareceristas dos Editais financiados pela Outorgada (ProEC – Pró-Reitoria de Extensão e Cultura), devendo
                    realizar as avaliações dos projetos submetidos aos Editais, sempre que for solicitado.
                </li>
                <li>
                    O presente termo entrará em vigor na data de sua assinatura.
                </li>
                <li>
                    O Outorgado declara que aceita, sem restrições, o presente Auxílio, como está deferido e se responsabiliza
                    pelo fiel cumprimento em todos os seus termos, cláusulas e condições.
                </li>
            </ol>
        </div>
        <p class="data">Campinas,_____de____________________de____</p>
        <div class="assinaturas">
            <div class="outorgado">
                <p>______________________________</p>
                <p>Francisco da Fonseca Rodrigues</p>
                <p>Outorgado</p>
            </div>
            <div class="reitor">
                <p>_______________________________</p>
                <p>Pró-Reitor de Pesquisa pelo</p>
                <p>FAEPEX</p>
            </div>
        </div>
    </div>
    <div class="mt">
        <div class="header" >
            <img src="https://www.funcamp.unicamp.br/enfasud/Content/Imagens/logo_funcamp.png" alt="Unicamp" class="img-funcamp">
            <h4>FUNDO DE APOIO AO ENSINO, PESQUISA E EXTENSÃO - TERMO DE RESPONSABILIDADE</h4>
        </div>
        <div class="convenio">
            <strong>Convênio n°: 519.298</strong>
            <strong>Correntista n°:  / 2023</strong>
            <strong>Valor: R$ 7.528,00</strong>
        </div>
        <hr>
        <div class="deliberacao">
            <p>
            Pelo presente instrumento, o (a) Prof.(a) Francisco da Fonseca Rodrigues, responsável pelo Projeto de Pesquisa, declara estar
            ciente do procedimento estabelecido com relação à utilização dos recursos do Programa FAEPEX a seguir descrito:
            </p>
            <ol type="">
                <li>
                    O pagamento será feito de acordo com o plano de aplicação efetuado pelo Outorgado, com as modificações eventualmente feitas pela Outorgante.
                </li>
                <li>
                    É responsabilidade do outorgado o envio dos documentos fiscais originais devidamente quitados e identificados.
                </li>
                <li>
                    O auxílio deferido em hipótese alguma deverá ser destinado, ainda que parcialmente, a fins diversos dos indicados na ficha de
                    solicitação supra. O beneficiário é pessoalmente responsável pela perfeita aplicação
                    do auxílio, de acordo com a sua finalidade e com as normas para realização e comprovação de despesas fixadaspela
                    FUNCAMP.
                </li>
                <li>
                    Os recursos para despesas de custeio serão liberados pela FUNCAMP, parcial ou totalmente, mediantesolicitação do beneficiário
                    em impresso padrão da FUNCAMP.
                </li>
                <li>
                    A prestação de contas de uso do recurso liberado a título de suprimento, deve ser elaborada de acordo com as &quot;Normas para
                    Utilização dos Recurso Faepex&quot;, encaminhada via e-mail ao outorgado. Devendo ser encaminhado à Funcamp nos prazos estipulados.
                </li>
                <li>
                    O relatório técnico deverá ser encaminhado para a Pró Reitoria de Pesquisa - Faepex.
                </li>
                <li>
                    Os equipamentos e materiais permanentes adquiridos com recursos deste auxílio serão doados à UNICAMP.
                </li>
                <li>
                    Fica estabelecido que se as atividades objeto deste termo tiverem como resultados econômicos, estarão sujeitos as normas vigentes
                    na UNICAMP.
                </li>
                <li>
                    As responsabilidades administrativas e científicas junto à FUNCAMP e ao FAEPEX não cessam até a plena quitação das
                    responsabilidades do beneficiário pelas autoridades competentes dessas entidades.
                </li>
                <li>
                    Não será permitido solicitação de remuneração de bolsista ou profissional autônomo, do qual seja indicado seu cônjuge,
                    companheiro (a), parente, consanguíneo ou afim, em linha reta ou colateral, até o terceiro grau; bem como não requisitará a
                    contratação de empresa de propriedade de seu cônjuge, companheiro (a), parente, consanguíneo, ou afim, em linha reta ou colateral,
                    até o terceiro grau sem procedimento licitatório.
                </li>
                <li>
                    O beneficiário declara que aceita, sem restrições, o presente auxílio como está deferido e se responsabiliza pelo fiel cumprimento
                    do presente em todos os seus termos e condições.
                </li>
                <li>
                    O beneficiário declara estar recebendo, neste ato, os seguintes documentos:
                </li>                
            </ol>
            <ul>
                <li>
                    Manual de Instruções para utilização dos recursos do FAEPEX. (formato eletrônico)
                </li>
                <li>
                    Cópia de igual teor deste Termo de Responsabilidade de Auxílio.
                </li>
            </ul>
        </div>
        <p class="data">Campinas,_____de____________________de____</p>
        <div class="assinaturas">
            <div class="outorgado">
                <p>____________________________________________________</p>
                <p>Prof.(a) Francisco da Fonseca Rodrigues</p>
                <p>Reposnsável do Projeto - FAEPEX</p>
            </div>
        </div>
    </div>
    
</body>
</html>