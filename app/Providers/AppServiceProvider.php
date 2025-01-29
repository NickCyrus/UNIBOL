<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;

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
        
        Blade::directive('currency', function ($money) {
            return "<?php echo '$ '.number_format($money, 2 ,',','.'); ?>"; 
        });

        Blade::directive('number', function ($money) {
            return "<?php echo number_format($money, 2 ,',','.'); ?>"; 
        });
        
        Blade::directive('checked', function($value = ''){
            return ($value) ? 'checked' : '';
        });

        Blade::if('checkedState', function($value = ''){
            return ($value == 1) ? true : false;
        });


        Blade::directive('State', function($value){
            return "<?php echo 'checked'; ?>";
        });

        Blade::if('canEdit', function(){
            $permisos = session('permission');
            $moduleId = session('moduleId'); 
            return  ($permisos[$moduleId]->aedit == 1) ? true : false;
        });

        Blade::if('canDel', function(){
            $permisos = session('permission');
            $moduleId = session('moduleId'); 
            return  ($permisos[$moduleId]->adelete == 1) ? true : false;
        });

        Blade::if('canNew', function(){
            $permisos = session('permission');
            $moduleId = session('moduleId'); 
            return  ($permisos[$moduleId]->anew == 1) ? true : false;
        });

        Blade::if('canView', function(){
            $permisos = session('permission');
            $moduleId = session('moduleId'); 
            return  ($permisos[$moduleId]->aview == 1) ? true : false;
        });

        if (ENV('APP_URL') != 'http://127.0.0.1:8000'){
            \URL::forceScheme('https');    
        }

         
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_ALL, 'es_CO', 'es', 'ES', 'es_CO.utf8');
        
      
        
    }
}
