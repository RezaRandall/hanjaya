<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// call order_item_master_model
Use App\Models\Order_item_master_model;
// use PDF;

class OrderProcessController extends Controller
{
    public function order(){
        return view('orderProcess');
    }

    // Get Item Master List dropdown
    function getItemMasterList(){
        $itemList = DB::table('item_master')->orderBy('item_name', 'ASC')->get();
        return view('orderProcess', ['listItem' => $itemList]);
    }

    public function getItemPrice(Request $request)
    {
        $itemPrice = DB::table('item_master')
                    ->select('item_price_agen', 'item_price_penyalur', 'item_price_eceran', 'item_quantity')
                    ->where('item_id', $request->item_id)
                    ->first();
        return response()->json($itemPrice);
    }

    public function storeOrder(Request $request){
    $extracted = explode(":", $request -> itemIdSelected); // Explode the ID and Name and put them in array respectively.
    $totalPriceToInt = explode("Rp. ", $request -> totalPrice);

    $cbxAgen = $request -> chkAgen;
    $cbxPenyalur = $request -> chkPenyalur;
    $cbxEceran = $request -> chkEceran;
    $catchPrcItem = '';

    if($cbxAgen == 'on'){
        $prAgen = explode("Rp. ", $request -> prcAgen );
        $catchPrcItem = $prAgen[1];
    }else if ($cbxPenyalur == 'on'){
        $prPenyalur = explode("Rp. ", $request -> prcPenyalur );
        $catchPrcItem = $prPenyalur[1];
    }else if($cbxEceran == 'on'){
        $prEceran = explode("Rp. ", $request -> prcEceran );
        $catchPrcItem = $prEceran[1];
    }
            DB::table('order_item_master_model')->insert([
            'product_id' => (int)$extracted[0],
            'customer_name' => $request ->  customerName,
            'phone' => $request -> phone,
            'address' => $request -> address,
            'item_name' => $extracted[1],
            'qty' => $request -> qty,
            'uom' => $request -> uom,
            'item_price' => (int)$catchPrcItem,
            'total_price' => (int)$totalPriceToInt[1],
            'status' => $request -> status,
            'log_date_time' => date('Y-m-d')
        ]);
        return redirect('orderProcess');
    }

    // public function storeOrder(Request $req){
    //     $arrItem = array();
    //     $arrItem = explode(':', $req -> arrItem);
    //     return redirect('orderProcess');
    // }

}// Controller Close
