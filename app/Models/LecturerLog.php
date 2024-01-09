<?php

namespace ProjectManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LecturerLog extends Model
{
    protected $table="lecturer_logs";
    protected $fillable=['user_id','action','type'];
    public function getLecturersLog(){
        return DB::table($this->table)->latest()->paginate('100');

    }
}
