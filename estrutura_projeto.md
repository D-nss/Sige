Estrutura do Projeto:

Camada de Modelos (Model):
- Ficarão na pasta app/Models

Camada de Controle (Controller):
- Estão na pasta app/Http/Controllers/
- De acordo com a lógica, será criado subpastas para divisão dos controllers

Camada de Visualização (View):
- Estão na pasta resources/views/
- De acordo com a lógica, será criado subpastas para divisão das views

Configuração das Rotas:
- Estão na pasta routes/web.php

Banco de Dados:
- As migrations estão database/migrations

Template -- ( Blade com bootstrap)
- Template baseado no bootstrap
-- CSS e Javascript estão em : 
- A base e chamadas das estruturas em html/css/javascript estão em resources/views/layouts/app.blade.php
- Para modificação dos cabeçalhos, sidebar, rodapé e alertas, estão em resources/views/layouts/_includes/
- Chamadas nas Views no Blade: 

@extends('layouts.app')
@section('title', 'Título da Pagina')
@section('content')

--- Código na View específica no Blade

@endsection
