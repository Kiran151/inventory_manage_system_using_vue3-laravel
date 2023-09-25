<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SuperModel;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    private $table = 'products';
    private $model;
    public function __construct()
    {
        $this->model = new SuperModel($this->table);
    }
    public function add(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'selling_price' => 'required',
            'category_id' => 'required',
            'product_qty' => 'required',
        ]);



        $image = $request->image;
        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $image = explode(',', $image)[1];
            $image = str_replace(' ', '+', $image);

            $file_name = date('YmdHis') . '.' . $ext;
            Storage::disk('product')->put($file_name, base64_decode($image)); //config/filesystems path change.
            $data['image'] = $file_name;
        }

        $data['product_name'] = $request->name;
        $data['selling_price'] = $request->selling_price;
        $data['buying_price'] = $request->buying_price;
        $data['product_qty'] = $request->product_qty;
        $data['category_id'] = $request->category_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['created_at'] = date('Y-m-d');

        $this->model->save($data);

        return 'success';





    }

    public function get(Request $request)
    {

        $columnsArr = array(
            0 => 'id',
            1 => 'product_name',
            2 => 'selling_price',
            3 => 'category',
            4 => 'supplier',

        );
        $draw = $request->get('draw');
        $orderColumn = $columnsArr[$request->input('order.0.column')];
        $orderDir = $request->input('order.0.dir');
        $start = $request->get('start');
        $length = $request->get('length');
        $total_records = Product::count();
        $total_recordsFiltered = Product::count();
        $search = $request->input('search.value');

        if ($search) {
            $data = DB::table($this->table)
                ->leftJoin('categories as c', 'c.id', '=', 'products.category_id')
                ->leftJoin('suppliers as s', 's.id', '=', 'products.supplier_id')
                ->where('product_name', 'like', '%' . $search . '%')
                ->orWhere('c.category', 'like', '%' . $search . '%')
                ->orWhere('s.name', 'like', '%' . $search . '%')
                ->orWhere('selling_price', 'like', '%' . $search . '%')
                ->offset($start)
                ->limit($length)
                ->orderBy($orderColumn, $orderDir)
                ->select('c.category as category', 's.name as supplier', 'products.*')
                ->get();
        } else {
            $data = DB::table($this->table)->offset($start)->limit($length)->orderBy($orderColumn, $orderDir)
                ->leftJoin('categories as c', 'c.id', '=', 'products.category_id')
                ->leftJoin('suppliers as s', 's.id', '=', 'products.supplier_id')
                ->select('c.category as category', 's.name as supplier', 'products.*')
                ->get();

        }



        $response = array(
            'draw' => $draw,
            'start' => $start,
            'length' => $length,
            'recordsTotal' => $total_records,
            'recordsFiltered' => $total_recordsFiltered,
            'data' => $data,
        );
        return response()->json($response, 200);

    }


    public function delete($id)
    {
        $data = Product::find($id);
        if ($data->image) {
            unlink('uploads/product/' . $data->image);
        }
        $data->delete();

        return 'success';

    }


    public function edit($id)
    {
        $data = Product::findOrFail($id);

        return $data;
    }

    public function update(Request $request,$id){
        $product=Product::find($id);
        if($request->updatedImage){
            $position = strpos($request->updatedImage, ';');
            $sub = substr($request->updatedImage, 0, $position);
            $ext = explode('/', $sub)[1];
            $image = explode(',', $request->updatedImage)[1];
            $image = str_replace(' ', '+', $image);

            $file_name = date('YmdHis') . '.' . $ext;
            Storage::disk('product')->put($file_name, base64_decode($image)); //config/filesystems path change.
            $data['image'] = $file_name;

            if ($product->image) {
                unlink('uploads/product/' . $product->image);
            }

        }else{
            $data['product_name'] =$request->product_name;
            $data['buying_price'] =$request->buying_price;
            $data['selling_price'] =$request->selling_price;
            $data['supplier_id'] =$request->supplier_id;
            $data['category_id'] =$request->category_id;
            $data['product_qty'] =$request->product_qty;
        }

        $product->update($data);

        return 'success';
    }




}