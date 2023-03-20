<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">

        <title>Certificado em PDF</title>

        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: normal;
                src: url({{ storage_path("fonts/SourceSansPro-Regular.ttf") }}) format('truetype');
            }

            body {
                /* background-image: url("{{url('storage/upload/96d9c9ce_1.png')}}"); */
                /* background-image: url("/storage/{{ $bg }}"); */
                background-image: url({{ $bg_base64 }});
                background-repeat: no-repeat;
                background-size: cover;
                font-family: 'Source Sans Pro', sans-serif;
            }

        </style>
    </head>
    <body style="">
        <div style="margin-top: 250px;">
            <h3 style="text-align: center; color: #666;">
                PROEC - Pró-Reitoria de Extensão e Cultura concede a
            </h3>
        </div>

        <h1 style="margin-top: 60px; text-align: center; color: #952727; text-transform: uppercase; font-weight: 400;">
            {{ $participante->nome }}
        </h1>
        <h3 style="text-align: center; margin-top: 12px; padding: 0 128;font-weight: 400; color: #444;">
            portador do CPF número 33377777722 este certificado por participar do evento
            @if($participante->evento->online != NULL)
                on-line
            @endif

            "{{ $participante->evento->titulo }}"
            no período de {{ date('d', strtotime($participante->evento->data_inicio)) . ' a ' . date('d', strtotime($participante->evento->data_fim)) . ' de ' . $meses[strftime('%m', strtotime($participante->evento->data_fim))] .' de '. date('Y', strtotime($participante->evento->data_fim)) }}
            @if($participante->evento->carga_horaria != NULL)
            , com carga horária de 2 horas
            @endif
            .
        </h3>
        <h3 style="text-align: center; margin-top: 12px; font-weight: 400; color: #444;">
            Campinas, {{ date('d', strtotime($participante->evento->data_inicio)) . ' de ' . $meses[strftime('%m', strtotime($participante->evento->data_fim))] .' de '. date('Y', strtotime($participante->evento->data_fim)) }}
        </h3>
        <p style="
            position: absolute;
            bottom: 50px;
            left: 50px;
            font-size: 12px;
            color: #444;
        ">
            @if($participante->certificado != NULL)
            Código: {{$participante->certificado}}<br>
            @else
            Código: não gerado<br>
            @endif
            Verifique a autenticidade desse certificado em:<br>
            https://sistemas.proec.unicamp.br/admin/certificados/verifica
        </p>
    </body>
</html>
