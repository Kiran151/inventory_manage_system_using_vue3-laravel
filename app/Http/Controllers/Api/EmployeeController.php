<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SuperModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{

    private $table = 'employees';
    private $model;
    public function __construct()
    {
        $this->model = new SuperModel($this->table);
    }






    public function all()
    {

        $data = Employee::orderBy('id', 'DESC')->get();

        return response()->json($data);

    }
    public function add(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employees',
            'address' => 'required',
            'phone' => 'required|min:10|max:12',
            'salary' => 'required'
        ]);

        $image = $request->image; //base64 encoded
        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $image = explode(',', $image)[1];
            $image = str_replace(' ', '+', $image);
            $file_name = date('YmdHis') . '.' . $ext;
            Storage::disk('employee')->put($file_name, base64_decode($image)); //config/filesystems path change.
            //insert data
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'salary' => $request->salary,
                'nid' => $request->nid,
                'image' => $file_name,
                'created_at' => date('Y-m-d')
            ];
            $this->model->save($data);


        } else {
            //insert data
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
                'salary' => $request->salary,
                'nid' => $request->nid,
                'created_at' => date('Y-m-d')
            ];
            $this->model->save($data);

        }

        return 'success';

    }

    public function delete($id)
    {
        $data = Employee::findOrFail($id);
        if ($data->image) {
            unlink('uploads/employee/' . $data->image);
        }
        $data->delete();

        return 'success';
    }


    public function edit($id)
    {
        $data = Employee::findOrFail($id);
        return response()->json([$data]);

    }


    public function update(Request $request, $id)
    {

        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->name;
        $data['phone'] = $request->phone;
        $data['salary'] = $request->salary;
        $data['nid'] = $request->nid;
        $image = $request->updatedImage;

        $model = Employee::findOrFail($id);

        if ($image) {
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $file_name = date('YmdHis') . '.' . $ext;
            Storage::disk('local')->put($file_name, base64_decode($image));
            $data['image'] = $file_name;

            if ($model->image) {
                unlink('uploads/employee/' . $model->image);
            }

        }
        //update
        $model->update($data);

        return 'success';


    }
}