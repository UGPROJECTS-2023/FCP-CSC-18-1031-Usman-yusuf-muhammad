<?php

namespace ProjectManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gallery extends Model
{
    protected $table="galleries";
    protected $fillable=['picture','label'];
    public function getGallery(){
        return DB::table($this->table);
    }
}
