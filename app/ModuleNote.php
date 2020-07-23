<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ModuleNote extends Model
{
    //

    use SoftDeletes;

    protected $fillable = [
        'lecture_name', 'link', 'file_name',
    ];

    public function module(){
        return $this->belongsTo('App\Module');
    }
    
}
