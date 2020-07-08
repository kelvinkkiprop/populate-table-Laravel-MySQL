<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Add
use App\Models\Item;
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
        
        $items = Item::orderBy('id', 'desc')->get();
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

         //Items
        $items = Item::where('uid', Auth::user()->id)->get();
        return $items;
        $finalArray = array();
        foreach($items as $key=>$value){
           array_push($finalArray, array(
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
        Items::where('user', Auth::user()->id)->delete();
        return redirect()->back()->with('info', 'Items submitted!');
    }
        
}
