<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];


    ### relations ###
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }// end of tasks()


}// end of model
