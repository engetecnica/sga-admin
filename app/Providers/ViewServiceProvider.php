<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\{
    ConfiguracaoModulo,
    CadastroObra
};

class ViewServiceProvider extends ServiceProvider
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
        //
        view()->composer('*', function($view) {
            $view->with(
                [
                    'modulos_permitidos' => ConfiguracaoModulo::get_modulos_permitidos(),
                    'obras_lista' => CadastroObra::all()
                ]
            );
        });
    }
}