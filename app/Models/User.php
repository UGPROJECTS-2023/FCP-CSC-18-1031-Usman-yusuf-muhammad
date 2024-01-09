<?php

namespace ProjectManagement\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Model implements project
{
   use Authenticatable;
    use Notifiable;
    protected $table="users";
    //gets all students

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'middleName','regNo', 'email', 'phone','password','picture','verify',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function student(){
        return DB::table($this->table);
    }
    public function allStudents(){
        return User::all();
    }
    public function allocateStudents(){
        $featurep= DB::table('users')
            ->join('admin' , 'staffId', '=', 'regNo')
            //->where(array('tbl_products.is_Active' => 0,'CategoryID' => $result->CategoryID))
            ->groupBy('regNo')
            ->orderBy(DB::raw('RAND()'))
            ->take(4)
            ->get();
        dd($featurep);
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
}
