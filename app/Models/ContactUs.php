<?php

namespace ProjectManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContactUs extends Model
{
    protected $table="contact_us";
    protected $fillable=['name','message','email','status'];
    public function getContactAll(){
        return DB::table($this->table)->where('status', '=', null)->latest()->get();
    }
    public function getAll(){
        return ContactUs::all();
    }
}
