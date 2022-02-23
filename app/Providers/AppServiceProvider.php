<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Para poder rodar as migrations numa versão inferior do MySQL, e evitar o Erro 1071 na execução do SQL
        //Schema::defaultStringLength(191);

        //Para deixar um URL em português nas rotas com o uso das resources
        Route::resourceVerbs([
            'create' => 'novo',
            'edit' => 'editar'
        ]);
    }
}
