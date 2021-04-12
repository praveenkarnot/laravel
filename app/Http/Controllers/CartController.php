<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;
use Melihovv\ShoppingCart\Coupons\FixedDiscountCoupon;

class CartController extends Controller {

  public function addToCart($uuid, Request $request) {
    $qty = (int) $request->get('qty');
    $product = Product::where('uuid',$uuid)->first();
    $cartItem = Cart::add($product->id,$product->name,$product->price,$qty);

    Cart::instance($cartItem->getUniqueId())->store(1);
    if ($product->name == 'Pepsi Cola' && $qty == 3){
      Cart::addCoupon(new FixedDiscountCoupon($product->name, 20));
    }

    $cart = Cart::content();
    return view('home.cartdetail',compact('cart'));
  }
}
