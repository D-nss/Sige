<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NotificationController extends Controller
{
    public function index() 
    {
        $user = User::where('email', 'aadilson@unicamp.br')->first();

        $notifications = $user->unreadNotifications;
        
        return view('notificacao.index', compact('notifications'));
    }

    public function show($id)
    {
        $user = User::where('email', 'aadilson@unicamp.br')->first();

        foreach ($user->unreadNotifications as $notification) {
            if($notification->id == $id) {
                return view('notificacao.show', compact('notification'));
            }
        }
    }

    public function markAsRead(Request $request)
    {
        $user = User::where('email', 'aadilson@unicamp.br')->first();

        $id = $request->notification_id;

        foreach ($user->unreadNotifications as $notification) {
            if($notification->id == $id) {
                if( $notification->markAsRead() == null ) {
                    session()->flash('status', 'Mensagem macada como lida com sucesso!');
                    session()->flash('alert', 'success');
        
                    return redirect()->to('notificacoes');
                }
                else {
                    session()->flash('status', 'Desculpe! Houve erro ao marcar mensagem como lida.');
                    session()->flash('alert', 'warning');
        
                    return redirect()->back();
                }
            }
        }

    }
}
