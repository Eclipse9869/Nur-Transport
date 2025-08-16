<?php

namespace App\Providers;

use App\Models\Transaction;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        //
        View::composer('*', function ($view) {
            $newTransactions = Transaction::where('status', 'Pending payment')
                ->latest()
                ->take(5)
                ->get();
    
            $view->with('newTransactions', $newTransactions)
                 ->with('newTransactionCount', $newTransactions->count());
        });
    }
}
