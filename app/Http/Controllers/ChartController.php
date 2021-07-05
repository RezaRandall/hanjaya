<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\item_master;
use App\Models\Order_item_master_model;
use View;

class ChartController extends Controller
{
    // public function graphCharts(){
    //     $itemChart['chart'] = item_master::select('item_name')->get();
    //     $datas = [];
    //     $data = [];
    //     $data['items'] = json_decode(item_master::all());
    //     $data['orders'] = Order_item_master_model::all();

    //     foreach($dataItem['chart'] as $d){
    //         array_push($datas, $d->item_name);
    //     }
    //     return view('listOrderItem', \compact('data', 'datas'));
    // }

}
