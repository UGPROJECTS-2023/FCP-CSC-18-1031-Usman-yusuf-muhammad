<?php

namespace ProjectManagement\Models;

use Illuminate\Database\Eloquent\Model;

class NSPL extends Model
{
    protected $table="n_s_p_l";
    protected $fillable=['number'];
    public function getNumberOfStudents(){
        return NSPL::all();
    }
}
