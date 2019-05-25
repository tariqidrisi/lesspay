<?php

namespace App\Mail;

use App\Products;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;

    protected $user_data;
    protected $orders;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_data, $orders)
    {
        $this->user_data = $user_data;
        $this->orders = $orders;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user_data = $this->user_data;
        $orders = $this->orders;

        // foreach($get_orders as $ord_id) {
        //     $order_ids[] = $ord_id['product_id'];
        // }
        dd($orders);
        return $this->view('email', compact('user_data', 'orders'));
    }
}
