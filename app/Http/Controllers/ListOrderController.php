<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// call order_item_master_model
Use App\Models\Order_item_master_model;
use App\Models\item_master;
use PDF;

class ListOrderController extends Controller
{
    public function print_pdf(){
        $printOrder = Order_item_master_model::all();

        $pdf = PDF::loadview('listOrderItem_pdf', ['listOrderItem'=>$printOrder]);
        return $pdf->stream();
    }
    public function getAllListOrder(){
        $data = array();
        $data['items'] = item_master::all();
        $data['orders'] = Order_item_master_model::all();
        $data['totalOrderPrice'] = Order_item_master_model::select('total_price')->get(count([]));
        return view('listOrderItem', compact('data'));
    }

     // Search list order by date
     public function searchListOrder(Request $request){
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $fromDate = date($fromDate);
        $toDate = date($toDate);

        $itemId = $request->get('itemFiltered');

        if( $itemId == "0" && $fromDate == null && $toDate == null){
            $data = array();
            $data['items'] = item_master::all();
            $data['orders'] = Order_item_master_model::all(); // get data order
            return view('listOrderItem', compact('data'));  // retrieve data order to view blade list order

        }if($itemId == "0" && $fromDate != null && $toDate != null){
            $data = array();
            $data['items'] = item_master::all();
            $data['orders'] = Order_item_master_model::select()
                ->where('log_date_time', '>=', $fromDate)
                ->where('log_date_time', '<=', $toDate)
                ->get();
                return view('listOrderItem', compact('data'));
        }
        if($itemId != "0" && $fromDate == null && $toDate == null ){
            $data = array();
            $data['items'] = item_master::all();
            $data['orders'] = Order_item_master_model::select()
                ->where('product_id', $itemId)
                ->get();
                return view('listOrderItem', compact('data'));
        }
         if ($itemId != "0" && $fromDate != null && $toDate != null){
            $data = array();
            $data['items'] = item_master::all();
            $data['orders'] = Order_item_master_model::select()
                ->where('log_date_time', '>=', $fromDate)
                ->where('log_date_time', '<=', $toDate)
                ->where('product_id', $itemId)
                ->get();
                return view('listOrderItem', compact('data'));
        }

    }
}
