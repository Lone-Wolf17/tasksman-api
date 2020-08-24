<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description'];

    /*
     * Get the tasks for this project
     * */
    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
