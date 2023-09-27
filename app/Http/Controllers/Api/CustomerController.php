<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\SuperModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    private $table = 'customers';
    private $model;
    public function __construct()
    {
        $this->model = new SuperModel($this->table);
    }

    public function get()
    {

        $data = Customer::latest()->get();

        return $data;
    }

    public function add(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employees',
            'address' => 'required',
            'phone' => 'required|min:10|max:12',
        ]);

        $image = $request->image; //base64 encoded
        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $image = explode(',', $image)[1];
            $image = str_replace(' ', '+', $image);
            $file_name = date('YmdHis') . '.' . $ext;
            Storage::disk('customer')->put($file_name, base64_decode($image)); //config/filesystems path change.
            //insert data
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'image' => $file_name,
                'created_at' => date('Y-m-d')
            ];

        } else {
            //insert data
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'created_at' => date('Y-m-d')
            ];

        }
        $this->model->save($data);


        return 'success';

    }

}