<?php

namespace ProjectManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentLog extends Model
{
    protected $table="student_logs";
    protected $fillable=['user_id','action'];
    public function getStudentsLog(){
        return DB::table($this->table)->latest()->paginate('100');
    }
}
