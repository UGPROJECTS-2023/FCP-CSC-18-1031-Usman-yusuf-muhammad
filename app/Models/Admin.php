<?php

namespace ProjectManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as project;
use Illuminate\Support\Facades\DB;

class Admin extends Model implements project
{
    use Authenticatable;

    protected $table="admins";
    protected $fillable=['firstname','lastname','middlename','privilege','officeNo','picture','staffId','email','phone','verify','password'];
    protected $hidden=['remember_token','password'];
    public function allLecturers(){
        return Admin::all()->where('privilege',null);
    }
    public function getSuperAdmin(){
        return Admin::all()->where('privilege',1);
    }
    public function getAlls(){
        return DB::table($this->table)->paginate('8');
    }
    public function getAll(){
        return Admin::all();
    }
    public function allLecturer(){
        return static::with(['allocation']);
    }
    public function allocation(){
        return $this->hasMany(Allocation::class,'lecturer_id','id');
    }
}
