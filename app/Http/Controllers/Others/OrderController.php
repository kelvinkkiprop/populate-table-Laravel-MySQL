<?php

namespace App\Http\Controllers\Others;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use App\Models\Order;
use Auth;

class OrderController extends Controller
{
      //Construct
      public function __construct()
      {
          $this->middleware('auth');
      }
      
  
      /**
       * Index
       */
      public function index()
      {
          $orders = Order::orderBy('id', 'desc')->get();
        //   return $orders;
          return view('orders.all-orders')->with([
              'orders'=>$orders
            ]);
      }
}
