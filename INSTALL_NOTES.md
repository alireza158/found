## ثبت Middleware در پروژه مقصد

### Laravel 10 (app/Http/Kernel.php)
در `$middlewareAliases` اضافه کنید:
```php
'ff.auth' => \App\Http\Middleware\FfAuth::class,
'ff.admin' => \App\Http\Middleware\FfAdmin::class,
```

### Laravel 11 (bootstrap/app.php)
در بخش middleware اضافه کنید:
```php
->withMiddleware(function (\Illuminate\Foundation\Configuration\Middleware $middleware) {
    $middleware->alias([
        'ff.auth' => \App\Http\Middleware\FfAuth::class,
        'ff.admin' => \App\Http\Middleware\FfAdmin::class,
    ]);
})
```
