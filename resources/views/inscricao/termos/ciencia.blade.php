<!DOCTYPE html>
<html>
<head>
    <title>Termo de Ciência</title>
    <style>
        body {
            padding: 40px 60px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .unicamp-logo{
            width: 60px;
            margin-right: 100px;
        }

        .proec-logo{
            width: 105px;
        }

        .dproj-logo{
            width: 95px;
            margin-left: 100px;
        }

        .header {
            text-align: center;
        }

        .title {
            margin-top: 100px;
            text-align: center;
        }

        .paragrafo {
            margin-top: 150px;
            text-align: justify;
            line-height: 32px;
            font-size: 16px;
        }

        .assinatura {
            margin-top: 100px;
            text-align: center;
        }

        .assinatura strong {
            font-style: italic;
        }

        .assinatura-coordenador {
            margin-top: 100px;
            text-align: center;
        }

        .assinatura-coordenador  strong {
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
       <img src="{{ $base64ImageUnicamp }}" alt="Unicamp" class="unicamp-logo">
       <img src="{{ $base64ImageProec }}" alt="Proec" class="proec-logo">
       <img src="{{ $base64ImageDproj }}" alt="Dproj" class="dproj-logo">
    </div>
    <h2 class="title">Termo de Ciência da Unidade</h2>
    
    <p class="paragrafo">
    A <strong>{{ $siglaUnidade }}</strong>, por meio de sua Comissão de Extensão ou equivalente,
    declara estar ciente da submissão do projeto intitulado <strong>{{ $inscricaoTitulo }}</strong>, sob coordenação de {{ $inscricaoCoordenador }}, ao {{ $editalTitulo }}.
    </p>
   
    <div class="assinatura">
        <p>_______________________________________</p>
        <strong>Assinatura do Coordenador do Projeto</strong>
        <p>Tel. de contato: ___________________________</p>
    </div>
    
   
    <div class="assinatura-coordenador">
        <p>___________________________________________________</p>
        <strong>Coordenador(a) de Extensão/Diretor(a) da unidade</strong>
    </div>
    
</body>
</html>