<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $category = [];
        $orders = Order::where('created_at', '>=', DB::raw('curdate()'))->get();
        foreach($orders as $order){
            $products = $order->products()->get();
            foreach($products as $product){
                if(array_key_exists($product->category, $category)){
                    $category[$product->category] = $category[$product->category] + $order->products()->where('product_id', $product->id)->first()->pivot->quantity;
                }
                else{
                    $category[$product->category] = $order->products()->where('product_id', $product->id)->first()->pivot->quantity;
                }
            }
        }

        // $category = (object)$category;
        Mail::to(Config::get('app.MAIL_FROM'))->send(new SendMailable($category));
    }
}
