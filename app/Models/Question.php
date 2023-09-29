<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $options;
    use HasFactory;

    

    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }
}
