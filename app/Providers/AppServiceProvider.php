<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Housekeeper;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('*',function($view){
            $Count_house = Housekeeper::all()->count();
            $Count_user = User::all()->count();
            $Count_service = Service::all()->count();
            $Count_book = Book::all()->count();
            $view->with(compact('Count_house','Count_user','Count_service','Count_book'));
        });
    }
}
