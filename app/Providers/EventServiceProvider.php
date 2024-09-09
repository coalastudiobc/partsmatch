<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartProduct;
use App\Observers\OrderObserver;
use App\Observers\OrderItemObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Observers\CartProductObserver;
use Laravel\Cashier\Events\WebhookReceived;
use App\Listeners\StripeWebhookEventListner;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        WebhookReceived::class => [
            StripeWebhookEventListner::class,
        ],

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        CartProduct::observe(CartProductObserver::class);
        Order::observe(OrderObserver::class);
        OrderItem::observe(OrderItemObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
