<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Module;

class Practical extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'practical_name', 'due_date', 'practical_filename', 'solution_filename', 'module_id'
    ];

    public function module(){
        return $this->belongsTo('App\Module');
    }
    
}
