<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get()
    {
        $data = Category::all();
        return response()->json(['data' => $data]);

    }

    public function add(Request $request)
    {

        $request->validate([
            'category' => 'required'
        ]);

        Category::insert([
            'category' => $request->category,
            'created_at' => date('Y-m-d')
        ]);
    }

    public function edit($id)
    {
        $data = Category::find($id);
        return response()->json($data);


    }

    public function update(Request $request, $id)
    {
        $data = Category::find($id);
        $data->update([
            'category' => $request->category
        ]);
    }


    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        return 'success';
    }
}