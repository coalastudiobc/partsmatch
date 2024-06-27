<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemObserver
{
    /**
     * Handle the OrderItem "created" event.
     */
    public function created(OrderItem $orderItem): void
    {
        $order = Order::where('id', $orderItem->order_id)->first();
        $orderProducts = orderItem::where('order_id', $order->id)->get();
        $total = 0;
        foreach ($orderProducts as $orderProduct) {
            $total += $orderProduct->quantity * $orderProduct->product_price;
        }
        $order->update([
            'total_amount' => $total,
        ]);

        $product = Product::where('id', $orderItem->product_id)->first();

        $quantity = $product->stocks_avaliable - $orderItem->quantity;
        $product->update(['stocks_avaliable' => $quantity]);
    }

    /**
     * Handle the OrderItem "updated" event.
     */
    public function updated(OrderItem $orderItem): void
    {
        // $order = Order::where('id', $orderItem->order_id)->first();
        // $orderProducts = orderItem::where('order_id', $order->id)->get();
        // $total = 0;
        // foreach ($orderProducts as $orderProduct) {
        //     $total += $orderProduct->quantity * $orderProduct->product_price;
        // }
        // $order->update([
        //     'total_amount' => $total,
        // ]);
    }

    /**
     * Handle the OrderItem "deleted" event.
     */
    public function deleted(OrderItem $orderItem): void
    {
        //
    }

    /**
     * Handle the OrderItem "restored" event.
     */
    public function restored(OrderItem $orderItem): void
    {
        //
    }

    /**
     * Handle the OrderItem "force deleted" event.
     */
    public function forceDeleted(OrderItem $orderItem): void
    {
        //
    }
}
