<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = ['title', 'project_id'];

//    /*
//     * Get the project that this task belong to
//     * */
    public function project() {
        return $this->$this->belongsTo(Project::class, 'project_id');
    }
}
