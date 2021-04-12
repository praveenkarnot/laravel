<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller {
  public function index() {
      $products = Product::latest()->paginate(5);
      return view('home.index',compact('products'))

          ->with('i', (request()->input('page', 1) - 1) * 5);

  }
}
