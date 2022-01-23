<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use DB;
use Mail;
use Config;
use App\Mail\SendMailable;

class CategoryWiseAnalysis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analysis:categorywise';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email for category wise analysis.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
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
