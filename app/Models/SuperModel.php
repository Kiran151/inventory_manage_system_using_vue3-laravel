<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperModel extends Model
{
    use HasFactory;
    protected $table;
    public function __construct($table)
    {
        $this->table = $table;
    }


    public function save($data = array())
    {
        $query = DB::table($this->table)->insertGetId($data);

        return $query;
    }


    public function updateData($data = array(), $id)
    {
        DB::table($this->table)->where('id', $id)->update($data);

    }

    public function deleteData($id){
        DB::table($this->table)->where('id', $id)->delete();

    }



}