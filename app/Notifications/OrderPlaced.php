<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Order;

class OrderPlaced extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $order;
    public function __construct(Order $order)
    {
        $this->order=$order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        // Create the base message
        $message = (new MailMessage)
                    ->subject('Order Placed')
                    ->line('Order ID: ' . $this->order->id)
                    ->line('Your order has been placed successfully.')
                    ->line('Order total shipment charges: $' . number_format($this->order->shipment_price, 2))
                    ->line('Grand Total: $' . number_format($this->order->shipment_price + $this->order->total_amount, 2));
        
                    if ($this->order->user_id == $notifiable->id) {
                        $message->line('Thank you for shopping with us!');
                    } elseif ($notifiable->hasRole('Administrator')) {
                            $buyerName = $this->order->buyerDetail ? $this->order->buyerDetail->name : 'buyer name  not found';
                            $buyerEmail = $this->order->buyerDetail ? $this->order->buyerDetail->email : 'buyer email not found';
                            $sellerName = $this->order->sellerDetail ? $this->order->sellerDetail->name :  'seller name  not found'; 
                            $sellerEmail = $this->order->sellerDetail ? $this->order->sellerDetail->email :  'seller name  not found'; 
                            
                            $message->line('Order details:')
                                    ->line('Buyer: ' . $buyerName)
                                    ->line('Buyer Email: ' . $buyerEmail)
                                    ->line('Seller: ' . $sellerName)
                                    ->line('Seller Email: ' . $sellerEmail);
                    }
                    else {
                        $buyerName = auth()->user()->name ?? 'buyer name';
                        $message->line('This order has been placed successfully by ' . $buyerName);
                    }
                    return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
