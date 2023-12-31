<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function add(Request $request)
    {

        $request->validate([
            "employee_id" => 'required',
            "date" => "required",
            "amount" => "required|min:0"
        ]);

        Salary::insert([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'amount' => $request->amount
        ]);

        return 'success';



    }

    public function get_employee_salary($id)
    {
        $data = Employee::findOrFail($id);
        $salary = $data->salary;

        return response()->json(['salary' => $salary]);

    }

    public function get()
    {
        $data = Salary::with('employee')->get();
        return response()->json(['data' => $data]);

    }

    public function edit($id)
    {

        $data = Salary::find($id);
        return $data;
    }


    public function update(Request $request, $id)
    {
        $data = Salary::find($id);
        $data->update([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'amount' => $request->amount
        ]);

    }


    public function delete($id)
    {
        Salary::find($id)->delete();
        return 'success';
    }
}