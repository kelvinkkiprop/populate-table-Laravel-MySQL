<?php

namespace App\Http\Controllers\Others;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Add
use App\Models\Item;
use App\Models\Order;
use Auth;

class ItemController extends Controller
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
        $items = Item::where('uid', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('items.add-item')->with('info', 'Login successful!')->with(['items'=>$items]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|integer|min:1',
        'total' => 'required|integer|min:1',
    ]);
    
        $item = new Item;
        $item->uid =  Auth::user()->id;
        $item->name = $request->input('name');             
        $item->quantity = $request->input('quantity');
        $item->price = $request->input('price');  
        $item->total = $request->input('total');        
        $item->save();
        
        $items = Item::where('uid', Auth::user()->id)->orderBy('id', 'desc')->get();
        return redirect()->back()->with('items', $items)->with('info', 'Item added!');
    }

    /**
     * Remove
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect()->back()->with('danger', 'Item removed!');
    }

    /**
     * Computing
     */
    public function computing($price, $quantity)
    {    
        $total = $price * $quantity;

        return response()->json([
            'total' => $total,
        ]);     
    }



    //Save Table Items
    public function saveTableItems()
    {
        
        //Get from code from generateRandomString method
        $vouchercode = $this->generateRandomString(6);// it should be dynamic and unique 
        //return $vouchercode;

         //Items
        $items = Item::where('uid', Auth::user()->id)->get();
        // return $items;
        $finalArray = array();
        foreach($items as $key=>$value){
           array_push($finalArray, array(
                'code'=>$vouchercode,
                'uid'=>Auth::user()->id,
                'name'=>$value['name'],
                'quantity'=> $value['quantity'],                
                'price'=>$value['price'],
                'total'=> $value['total'], 
                )
           );

        }
        //return $finalArray;
        Order::insert($finalArray);   
        
        //Delete
        Item::where('uid', Auth::user()->id)->delete();
        return redirect()->back()->with('info', 'Items submitted!');
    }

        //Code generator
        public function generateRandomString($length = 20) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        
}
