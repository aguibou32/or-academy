<?php

namespace App;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\ModuleNotice;
use App\ModuleNotes;
use App\Practical;

class Module extends Model
{
    //
    use SoftDeletes, CascadeSoftDeletes;
    
    protected $dates = ['deleted_at'];

    protected $cascadeDeletes = ['notices', 'notes', 'practicals'];

    public function notices(){
        return $this->hasMany('App\ModuleNotice');
    }
    public function notes(){
        return $this->hasMany('App\ModuleNote');
    }
    
    public function practicals(){
        return $this->hasMany('App\Practical');
    }

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
