<?php

namespace App;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ModuleNotice extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'notice_title', 'notice_body',
    ];

    public function module(){
        return $this->belongsTo('App\Module');
    }
}
