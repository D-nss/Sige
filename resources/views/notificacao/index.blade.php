@extends('layouts.app')

@section('title', 'Notificações')

@section('content')
<div class="container-fluid">

    <div class="subheader">
        <h1 class="subheader-title">
            <span class="text-success">Notificações</span>
            <small>
            Suas notificações ainda não lidas
            </small>
        </h1>
        <div class="subheader-block d-lg-flex align-items-center">
            <div class="d-inline-flex flex-column justify-content-center">
            
            </div>
        </div>
    </div>

    <div class="row panel p-4">
        <div class="col-xl-12">

            <div class="card-body">
                @forelse($notifications as $notification)
                    <div class="p-1 mb-5 bg-white hv-light-green rounded">
                        <span class="d-flex flex-column flex-1 ml-1">
                            <span class="name">{{ $notification->data['dados']['titulo'] }}</span>
                            <span class="msg-a fs-sm mt-1 text-primary">{{ $notification->data['mensagem'] }}</span>
                            <span class="fs-nano text-muted mt-1">{{ date('d/m/Y H:i:s', strtotime($notification->created_at)) }}</span>
                            <span>
                                <form action="{{ route('marcar.como.lida')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="notification_id" value="{{ $notification->id}}">
                                    <button type="submit" class="btn btn-success mt-2">Marcar como lida</button>
                                </form>
                            </span>
                        </span>
                    </div>                    
                @empty
                    <div class="p-1 mb-5 bg-white hv-light-green rounded">
                        <h4>Você não possui notificações</h4>
                    </div>
                @endforelse
            </div>
                
        </div>
    </div>
</div>

@endsection