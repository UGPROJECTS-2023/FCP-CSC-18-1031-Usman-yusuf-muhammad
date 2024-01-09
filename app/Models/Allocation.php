<?php

namespace ProjectManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Allocation extends Model
{
    protected $table="allocations";
    protected $fillable=['student_id','lecturer_id'];
    public function getNumber(){
        return $getNumberOfStudents= DB::table('n_s_p_l')->select('number');
    }
    public function StudentToLecturer($numberOfStudentPerLecturer=2){

        $studentArray = DB::table('users')->where('verify',1)->inRandomOrder()->select('id')->get()->toArray();
        $lecturerArray= DB::table('admins')->where('verify',1)->inRandomOrder()->select('id')->get()->toArray();
        $numberStudent = DB::table('n_s_p_l')->select('number')->first();
        ($numberOfStudentPerLecturer=$numberStudent->number);

        foreach ($lecturerArray as $lecturer){
            $numberOfStudentAssigned=0;
            $allocObj=Allocation::all();
            foreach ($studentArray as $key=>$value){
                if(Allocation::where('student_id',$value->id)->exists()) {
                    continue;
                }else{
                    if ($numberOfStudentAssigned < $numberOfStudentPerLecturer) {
                        $numberOfStudentAssigned += 1;
                        Allocation::create([
                            'student_id' => $value->id,
                            'lecturer_id' => $lecturer->id,
                        ]);

                        $studentArray = collect($studentArray)->forget($key)->all();
                    } else {
                        break;
                    }
                }
            }
        }
    }
    public function getAllocation(){
        return DB::table($this->table);
    }
    public function getAllocations(){
        return $this->getAllocation()->orderBy('lecturer_id');
    }
    public function mySupervisor(){
        return $this->getAllocation()->get();
    }
    public function getAllocationObj(){
        return Allocation::all();
    }
}
