<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    protected $guarded = [];


    ### relations ###
    public function project()
    {
        return $this->belongsTo(project::class);
    }// end of project()


}// end of task
