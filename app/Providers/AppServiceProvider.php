<?php

namespace App\Providers;

use App\Interfaces\IAdvertService;
use App\Interfaces\IImageService;
use App\Interfaces\ILocaleService;
use App\Interfaces\IPartnerPlanOptionService;
use App\Interfaces\IPaymentTransactionService;
use App\Interfaces\IPlanService;
use App\Interfaces\IRequestService;
use App\Services\AdvertService;
use App\Services\ImageService;
use App\Services\LocaleService;
use App\Services\PartnerPlanOptionService;
use App\Services\PaymentTransactionService;
use App\Services\PlanService;
use App\Services\RequestService;
use App\User;
use App\View\Composers\SettingsComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        $this->app->register(TelescopeServiceProvider::class);
        $this->app->bind(IPaymentTransactionService::class, PaymentTransactionService::class);
        $this->app->bind(IPartnerPlanOptionService::class, PartnerPlanOptionService::class);
        $this->app->bind(IImageService::class, ImageService::class);
        $this->app->bind(IPlanService::class, PlanService::class);
        $this->app->bind(IAdvertService::class, AdvertService::class);
        $this->app->bind(ILocaleService::class, LocaleService::class);
        $this->app->bind(IRequestService::class, RequestService::class);
    }

    public function boot(): void
    {
        Cashier::useCustomerModel(User::class);
        Vite::macro('image', fn(string $img) => $this->asset(trim("resources/images/$img")));
        Paginator::useBootstrapFive();

        // Migrations mysql string length
        Schema::defaultStringLength(191);
        View::composer("*", SettingsComposer::class);
    }


}
