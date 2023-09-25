<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function get(Request $request)
    {

        $columnsArr = array(
            0 => 'id',
            1=> 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'shop_name',

        );
        $draw=$request->get('draw');
        $orderColumn = $columnsArr[$request->input('order.0.column')];
        $orderDir = $request->input('order.0.dir');
        $start = $request->get('start');
        $length = $request->get('length');
        $total_records = Supplier::count();
        $total_recordsFiltered=Supplier::count();
        $search=$request->input('search.value');

        if($search){
            $data= Supplier::where(function($query) use($search){
                    $query->where('name','like','%'.$search.'%')
                    ->orWhere('email','like','%'.$search.'%')
                    ->orWhere('phone','like','%'.$search.'%')
                    ->orWhere('shop_name','like','%'.$search.'%');
            })->offset($start)->limit($length)->orderBy($orderColumn, $orderDir)->get();
            $total_recordsFiltered=$data->count();
        }else{
            $data = Supplier::offset($start)->limit($length)->orderBy($orderColumn, $orderDir)->get();

        }



        $response = array(
            'draw' => $draw,
            'recordsTotal' => $total_records,
            'recordsFiltered' => $total_recordsFiltered,
            'data' => $data,
        );
        

        return response()->json($response, 200);

    }

    public function getCategory(){
        $data=Supplier::All();
        return $data;
    }


    public function delete($id){
        Supplier::findOrFail($id)->delete();

        return 'success';
    }


    public function add(Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:suppliers',
            'phone'=>'required|max:12',
            'address'=>'required',
        ]);

        Supplier::insert([
         'name'=>$request->name,
         'email'=>$request->email,
         'phone'=>$request->phone,
         'address'=>$request->address,
         'shop_name'=>$request->shop_name,
         'created_at'=>date('Y-m-d')

        ]);

    }


    public function edit($id){
        $data=Supplier::find($id);

        return response()->json($data);

    }

    public function update(Request $request,$id){
        $data=Supplier::findOrFail($id);
        $data->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'shop_name'=>$request->shop_name
        ]);
    }
}