<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;

class OrderController extends Controller {

    public function index(Request $request) {
        $orderQuery = Order::with('products','user');
        if($request->has('datefilter')){
            $dateArr = explode('-', $request->get('datefilter'));
            $dateFrom =  Carbon::createFromFormat('m/d/Y', trim($dateArr[0]))->format('Y-m-d');
            $dateTo =  Carbon::createFromFormat('m/d/Y', trim($dateArr[1]))->format('Y-m-d');
            $orderQuery->whereDate('created_at','>=',$dateFrom)->whereDate('created_at','<=',$dateTo);
        }
        $orders = $orderQuery->latest()->paginate(5);
        return view('orders.index',compact('orders'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function orderplace(Request $request){
        foreach($request->get('sku') as $productsku){
            $cartItem = Cart::instance($productsku)->restore(1);
            $cartItemDetail = $cartItem->get($productsku);
            if(!empty($cartItemDetail->name)){
                $product = Product::where('name',$cartItemDetail->name)->first();
                $order = new Order();
                $order->user_id = $cartItemDetail->id;
                $order->product_sku = $product->uuid;
                $order->price = $cartItemDetail->price;
                $order->quantity = $cartItemDetail->quantity;
                $order->save();
            }
        }
        return redirect()->route('home')->with('success', 'Order Place Successfully.');
    }
}
