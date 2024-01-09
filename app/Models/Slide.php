<?php

namespace ProjectManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable=['picture','caption'];
    public function getSlides(){
        return Slide::all();
    }
}
