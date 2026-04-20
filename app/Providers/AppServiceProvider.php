<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('jdate', function ($expression) {
            return "<?php echo \\App\\Support\\PersianDate::format($expression); ?>";
        });

        Blade::directive('jdatetime', function ($expression) {
            return "<?php echo \\App\\Support\\PersianDate::format($expression, true); ?>";
        });

        Blade::directive('jyearmonth', function ($expression) {
            return "<?php echo \\App\\Support\\PersianDate::yearMonth($expression); ?>";
        });

        Blade::directive('gdate', function ($expression) {
            return "<?php echo \\App\\Support\\PersianDate::inputValue($expression); ?>";
        });
    }
}
