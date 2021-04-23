<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\item_master;
use PDF;

class ItemMasterController extends Controller
{

    public function itemMaster(){
        // get data from table item_master
        $item = DB::table('item_master')->orderBy('item_id', 'ASC')->get();

        // post data from view item master home
        return view('itemMaster', ['item_master' => $item]);
    }

    // insert data method in to table item_master
    public function storeItemMaster(Request $request){
        DB::table('item_master')->insert([
            'item_code' => $request -> CodeItem,
            'item_name' => $request -> NameItem,
            'item_quantity' => $request -> QtyItem,
            'item_uom' => $request -> UomItem,
            'item_price_agen' => $request -> PriceAgen,
            'item_price_penyalur' => $request -> PricePenyalur,
            'item_price_eceran' => $request -> PriceEceran,
            'log_date_time' => date('Y-m-d H:i:s'),
        ]);

        // Switch page back to index
        return redirect('itemMaster');
    }

    // delete data method from table item_master
    public function deleteItemMaster($id){
        DB::table('item_master')->where('item_id', $id)->delete();

        // switch page back to index
        return redirect('itemMaster');
    }

    public function edit($id){
        // take data from table item_master by selected id
        $items = DB::table('item_master')->where('item_id', $id)->get();

        // parsing data item get obtained from selected item
        return view('edit', ['editItem' => $items]);
    }

    public function update(Request $request){
        $add = $request -> input('addQty');
        if($add == null || $add == ""){
            DB::table('item_master')->where('item_id', $request -> id)->update([
                'item_code' => $request -> CodeItem,
                'item_name' => $request -> NameItem,
                'item_quantity' => $request -> QtyItem,
                'item_uom' => $request -> UomItem,
                'item_price_agen' => $request -> PriceAgen,
                'item_price_penyalur' => $request -> PricePenyalur,
                'item_price_eceran' => $request -> PriceEceran,
                'log_date_time' => date('Y-m-d H:i:s'),
            ]);
        }else{
            DB::table('item_master')->where('item_id', $request -> id)->update([
                'item_code' => $request -> CodeItem,
                'item_name' => $request -> NameItem,
                'item_quantity' => $request -> qtyTotal,
                'item_uom' => $request -> UomItem,
                'item_price_agen' => $request -> PriceAgen,
                'item_price_penyalur' => $request -> PricePenyalur,
                'item_price_eceran' => $request -> PriceEceran,
                'log_date_time' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect('/itemMaster');
    }

    public function search(Request $request){
        // catch data search by name on itemMaster.blade
        $search = $request -> input('searchItem');
        if($search == null){
            // get data from table item_master
            $item = DB::table('item_master')->orderBy('item_id', 'ASC')->get();

            // post data from view item master home
            return view('itemMaster', ['item_master' => $item]);
        }else{
           $itemMstr = DB::table('item_master')->select()
                ->where('item_name', 'like', "%".$search."%")->get();

            return view('itemMaster', ['item_master' => $itemMstr]);
        }
    }

    public function print_pdf(){
        $itemMaster = item_master::all();

        $pdf = PDF::loadview('itemMaster_pdf', ['itemMasterPrint'=>$itemMaster]);
        return $pdf->stream();
    }
}
