<?php

namespace App\Providers;

use App\Models\Project;
use App\Observers\ProjectObserver;
use App\Models\Store;
use App\Observers\StoreObserver;
use App\Models\Order;
use App\Observers\OrderObserver;
use App\Models\Catagory;
use App\Observers\CatagoryObserver;
use App\Models\Coupon;
use App\Observers\CouponObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Project::observe(ProjectObserver::class);
        Store::observe(StoreObserver::class);
        Order::observe(OrderObserver::class);
        Catagory::observe(CatagoryObserver::class);
        Coupon::observe(CouponObserver::class);


    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
