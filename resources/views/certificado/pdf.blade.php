<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">

    <title>Certificado em PDF</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @font-face {
            font-family: 'Source Sans Pro';
            font-style: normal;
            font-weight: normal;
            src: url({{ storage_path('fonts/SourceSansPro-Regular.ttf') }}) format('truetype');
        }

        body {
            background-image: url({{ $bg_base64 }});
            background-repeat: no-repeat;
            background-size: cover;
            font-family: 'Source Sans Pro', sans-serif;
        }
    </style>

</head>
@php
    $data_inicio = strtotime($participante->evento->data_inicio);
    $data_fim = strtotime($participante->evento->data_fim);

    $dia_inicio = date('d', $data_inicio);
    $mes_inicio = date('m', $data_inicio);
    $ano_inicio = date('Y', $data_inicio);

    $dia_fim = date('d', $data_fim);
    $mes_fim = date('m', $data_fim);
    $ano_fim = date('Y', $data_fim);

    $data_formatada = '';

    if ($dia_inicio == $dia_fim && $mes_inicio == $mes_fim && $ano_inicio == $ano_fim) {
        $data_formatada = 'na data de ' . $dia_inicio . ' de ' . $meses[$mes_inicio] . ' de ' . $ano_inicio;
    } elseif ($mes_inicio == $mes_fim && $ano_inicio == $ano_fim) {
        $data_formatada = 'no período de ' . $dia_inicio . ' a ' . $dia_fim . ' de ' . $meses[$mes_fim] . ' de ' . $ano_fim;
    } else {
        $data_formatada = 'no período de ' . $dia_inicio . ' de ' . $meses[$mes_inicio] . ' de ' . $ano_inicio . ' a ' . $dia_fim . ' de ' . $meses[$mes_fim] . ' de ' . $ano_fim;
    }

    $carga_horaria_formatada = '';

    if ($tipo == 'equipe') {
        if (isset($participante->carga_horaria)) {
            if ($participante->carga_horaria > 1) {
                $carga_horaria_formatada = $participante->carga_horaria . ' horas';
            } else {
                $carga_horaria_formatada = $participante->carga_horaria . ' hora';
            }
        } elseif ($participante->evento->carga_horaria > 1) {
            $carga_horaria_formatada = $participante->evento->carga_horaria . ' horas';
        } else {
            $carga_horaria_formatada = $participante->evento->carga_horaria . ' hora';
        }
    } elseif ($participante->evento->carga_horaria > 1) {
        $carga_horaria_formatada = $participante->evento->carga_horaria . ' horas';
    } else {
        $carga_horaria_formatada = $participante->evento->carga_horaria . ' hora';
    }
@endphp

<body style="">
    <div style="margin-top: 250px;">
        <h3 style="text-align: center; color: #666;">
            PROEC - Pró-Reitoria de Extensão e Cultura concede a
        </h3>
    </div>

    <h1 style="margin-top: 60px; text-align: center; color: #952727; text-transform: uppercase; font-weight: 400;">
        @if (isset($participante->nome_social))
            {{ $participante->nome_social }}
        @else
            {{ $participante->nome }}
        @endif
    </h1>
    <h3 style="text-align: center; margin-top: 12px; padding: 0 128;font-weight: 400; color: #444;">
        este certificado, por
        @if (isset($participante->status_arquivo) && $participante->status_arquivo == 'Aceito')
            apresentar(em) o trabalho intitulado {{ $participante->titulo_trabalho }},
        @else
            @if ($tipo != 'equipe')
            participar
            @endif
        @endif
        @if ($tipo == 'equipe')
            @if (isset($participante->titulo_palestra))
                ministrar a palestra intitulada "{{ $participante->titulo_palestra }}"
            @else
                participar da comissão de organização
            @endif
        @endif do evento
        @if ($participante->evento->online != null)
            on-line
        @endif

        "{{ $participante->evento->titulo }}"
        {{ $data_formatada }}
        @if ($participante->evento->carga_horaria != null)
            , com carga horária de {{ $carga_horaria_formatada }}
        @endif
        .
    </h3>
    <h3 style="text-align: center; margin-top: 12px; font-weight: 400; color: #444;">
        Campinas,
        {{ date('d', strtotime($participante->evento->data_fim)) . ' de ' . $meses[strftime('%m', strtotime($participante->evento->data_fim))] . ' de ' . date('Y', strtotime($participante->evento->data_fim)) }}
    </h3>
    <p
        style="
            position: absolute;
            bottom: 50px;
            left: 50px;
            font-size: 12px;
            color: #444;
        ">
        @if ($participante->certificado != null)
            Código: {{ $participante->certificado }}<br>
        @else
            Código: não gerado<br>
        @endif
        Verifique a autenticidade desse certificado em:<br>
        {{ url('certificado/validar') }}
    </p>
</body>

</html>
