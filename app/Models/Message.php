<?php

namespace ProjectManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table="messages";
    protected $fillable=['origin',
        'destination',
        'messages',
        'is_read',];
    public function user(){
        $this->belongsTo(User::class);
    }
}
