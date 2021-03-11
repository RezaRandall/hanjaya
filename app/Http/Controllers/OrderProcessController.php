<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// call order_item_master_model
Use App\Models\Order_item_master_model;
use PDF;

class OrderProcessController extends Controller
{
    public function order(){
        return view('orderProcess');
    }

    // Get Item Master List
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

    public function getListOrder(){
        // get data order
        $order = Order_item_master_model::all();

        // retrieve data order to view blade lisr order
        return view('listOrderItem', ['orderList' => $order]);
    }

    public function storeOrder(Request $request){
    // Explode the ID and Name and put them in array respectively.
    $extracted = explode(":", $request -> itemIdSelected);
    $totalPriceToInt = explode("Rp. ", $request -> totalPrice);

    $cbxAgen = $request -> chkAgen;
    $cbxPenyalur = $request -> chkPenyalur;
    $cbxEceran = $request -> chkEceran;
    $catchPrcItem = '';


    if($cbxAgen == 'on'){
        $prAgen = explode("Rp. ", $request -> prcAgen );
        // return $catchPrcItem = $prAgen[1];
        $catchPrcItem = $prAgen[1];
    }else if ($cbxPenyalur == 'on'){
        $prPenyalur = explode("Rp. ", $request -> prcPenyalur );
        // return $catchPrcItem $prPenyalur[1];
        $catchPrcItem = $prPenyalur[1];
    }else if($cbxEceran == 'on'){
        $prEceran = explode("Rp. ", $request -> prcEceran );
        // return $catchPrcItem = $prEceran[1];
        $catchPrcItem = $prEceran[1];
    }

    // $qtyRequest = $request -> qty;
    // $stockReady = explode("in stock: ", $request -> qtyReady);
    // $catchQty = '';
    // if($stockReady[1] <= $qtyRequest){
    //     $stockReady[1] = 0;
    // }
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
            'log_date_time' => date('Y-m-d H:i:s')
        ]);
        return redirect('orderProcess');
    }

    public function print_pdf(){
        $printOrder = order_item_master_model::all();

        $pdf = PDF::loadview('listOrderItem_pdf', ['listOrderItem'=>$printOrder]);
        return $pdf->stream();
    }

    // Search list order by date
    public function searchListOrder(Request $request){
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $fromDate = date($fromDate);
        $toDate = date($toDate);

        if($fromDate == null && $toDate == null){
            // get data order
            $order = order_item_master_model::all();

            // retrieve data order to view blade lisr order
            return view('listOrderItem', ['orderList' => $order]);
        }else{
            $query = DB::table('order_item_master_model')->select()
                ->where('log_date_time', '>=', $fromDate)
                ->where('log_date_time', '<=', $toDate)
                ->get();
            // dd($query);
            return view('listOrderItem', ['orderList'=>$query]);
        }
    }

}// Controller Close
