<?php

namespace ProjectManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Projects extends Model
{
    protected $table="projects";
    protected $fillable=['title','lecturer_id','student_id','project_file','type','status','description'];

    public function getAllProjects(){
        return DB::table($this->table);
    }
    public function projects(){
        return $this->getAllProjects()->latest()->paginate('10');
    }
    public function myProject(){
        return $this->getAllProjects()->where('lecturer_id',auth('admin')->user()->id);
    }
}
